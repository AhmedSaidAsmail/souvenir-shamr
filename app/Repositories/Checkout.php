<?php

namespace App\Repositories;


use App\Mail\CustomerReservationNotifiMail;
use App\Mail\PurchasingNotifiMail;
use App\Models\Customer;
use App\Src\Payment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;

class Checkout
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function checkout($lang, $redirectRouteName)
    {
        $customer = auth()->guard('customer')->user();
        $reservation = $this->initialReservation($customer);
        $this->paymentGateway($customer);
        $this->storeReservationItems($reservation);
        $response = $this->paymentResponse($lang, $reservation->id, $redirectRouteName);
        $this->updateReservation($reservation, $response);
        return $response;

    }

    /**
     * @param Customer $customer
     * @return \Illuminate\Database\Eloquent\Model|Reservation
     */
    private function initialReservation(Customer $customer)
    {
        return $customer->reservations()->create([
            'unique_id' => md5(uniqid(rand(), true)),
            'total' => cart()->total(),
            'currency' => currency()
        ]);
    }

    private function paymentGateway(Customer $customer)
    {
        if ($this->paymentMethodIsGateway() && $credit = $this->request->get('credit')) {
            $this->validateCreditCard($credit);
            $customer->creditCards()->create($credit);
        }
    }

    private function paymentMethodIsGateway()
    {
        return $this->request->get('payment_method') == "payment_gateway";
    }

    private function validateCreditCard(array $credit)
    {
        return Validator::make($credit, [
            'cc_no' => 'required',
            'name' => 'required|string',
            'cc_expire_month' => 'required',
            'cc_expire_year' => 'required',
            'cvv' => 'required'
        ])->validate();
    }

    private function storeReservationItems(Reservation $reservation)
    {
        $reservation->items()->createMany(cart()->__toArray(function ($product) {
            return [
                'product_id' => $product->product->id,
                'total' => $product->price,
                'quantity' => $product->quantity,
                'details' => serialize($product->details)
            ];
        }));
    }

    /**
     * @param $lang
     * @param $reservationId
     * @param $routeName
     * @return \App\Src\Payment\PaymentResponse
     */
    private function paymentResponse($lang, $reservationId, $routeName)
    {
        $redirectUrl = route($routeName, compact('lang', 'reservationId'));
        return (new Payment($this->request, $redirectUrl))
            ->proceed();
    }

    /**
     * @param Reservation $reservation
     * @param \App\Src\Payment\PaymentResponse $response
     */
    private function updateReservation(Reservation $reservation, $response)
    {
        $reservation->update($response->__toArray());
    }

    public function checkoutDone($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);
        if ($this->paypalIsSuccess()) {
            $this->updatePaypalReservation($reservation);
        } elseif ($this->paypalIsCanceled()) {
            throw  new \Exception('Payment with paypal is not approved');
        }
        //$this->sendNotificationMails($reservation);
        cart()->destroy();

    }

    private function responseIsPaypal()
    {
        return $this->request->has('method') && $this->request->get('method') == 'paypal';
    }

    private function paypalIsApproval()
    {
        return $this->request->has('approval') && json_decode($this->request->get('approval')) === true;
    }

    private function paypalIsSuccess()
    {
        return $this->responseIsPaypal() && $this->paypalIsApproval();
    }

    private function paypalIsCanceled()
    {
        return $this->responseIsPaypal() && !$this->paypalIsApproval();
    }

    private function updatePaypalReservation(Reservation $reservation)
    {
        $reservation->update([
            'payment_approval' => 1,
            'transaction_id' => $this->request->get('paymentId')
        ]);
    }

    private function sendNotificationMails(Reservation $reservation)
    {
        $this->sendCustomerNotification($reservation);
        $this->sendNewOrderNotification($reservation);
    }

    private function sendCustomerNotification(Reservation $reservation)
    {
        Mail::to(auth()->guard('customer')->user()->email)
            ->send(new CustomerReservationNotifiMail($reservation));
    }

    private function sendNewOrderNotification(Reservation $reservation)
    {
        Mail::to(env('PURCHASING_MAIL'))->send(new PurchasingNotifiMail($reservation));
    }

}
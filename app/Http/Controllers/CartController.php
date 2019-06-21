<?php

namespace App\Http\Controllers;

use App\Models\CreditPaymentGateway;
use App\Models\PaypalPaymentGateway;
use App\Models\Product;
use App\Repositories\Checkout;
use Illuminate\Http\Request;
use Exception;

class CartController extends Controller
{
    /**
     * Displaying all shopping cart items
     *
     * @param $lang
     * @return \Illuminate\Support\Facades\Response
     */
    public function index($lang)
    {
        return view('front.cart.index', ['lang' => $lang, 'cart' => cart()]);
    }

    /**
     * Adding new item to shopping cart
     *
     * @param Request $request
     * @param $lang
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(Request $request, $lang)
    {
        $attributes = $request->all();
        $this->convertProductToModel($attributes);
        try {
            cart()->insert($attributes);
            return redirect()->route('cart.index', compact('lang'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Displaying shopping cart items and shipping address
     *
     * @param $lang
     * @return \Illuminate\Support\Facades\Response
     */
    public function checkout($lang)
    {
        $cart = cart();
        if ($add = auth()->guard('customer')->user()->details) {
            return redirect()->route('cart.payment', compact('lang', 'cart'));
        }
        return view('front.cart.checkout', compact('lang', 'cart'));
    }

    /**
     * Destroying item exists in shopping cart
     *
     * @param $lang
     * @param $cart_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($lang, $cart_id)
    {
        cart()->remove($cart_id);
        return redirect()->route('cart.index', compact('lang'));
    }

    /**
     * Making payment to proceed
     *
     * @param $lang
     * @return \Illuminate\Support\Facades\Response
     */
    public function payment($lang)
    {
        $credit_gateway = CreditPaymentGateway::setting();
        $paypal_gateway = PaypalPaymentGateway::setting();
        $default_payment = $this->defaultPayment();
        $cart = cart();
        return view(
            'front.cart.payment',
            compact('lang', 'cart', 'credit_gateway', 'paypal_gateway', 'default_payment')
        );
    }

    public function proceedPayment($lang,Checkout $checkout)
    {
        dd($checkout->all());
    }

    /**
     * Converting product key at request into Product model
     *
     * @param array $attributes
     */
    private function convertProductToModel(array &$attributes)
    {
        array_walk($attributes, function (&$item, $key) {
            if ($key == "product") {
                $item = Product::findOrFail($item);
            }
        });
    }

    private function defaultPayment()
    {
        switch (true) {
            case CreditPaymentGateway::setting():
                return "payment_gateway";
            case PaypalPaymentGateway::setting():
                return "paypal_gateway";
            default:
                return "cash_on_delivery";
        }
    }

}
<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchasingNotifiMail extends Mailable
{
    /**
     * @var Reservation $reservation
     */
    private $reservation ;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Reservation $reservation
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->reservation->customer->email)
            ->view('mail.purchasingReminder')->with(['id' => $this->reservation->id]);
    }
}

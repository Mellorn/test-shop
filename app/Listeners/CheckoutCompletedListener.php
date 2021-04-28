<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Contracts\Mail\Factory as MailFactory;
use App\Events\CheckoutCompletedEvent;
use App\Mail\OrderShipped;

class CheckoutCompletedListener
{
    /**
     * The MailFactory instance.
     *
     * @var MailFactory
     */
    public MailFactory $mail;

    /**
     * Create the event listener.
     *
     * @param  MailFactory  $mail
     *
     * @return void
     */
    public function __construct(MailFactory $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutCompletedEvent  $event
     *
     * @return void
     */
    public function handle(CheckoutCompletedEvent $event): void
    {
        $mailable = new OrderShipped(
            $event->order,
            $event->products,
            $event->shippingOption
        );

        $this->mail->to(\config('mail.admin_email_address'))->send($mailable);
    }
}

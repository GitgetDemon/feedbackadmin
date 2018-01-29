<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class feedbackMail extends Notification
{
    use Queueable;

    protected $answers;
    protected $result;
    protected $questionnaire;
    protected $szallitolevelszam;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answers,$result,$szallitolevelszam)
    {
        //
      $this->answers = $answers;
      $this->result = $result;
      $this->szallitolevelszam = $szallitolevelszam;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $answers = $this->answers;
      $result = $this->result;
      $questionnaire = $this->questionnaire;
      $szallitolevelszam = $this->szallitolevelszam;

      $mailMessage = (new MailMessage)
        ->from('noreply@revotica.hu')
        ->subject('Új értékelés érkezett!')
        ->view('emails.resultMail',compact('answers','result','questionnaire','szallitolevelszam'));


        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

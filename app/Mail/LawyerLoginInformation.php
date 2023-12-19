<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LawyerLoginInformation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $template;
    public $subject;
    public $login_here_text;
    public function __construct($template,$subject,$login_here_text)
    {
        $this->template=$template;
        $this->subject=$subject;
        $this->login_here_text=$login_here_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template=$this->template;
        $login_here_text=$this->login_here_text;
        return $this->subject($this->subject)->view('admin.lawyer.email',compact('template','login_here_text'));
    }
}

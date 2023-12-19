<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $subject;
    public $user;
    public $reset_pass_text;
    public function __construct($user,$template,$subject,$reset_pass_text)
    {
        $this->user=$user;
        $this->template=$template;
        $this->subject=$subject;
        $this->reset_pass_text=$reset_pass_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template=$this->template;
        $user=$this->user;
        $reset_pass_text=$this->reset_pass_text;
        return $this->subject($this->subject)->view('client.profile.auth.send-forget-token',compact('template','user','reset_pass_text'));
    }
}

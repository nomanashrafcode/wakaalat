<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $admin;
    protected $template;
    public $subject;
    public $reset_pass_text;
    public function __construct($admin,$template,$subject,$reset_pass_text)
    {
        $this->admin=$admin;
        $this->subject=$subject;
        $this->template=$template;
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
        $admin=$this->admin;
        $reset_pass_text=$this->reset_pass_text;
        return $this->subject($this->subject)->view('admin.auth.send-forget-token',compact('admin','template','reset_pass_text'));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Doctor;
class DoctorForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $doctor;
    public $template;
    public $subject;
    public $reset_pass_text;
    public function __construct($doctor,$template,$subject,$reset_pass_text)
    {
        $this->doctor=$doctor;
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
        $doctor=$this->doctor;
        $template=$this->template;
        $reset_pass_text=$this->reset_pass_text;
        return $this->subject($this->subject)->view('lawyer.auth.send-forget-token',compact('doctor','template','reset_pass_text'));
    }
}

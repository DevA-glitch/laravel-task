<?php

namespace App\Mail;

use App\Models\Info as ModelsInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Info extends Mailable
{
    use Queueable, SerializesModels;

    public $info;

    public function __construct(ModelsInfo $info)
    {
        $this->info = $info;
    }

    public function build()
    {
        return $this->subject('Info')
            ->view('email.info')
            ->with(['info' => $this->info]);
    }
}

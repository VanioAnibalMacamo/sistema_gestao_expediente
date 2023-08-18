<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacaoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $assunto;
    public $mensagem;

    public function __construct($assunto, $mensagem)
    {
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->assunto)
            ->view('emails.email_template') // Atualize o nome da view aqui
            ->with([
                'assunto' => $this->assunto,
                'mensagem' => $this->mensagem
            ]);
    }

}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class ComprobanteMail extends Mailable
{
    public $pdfPath;
    public $renta;
    public $departamento;
    public $domicilio;
    public $user;

    public function __construct($pdfPath, $renta, $departamento, $domicilio, $user)
    {
        $this->pdfPath = $pdfPath;
        $this->renta = $renta;
        $this->departamento = $departamento;
        $this->domicilio = $domicilio;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('email.comprobante', [
            'renta' => $this->renta,
            'departamento' => $this->departamento,
            'domicilio' => $this->domicilio,
            'user' => $this->user,
        ])->subject('Comprobante de Renta')
        ->attach($this->pdfPath, ['as' => 'comprobante.pdf', 'mime' => 'application/pdf']);
    }
}
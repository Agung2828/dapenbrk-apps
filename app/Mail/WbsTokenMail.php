<?php

namespace App\Mail;

use App\Models\WbsLaporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WbsTokenMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WbsLaporan $laporan) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nomor Tiket Pelaporan WBS - ' . $this->laporan->ticket_token,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.wbs-token',
        );
    }
}

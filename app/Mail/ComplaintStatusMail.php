<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Complaint;

class ComplaintStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public Complaint $complaint;
    public string $updateType;

    public function __construct(Complaint $complaint, string $updateType)
    {
        $this->complaint   = $complaint;
        $this->updateType  = $updateType;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 Smart Hyderabad — Complaint Update #' . $this->complaint->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.complaint-status',
        );
    }
}

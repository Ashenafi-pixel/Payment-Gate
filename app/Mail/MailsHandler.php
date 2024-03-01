<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class MailsHandler extends Mailable implements ShouldQueue
{
    # View Directory
    public const DIR = 'mails';

    use Queueable, SerializesModels;

    /**
     * @var array
     */
    private $_data;

    /**
     * Create a new message instance.
     *
     * @param array $_data
     *
     * @return void
     */
    public function __construct(array $_data)
    {
        $this->_data = $_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $params = collect($this->_data['params']);
        return $this->subject($this->_data['subject'])
            ->view(sprintf("%s.%s", self::DIR, $this->_data['view']))
            ->with('param', $params);
    }
}

<?php

namespace App\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    /** @var \Illuminate\Contracts\Session\Session */
    protected $session;

    /**
     * Construct a new Flash object.
     *
     * @param  \Illuminate\Contracts\Session\Session  $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Get the flashed message. If a key is provided, get the message for the key.
     *
     * @param  string|null  $key
     */
    public function getMessage(?string $key = 'default'): ?Message
    {
        $flashMessage = $this->session->get('flash_message')[$key];

        return $flashMessage ? new Message($key, $flashMessage['message'], $flashMessage['class']) : null;
    }

    /**
     * Flash a message to the session.
     *
     * @param  \App\Flash\Message  $message
     */
    public function flash(Message $message): void
    {
        $this->flashMessage($message);
    }

    /**
     * Set the flash message.
     *
     * @param  \App\Flash\Message  $message
     */
    public function flashMessage(Message $message): void
    {
        $messageProperties = $message->toArray();

        $this->session->flash('flash_message', [
            $messageProperties['key'] => [
                'message' => $messageProperties['message'],
                'class' => $messageProperties['class'],
            ],
        ]);
    }
}

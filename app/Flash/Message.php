<?php

namespace App\Flash;

class Message
{
    /** @var string */
    public $key;

    /** @var string */
    public $message;

    /** @var string */
    public $class;

    /**
     * Construct a new flash Message object.
     *
     * @param  string  $key
     * @param  string  $message
     * @param  mixed  $class
     */
    public function __construct(string $key = 'default', string $message, $class)
    {
        if (is_array($class)) {
            $class = implode(' ', $class);
        }

        $this->key = $key;
        $this->message = $message;
        $this->class = $class;
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'message' => $this->message,
            'class' => $this->class,
        ];
    }
}

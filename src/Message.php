<?php

declare(strict_types=1);

namespace Steganography;

/**
 * Rappresents a message to be converted to binary.
 *
 * @package Steganography
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class Message
{
    private string $message;

    /**
     * Message constructor.
     * @param string $message The message.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Returns a binary rappresentation of the message.
     * @return BinaryMessage The message to its binary rappresentation.
     */
    public function toBinary(): BinaryMessage
    {
        $bin = '';
        for ($i = 0; $i < strlen($this->message); $i++) {
            $bin .= str_pad(decbin(ord($this->message[$i])), 8, "0", STR_PAD_LEFT);
        }
        return new BinaryMessage($bin);
    }

    /**
     * Returns the message.
     * @return string The message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Returns the length of the message.
     * @return int The length.
     */
    public function getLength(): int
    {
        return strlen($this->message);
    }

    public function __toString(): string
    {
        return $this->message;
    }
}

<?php

declare(strict_types=1);

namespace Steganography;

use Steganography\Exception\Message\TooLongException as MessageTooLongException;
use Steganography\Exception\SteganographyException;

/**
 * Encodes a message into a medium using the LSB of each pixel.
 *
 * @package Steganography
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class Encoder
{
    private MediumInterface $src;
    private Message $message;
    private string $eom;

    /**
     * Encoder constructor.
     * @param MediumInterface $source The source medium.
     * @param Message $message The message to be encoded.
     * @param string $eom The binary rappresentation of the End Of Message, must be 8 bits long (default is '00000000').
     */
    public function __construct(
        MediumInterface &$source,
        Message $message,
        string $eom = BinaryMessage::DEFAULT_EOM
    ) {
        $this->src = $source;
        $this->message = $message;
        $this->eom = $eom;
    }

    /**
     * Encodes the message into the medium.
     * @return void
     */
    public function encode(): void
    {
        $binMsg = $this->message->toBinary();
        $binMsg->addEOM($this->eom);
        $messageLength = $binMsg->getLength();

        if($messageLength > ($this->src->getWidth() * $this->src->getHeight())) {
            throw new MessageTooLongException("The provided message is too long");
        }

        $pixel = new Pixel(0, 0);

        for($i = 0; $i < $messageLength; $i++) {

            if($pixel->getX() == $this->src->getWidth() + 1) { // Reached the end of the row of pixels, start on next row
                $pixel->incrY();
                $pixel->setX(0);
            }

            if($pixel->getX() === $this->src->getHeight() && $pixel->getX() === $this->src->getWidth()) {
                throw new SteganographyException("Couldn't write the lsb: unexpected end of file");
            }

            $rgb = $this->src->getColorAt($pixel);
            $rgb->setBlue(bindec(substr(decbin($rgb->getBlue()), 0, -1) . ((string)$binMsg)[$i]));

            $this->src->setPixel($pixel, $this->src->colorAllocate($rgb));

            $pixel->incrX();
        }

    }

}

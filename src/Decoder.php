<?php

declare(strict_types=1);

namespace Steganography;

use Steganography\Exception\SteganographyException;
use Steganography\Exception\Message\NotFoundException as MessageNotFoundException;

/**
 * Decodes a message from a medium.
 *
 * @package Steganography
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class Decoder
{
    private MediumInterface $src;
    private string $eom;

    /**
     * Decoder constructor.
     * @param MediumInterface $source The source medium.
     * @param string $eom A binary rappresentation of the End Of Message, must be 8 bits long (default is '00000000').
     */
    public function __construct(MediumInterface $source, string $eom = BinaryMessage::DEFAULT_EOM)
    {
        $this->src = $source;
        $this->eom = $eom;
    }

    /**
     * Decodes the message from the medium
     * @return Message A message
     * @throws MessageNotFoundException If no message is found.
     */
    public function decode(): Message
    {
        $pixel = new Pixel(0, 0);
        $binary = "";

        for ($i = 0; $i < ($this->src->getWidth() * $this->src->getHeight()); $i++) {

            if($pixel->getX() === $this->src->getWidth()) { // Reached the end of the row of pixels, start on next row
                $pixel->incrY();
                $pixel->setX(0);
            }

            if($pixel->getX() === $this->src->getHeight() && $pixel->getX() === $this->src->getWidth()) {
                throw new SteganographyException("Couldn't write the lsb: unexpected end of file");
            }

            if($i > 1 && $i % 8 === 0) { // Every 8 bits
                if(substr($binary, -8) === $this->eom) {
                    return (new BinaryMessage(substr($binary, 0, -8)))->toString();
                }
            }

            $binary .= substr(decbin($this->src->getColorAt($pixel)->getBlue()), -1);

            $pixel->incrX();
        }

        throw new MessageNotFoundException("There is no message in " . $this->src->getPath());
    }
}

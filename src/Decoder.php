<?php

declare(strict_types=1);

namespace Steganography;

use Steganography\Exception\SteganographyException;
use Steganography\Exception\Message\NotFoundException as MessageNotFoundException;

class Decoder
{
    private MediumInterface $src;
    private string $eom;

    public function __construct(MediumInterface $source, string $eom = BinaryMessage::DEFAULT_EOM)
    {
        $this->src = $source;
        $this->eom = $eom;
    }

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

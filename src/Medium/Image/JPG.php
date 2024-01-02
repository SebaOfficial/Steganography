<?php

declare(strict_types=1);

namespace Steganography\Medium\Image;

use Steganography\Exception\Medium\Image\Exception as ImageException;

/**
 * Jpeg rappresentation of a medium.
 *
 * @package Steganography\Medium\Image
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class JPG extends Image
{
    protected function createImage(): \GdImage
    {
        return imagecreatefromjpeg($this->getPath());
    }

    public function saveToPath(string $path): void
    {
        if(!imagejpeg($this->getImage(), $path)) {
            throw new ImageException("Failed to save image to $path");
        }
    }
}

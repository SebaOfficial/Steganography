<?php

declare(strict_types=1);

namespace Steganography\Medium\Image;

use Steganography\Exception\Medium\Image\Exception as ImageException;

/**
 * PNG representation of a medium.
 *
 * @package Steganography\Medium\Image
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class PNG extends Image
{
    protected function createImage(): \GdImage
    {
        return imagecreatefrompng($this->getPath());
    }

    public function saveToPath(string $path): void
    {
        if (!imagepng($this->getImage(), $path)) {
            throw new ImageException("Failed to save image to $path");
        }
    }
}

<?php

declare(strict_types=1);

namespace Steganography\Medium\Image;

use Steganography\{MediumInterface, Pixel, RGBColor};
use Steganography\Exception\Medium\Image\Exception as ImageException;

/**
 * Image rappresentation of a medium
 *
 * @package Steganography\Medium\Image
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
abstract class Image implements MediumInterface
{
    private string $path;
    private int $width;
    private int $height;
    private int $type;
    private string $mimetype;
    private \GdImage $img;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->loadImageInfo();
    }

    private function loadImageInfo(): void
    {
        $imageInfo = getimagesize($this->path);

        if ($imageInfo === false) {
            throw new ImageException("Failed to get image information");
        }

        list($this->width, $this->height, $this->type, $this->mimetype) = $imageInfo;
    }

    protected function getImage(): \GdImage
    {
        if(!isset($this->img)) {
            $this->img = $this->createImage();
        }

        return $this->img;
    }

    abstract protected function createImage(): \GdImage;

    public function getPath(): string
    {
        return $this->path;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getMimetype(): string
    {
        return $this->mimetype;
    }

    public function getColorAt(Pixel $pixel): RGBColor
    {
        if(($color = imagecolorat($this->getImage(), $pixel->getX(), $pixel->getY())) === false) {
            throw new ImageException("Failed to get the color of Pixel(" . $pixel->getX() . ", " . $pixel->getY() . ")");
        }

        return new RGBColor($color);
    }

    public function colorAllocate(RGBColor $color): RGBColor
    {
        if(($rgb = imagecolorallocate($this->getImage(), $color->getRed(), $color->getGreen(), $color->getBlue())) == false) {
            throw new ImageException("Failed to allocate color rgb(" . $color->getRed() . ", " . $color->getGreen() . ", " . $color->getBlue() . ")");
        }
        return new RGBColor($rgb);
    }

    public function setPixel(Pixel $pixel, RGBColor $color): void
    {
        if(!imagesetpixel($this->getImage(), $pixel->getX(), $pixel->getY(), $color->getRgb())) {
            throw new ImageException("Failed to set Pixel(" . $pixel->getX() . ", " . $pixel->getY() . ") with color rgb(" . $color->getRed() . ", " . $color->getGreen() . ", " . $color->getBlue() . ")");
        }
    }

    public function close(): void
    {
        imagedestroy($this->getImage());
    }

    public abstract function saveToPath(string $path): void;
}

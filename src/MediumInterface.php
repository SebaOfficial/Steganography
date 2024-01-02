<?php

declare(strict_types=1);

namespace Steganography;

interface MediumInterface
{
    /**
     * Medium Constructor.
     * @param string $path The path to the medium.
     */
    public function __construct(string $path);

    /**
     * Returns the path of the medium.
     * @return string The path.
     */
    public function getPath(): string;

    /**
     * Returns the width in bytes of the medium.
     * @return int The width.
     */
    public function getWidth(): int;

    /**
     * Returns the heigth in bytes of the medium.
     * @return int The heigth.
     */
    public function getHeight(): int;

    /**
     * Returns the index of the color of a pixel.
     * @param Pixel $pixel The pixel.
     * @return RGBColor The color.
     * @throws \Steganography\Exception\Medium\Exception On failure.
     */
    public function getColorAt(Pixel $pixel): RGBColor;

    /**
     * Allocate a color for an image.
     * @return RGBColor the color.
     * @throws \Steganography\Exception\Medium\Exception On failure.
     */
    public function colorAllocate(RGBColor $color): RGBColor;

    /**
     * Sets a single pixel.
     * @throws \Steganography\Exception\Medium\Exception On failure.
     */
    public function setPixel(Pixel $pixel, RGBColor $color): void;

    /**
     * Closes the instance of the medium, freeing the memory.
     */
    public function close(): void;

    /**
     * Saves the medium to the specified path.
     * @param string $path The path.
     * @throws \Steganography\Exception\Medium\Exception On failure.
     */
    public function saveToPath(string $path): void;
}

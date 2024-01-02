<?php

declare(strict_types=1);

namespace Steganography;

/**
 * Rappresents a Pixel inside a medium.
 *
 * @package Steganography
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class Pixel
{
    private int $x;
    private int $y;

    /**
     * Pixel constructor.
     * @param int $x The X coordinate of the pixel
     * @param int $y The Y coordinate of the pixel
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Returns the X coordinate of the pixel.
     * @return int The X.
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Returns the Y coordinate of the pixel.
     * @return int The Y.
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * Sets the X coordinate.
     * @param int $x The value of X.
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * Sets the Y coordinate.
     * @param int $y The value of Y.
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * Increases the X coordinate
     * @param int $incr The increasing value (default is 1).
     */
    public function incrX(int $incr = 1): void
    {
        $this->x += $incr;
    }

    /**
     * Increases the Y coordinate
     * @param int $incr The increasing value (default is 1).
     */
    public function incrY(int $incr = 1): void
    {
        $this->y += $incr;
    }
}

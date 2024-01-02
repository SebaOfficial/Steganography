<?php

declare(strict_types=1);

namespace Steganography;

/**
 * Represents an RGB color.
 *
 * @package Steganography
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class RGBColor
{
    private int $rgb;

    public function __construct(int $rgb)
    {
        $this->rgb = $rgb;
    }

    /**
     * Returns the RGB value
     * @return int The value.
     */
    public function getRgb(): int
    {
        return $this->rgb;
    }

    /**
     * Returns the red value.
     * @return int The value.
     */
    public function getRed(): int
    {
        return ($this->rgb >> 16) & 0xFF;
    }

    /**
     * Returns the green value.
     * @return int The value.
     */
    public function getGreen(): int
    {
        return ($this->rgb >> 8) & 0xFF;
    }

    /**
     * Returns the blue value.
     * @return int The value.
     */
    public function getBlue(): int
    {
        return $this->rgb & 0xFF;
    }

    /**
     * Sets the red value.
     * @param int $r The red value (0-255).
     */
    public function setRed(int $r): void
    {
        $r = max(0, min(255, $r)); // Ensure $r is within the valid range
        $this->rgb = ($this->rgb & 0x00FFFF) | ($r << 16);
    }

    /**
     * Sets the green value.
     * @param int $g The green value (0-255).
     */
    public function setGreen(int $g): void
    {
        $g = max(0, min(255, $g)); // Ensure $g is within the valid range
        $this->rgb = ($this->rgb & 0xFF00FF) | ($g << 8);
    }

    /**
     * Sets the blue value.
     * @param int $b The blue value (0-255).
     */
    public function setBlue(int $b): void
    {
        $b = max(0, min(255, $b)); // Ensure $b is within the valid range
        $this->rgb = ($this->rgb & 0xFFFF00) | $b;
    }
}

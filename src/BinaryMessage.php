<?php

declare(strict_types=1);

namespace Steganography;

/**
 * A binary rappresentation of Message.
 * @package Steganography
 * @author Sebastiano Racca <sebastiano@racca.me>
 */
class BinaryMessage
{
    private string $binary;

    /**
     * @var string Default End Of Message
     */
    public const DEFAULT_EOM = "00000000";

    /**
     * Binary Message Construct.
     * @param string $binary A binary rappresentation of a string.
     */
    public function __construct(string $binary)
    {
        $this->binary = $binary;
    }

    /**
     * Returns the binary into a string.
     * @return Message The string.
     */
    public function toString(): Message
    {
        $text_array = str_split($this->binary, 8);
        $str = '';
        foreach ($text_array as $binaryChunk) {
            $str .= chr(bindec($binaryChunk));
        }
        return new Message($str);
    }

    /**
     * Returns the binary rappresentation of the string.
     * @return string The binary.
     */
    public function getBinary(): string
    {
        return $this->binary;
    }

    /**
     * Adds the End Of Message to the binary string.
     * @param string $eom The End of Message.
     */
    public function addEOM(string $eom): void
    {
        $this->binary .= $eom;
    }

    /**
     * Returns the length of the binary message
     */
    public function getLength(): int
    {
        return strlen($this->binary);
    }

    public function __toString(): string
    {
        return $this->binary;
    }
}

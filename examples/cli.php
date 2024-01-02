<?php

require __DIR__ . "/vendor/autoload.php";

use Steganography\{Encoder, Message, Decoder};
use Steganography\Medium\Image\JPG;
use Steganography\Exception\SteganographyException;

if ($argc < 3) {
    echo "Usage: php " . $argv[0] . " [source] [message]\n";
    exit(1);
}

try {
    $source = new JPG($argv[1]);
    $message = new Message($argv[2]);

    $encoder = new Encoder($source, $message);
    $encoder->encode();
    $destinationPath = "destination.jpg";
    $source->saveToPath($destinationPath);
    echo "Message encoded to $destinationPath\n\n";

    $decoder = new Decoder($source);
    echo "Extracted Message: " . $decoder->decode() . "\n";
} catch (SteganographyException $e) {
    echo "There was an error: " . $e->getMessage();
    exit(1);
}

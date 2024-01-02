<?php

require __DIR__ . "/vendor/autoload.php";

use Steganography\{Encoder, Message, Decoder};
use Steganography\Medium\Image\JPG;
use Steganography\Exception\SteganographyException;

try {
    $source = new JPG("source.jpg");
    $message = new Message("Hello World!");

    $encoder = new Encoder($source, $message);
    $encoder->encode();
    $source->saveToPath("destination.jpg");
    echo "Message encoded to destination.jpg\n\n";

    $decoder = new Decoder($source);
    echo "Exctracted Message: " . $decoder->decode() . "\n";
} catch (SteganographyException $e) {
    echo "There was an error: " . $e->getMessage();
    exit(1);
}

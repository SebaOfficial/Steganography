<?php

use Steganography\Encoder;
use Steganography\Decoder;
use Steganography\Medium\Image\JPG;
use Steganography\Message;
use Steganography\Exception\Message\TooLongException as MessageTooLongException;
use Steganography\Exception\SteganographyException;

it('can encode and decode a message', function () {
    $sourcePath = __DIR__ . '/Medium/source.jpg';
    $source = new JPG($sourcePath);

    $messageText = 'Hello, Steganography!';
    $message = new Message($messageText);

    $encoder = new Encoder($source, $message);

    $encoder->encode();

    $decoder = new Decoder($source);

    $decodedMessage = $decoder->decode();

    expect($decodedMessage)->toBeInstanceOf(Message::class);
    expect((string) $decodedMessage)->toBe($messageText);
});

it('throws MessageTooLongException when encoding a message that is too long', function () {
    $sourcePath = __DIR__ . '/Medium/source.jpg';
    $source = new JPG($sourcePath);

    $tooLongMessageText = str_repeat('A', $source->getWidth() * $source->getHeight() + 1);
    $tooLongMessage = new Message($tooLongMessageText);

    $encoder = new Encoder($source, $tooLongMessage);

    $this->expectException(MessageTooLongException::class);

    $encoder->encode();
});

it('throws SteganographyException when decoding from an invalid image', function () {
    $this->expectException(SteganographyException::class);

    $invalidSourcePath = 'path/to/nonexistent/image.jpg';
    $invalidSource = new JPG($invalidSourcePath);

    $decoder = new Decoder($invalidSource);

    $decoder->decode();
});

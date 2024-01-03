<?php

use Steganography\Message;
use Steganography\BinaryMessage;

it('can create a Message instance', function () {
    $message = new Message('Hello, World!');

    expect($message)->toBeInstanceOf(Message::class);
});

it('can get the message', function () {
    $message = new Message('Hello, World!');

    expect($message->getMessage())->toBe('Hello, World!');
});

it('can get the length of the message', function () {
    $message = new Message('Hello, World!');

    expect($message->getLength())->toBe(13);
});

it('can convert the message to binary', function () {
    $message = new Message('hello');
    $binaryMessage = $message->toBinary();

    expect($binaryMessage)->toBeInstanceOf(BinaryMessage::class);
    expect((string) $binaryMessage)->toBe('0110100001100101011011000110110001101111');
});

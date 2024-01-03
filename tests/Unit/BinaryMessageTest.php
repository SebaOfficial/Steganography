<?php

use Steganography\BinaryMessage;
use Steganography\Message;

it('can create a BinaryMessage instance', function () {
    $binaryMessage = new BinaryMessage('0110100001100101011011000110110001101111');

    expect($binaryMessage)->toBeInstanceOf(BinaryMessage::class);
});

it('can convert binary to string', function () {
    $binaryMessage = new BinaryMessage('0110100001100101011011000110110001101111');
    $message = $binaryMessage->toString();

    expect($message)->toBeInstanceOf(Message::class);
    expect((string) $message)->toBe('hello');
});

it('can get the binary representation', function () {
    $binaryMessage = new BinaryMessage('0110100001100101011011000110110001101111');

    expect($binaryMessage->getBinary())->toBe('0110100001100101011011000110110001101111');
});

it('can add End Of Message (EOM)', function () {
    $binaryMessage = new BinaryMessage('0110100001100101011011000110110001101111');
    $binaryMessage->addEOM(BinaryMessage::DEFAULT_EOM);

    expect($binaryMessage->getBinary())->toBe('011010000110010101101100011011000110111100000000');
});

it('can get the length of the binary message', function () {
    $binaryMessage = new BinaryMessage('0110100001100101011011000110110001101111');

    expect($binaryMessage->getLength())->toBe(strlen('hello') * 8);
});

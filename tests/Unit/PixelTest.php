<?php

use Steganography\Pixel;

it('can create a Pixel instance', function () {
    $pixel = new Pixel(10, 20);

    expect($pixel)->toBeInstanceOf(Pixel::class);
});

it('can get X and Y coordinates', function () {
    $pixel = new Pixel(10, 20);

    expect($pixel->getX())->toBe(10);
    expect($pixel->getY())->toBe(20);
});

it('can set X and Y coordinates', function () {
    $pixel = new Pixel(10, 20);

    $pixel->setX(30);
    $pixel->setY(40);

    expect($pixel->getX())->toBe(30);
    expect($pixel->getY())->toBe(40);
});

it('can increase X and Y coordinates', function () {
    $pixel = new Pixel(10, 20);

    $pixel->incrX(5);
    $pixel->incrY(10);

    expect($pixel->getX())->toBe(15);
    expect($pixel->getY())->toBe(30);
});

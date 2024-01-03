<?php

use Steganography\RGBColor;

it('can create an RGBColor instance', function () {
    $color = new RGBColor(0xFF3366);

    expect($color)->toBeInstanceOf(RGBColor::class);
});

it('can get RGB values', function () {
    $color = new RGBColor(0xFF3366);

    expect($color->getRgb())->toBe(0xFF3366);
    expect($color->getRed())->toBe(0xFF);
    expect($color->getGreen())->toBe(0x33);
    expect($color->getBlue())->toBe(0x66);

});

it('can set RGB values', function () {
    $color = new RGBColor(0xFF3366);

    $color->setRed(0xAA);
    expect($color->getRed())->toBe(0xAA);
    expect($color->getRgb())->toBe(0xAA3366);

    $color->setGreen(0xBB);
    expect($color->getGreen())->toBe(0xBB);
    expect($color->getRgb())->toBe(0xAABB66);

    $color->setBlue(0xCC);
    expect($color->getBlue())->toBe(0xCC);
    expect($color->getRgb())->toBe(0xAABBCC);
});

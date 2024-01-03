<?php

use Steganography\Medium\Image\Image;
use Steganography\Medium\Image\JPG;
use Steganography\Pixel;
use Steganography\RGBColor;
use Steganography\Exception\Medium\Image\Exception as ImageException;

const imgPath = __DIR__ . '/../source.jpg';

it('can create a JPG instance', function () {
    $jpg = new JPG(imgPath);

    expect($jpg)->toBeInstanceOf(JPG::class);
    expect($jpg)->toBeInstanceOf(Image::class);
});

it('can get image path, width, height, type, and mimetype', function () {
    $jpg = new JPG(imgPath);

    expect($jpg->getPath())->toBe(imgPath);
    expect($jpg->getWidth())->toBe(2955);
    expect($jpg->getHeight())->toBe(3694);
    expect($jpg->getType())->toBe(IMAGETYPE_JPEG);
    expect($jpg->getMimetype())->toBe('image/jpeg');
});

it('can get color at a specific pixel', function () {
    $jpg = new JPG(imgPath);
    $pixel = new Pixel(0, 0);

    $color = $jpg->getColorAt($pixel);

    expect($color)->toBeInstanceOf(RGBColor::class);
});

it('can allocate color', function () {
    $jpg = new JPG(imgPath);
    $color = new RGBColor(7570580);

    $allocatedColor = $jpg->colorAllocate($color);

    expect($allocatedColor)->toBeInstanceOf(RGBColor::class);
});

it('can set pixel color', function () {
    $jpg = new JPG(imgPath);
    $pixel = new Pixel(0, 0);
    $color = new RGBColor(7570580);

    $jpg->setPixel($pixel, $color);

    $colorAtPixel = $jpg->getColorAt($pixel);
    expect($colorAtPixel)->toEqual($color);
});

it('can save image to a new path', function () {
    $jpg = new JPG(imgPath);
    $newPath = tempnam(sys_get_temp_dir(), 'steganography_');

    $jpg->saveToPath($newPath);

    $newJpg = new JPG($newPath);
    expect(file_exists($newPath))->toBe(true);
});

it('throws ImageException when creating image with invalid path', function () {
    $this->expectException(ImageException::class);

    $jpg = new JPG('invalid_path.jpg');
});

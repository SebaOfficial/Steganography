<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steganography</title>
</head>
<body>
    <h1>Steganography Example</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="image">Select JPG File:</label>
        <input type="file" name="image" accept="image/jpeg" required>
        <br>

        <label for="text">Enter Text:</label>
        <input type="text" name="text" required>
        <br>

        <input type="submit" value="Upload">
    </form>

    <?php
        require dirname(__DIR__) . "/vendor/autoload.php";

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK && isset($_POST['text'])) {
            try {
                move_uploaded_file($_FILES["image"]["tmp_name"], "upload.jpg");
                $source = new Steganography\Medium\Image\JPG("upload.jpg");
                $message = new Steganography\Message($_POST['text']);

                $encoder = new Steganography\Encoder($source, $message);
                $encoder->encode();

                echo <<<EOD
                    <h3>Encoded Image:</h3>
                    <img src="{$source->getPath()}" width=500 heigth=auto>
                    <br>
                EOD;

                $decoder = new Steganography\Decoder($source);
                echo "<p><b>Extracted Message: " . $decoder->decode() . "</b></p>";

            } catch (Steganography\Exception\SteganographyException $e) {
                echo "<p style='color:red;'>There was an error: " . $e->getMessage() . "</p>";
            }
        }
    ?>
</body>
</html>

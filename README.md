# Steganography
This PHP Steganography Library provides a simple and versatile tool for embedding and extracting hidden messages within digital images. Steganography is the art and science of concealing information within other non-secret data to avoid detection.

This library supports the hiding of text messages within image files, utilizing LSB (Least Significant Bit) manipulation to embed information without perceptibly altering the visual appearance of the image.


## 🛠 Installation
You can install the package via composer:
```bash
composer require seba/steganography
```

## ❔ Usage
* Examples can be found [here](examples/).

## 🫂 Contributing
We welcome contributions! If you find any bugs or have suggestions for improvements, please open an issue or submit a pull request.

## 📝 Testing

Run Unit tests:
```bash
composer test
```

Compare differences between images:
```bash
compare source.jpg destination.jpg difference.jpg
```
OR
```bash
compare -metric AE source.jpg source.jpg null:
```

## ⚖️ License
This project is under the [MIT License](LICENSE).

## 🧑‍💻 Contacts
For any inquiries or support, please contact sebastiano@racca.me or visit my [website](https://racca.me/contacts).

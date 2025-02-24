# LibSignPDF 

1.  [What is LibSignPDF?](#what-is-podofo)
2.  [Requirements](#requirements)
3.  [Development quickstart](#development-quickstart)
4.  [Authors](#authors)

## What is LibSignPDF?

LibSignPDF is a library to create signature annotation on PDF.

LibSignPDF provides a signature annotation for invisible signature and visible signature.
This library also support PAdES signature and multiple signature. This library not provide CMS. The CMS havee to provide in another system.

## Requirements

To build LibSignPDF lib you'll need:

* qpdf

## Development quickstart

PoDoFo is known to compile through a multitude of package managers (including `apt-get`, [brew](https://brew.sh/), [vcpkg](https://vcpkg.io/), [Conan](https://conan.io/)), and has public continuous integration working in [Ubuntu Linux](https://github.com/podofo/podofo/blob/master/.github/workflows/build-linux.yml), [MacOS](https://github.com/podofo/podofo/blob/master/.github/workflows/build-linux.yml) and
[Windows](https://github.com/podofo/podofo/blob/master/.github/workflows/build-win.yml), bootstrapping the CMake project, building and testing the library. It's highly recommended to build PoDoFo using such package managers. 

There's also a playground area in the repository where you can have
access to pre-build dependencies for some popular architectures/operating systems:
the playground is the recommended setting to develop the library and reproduce bugs,
while it's not recommended for the deployment of your application using PoDoFo.
Have a look to the [Readme](https://github.com/podofo/podofo/tree/master/playground) there.

> **Warning**: PoDoFo is known to be working in cross-compilation toolchains (eg. Android/iOS development), but support may not provided in such scenarios. If you decide to manually build dependencies you are assumed to know how to identity possible library clashes/mismatches and how to deal with compilation/linking problems that can arise in your system.

### Install package

From the composer project run:

```
composer require kampak/libsignpdf
```

### Example usage

This is an example code to use LibSignPDF library

```
use Kampak\LibSignPDF\SignPDF;

// This is the parameters that you need for generating CMS
$options = [
    'email' => "test@libsignpdf.com",
    'password' => "P@ssw0rd"
];

function signDigestFunction($digest, $options = []) {

    // START YOUR CODE
    // Please insert your code to get cms by sign the digest
    $yourCMS = "get_your_cms_from_your_server_by_sign_the_digest";

    // END YOUR CODE
    $buffer = FFI::new("char[" . (strlen($yourCMS) + 1) . "]", false);
    FFI::memcpy($buffer, $yourCMS, strlen($yourCMS));
    $buffer[strlen($yourCMS)] = "\0";
    $response = FFI::new("char *", false);
    $response = FFI::addr($buffer[0]);
    return $response;
}

// Create an instance of PDFSigner
$signer = new SignPDF("signDigestFunction", $options);

// Sign the PDF
$inputFile = "your_input_pdf_path";
$outputFile = "your_output_pdf_path";
$visualizationFile = "your_image_visualization_path";

$signer->signPDF(
    $inputFile, // input file
    $outputFile, // output file
    $visualizationFile, // visualization file
    "https://example.com", // url for QRCode
    1, // page will be place the signature
    1, // isPades signature
    0, // type od signature (0 for invisible, 1 for visible image, 2 for visible QRCode)
    100.0, // x position on pdf for place visualization of signature (start on bottom left)
    200.0, // y position on pdf for place visualization of signature (start on bottom left)
    300.0, // width of visualization for place signature (start on bottom left)
    400.0 // height of visualization for place signature (start on bottom left)
);
```

## Authors

> **Warning**: Please don't use personal email addresses for technical support inquries, but create
github [issues](https://github.com/libsignpdf/libsignpdf-php/issues) instead.

LibSignPDF is currently developed and maintained by
[LibSignPDF](mailto:libsignpdf@gmail.com), together with LibSignPDF and others. See the file


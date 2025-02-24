<?php
require __DIR__ . '/../vendor/autoload.php'; // Load Composer autoload

use Kampak\LibSignPDF\SignPDF;

$options = [
    'email' => "test@libsignpdf.com",
    'password' => "P@ssw0rd"
];

function signDigestFunction($digest, $options = []) {

    // START YOUR CODE
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
$inputFile = realpath(__DIR__ . "/../input/sample.pdf");
$outputFile = "../output/output.pdf";
$visualizationFile = realpath(__DIR__ . "/../input/visualization.png");

$signer->signPDF(
    $inputFile,
    $outputFile,
    $visualizationFile,
    "https://example.com",
    1, 1, 0, 100.0, 200.0, 300.0, 400.0
);

?>

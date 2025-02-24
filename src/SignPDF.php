<?php

namespace Kampak\LibSignPDF;

use FFI;

function getLibraryPath() {
    $system = php_uname("s");
    $machine = php_uname("m");
    $currentDir = getcwd();
    $libPath = "";

    if (stripos($system, "Darwin") !== false) { 
        if ($machine === "x86_64") {
            $libPath = realpath(__DIR__ . "/../lib/libsignpdf_x86.dylib");
        } elseif ($machine === "arm64") {
            $libPath = realpath(__DIR__ . "/../lib/libsignpdf_arm.dylib");
        } else {
            return "Unsupported macOS architecture: $machine";
        }
    } elseif (stripos($system, "Linux") !== false) {
        $libPath = realpath(__DIR__ . "/../lib/libsignpdf.so");
    } elseif (stripos($system, "Windows") !== false) {
        $libPath = realpath(__DIR__ . "/../lib/libsignpdf.dll");
    } else {
        return "Unsupported OS: $system";
    }

    return $libPath;
}

class SignPDF {
    private $libsign;
    private $customFunction;
    private $callbackPointer;
    private $options;

    public function __construct(callable $customFunction, $options = []) {
        $libPath = getLibraryPath();
        $this->libsign = FFI::cdef("
            typedef char* (*SignDigestCallback)(const char*);

            void pdf_sign(
                const char* inputPath, const char* outputPath, const char* imagePath, const char* url,
                int page, int isPades, int typ,
                double x, double y, double rect_width, double rect_height,
                SignDigestCallback callback
            );
        ", $libPath);

        $this->customFunction = $customFunction;
        $this->options = $options;

        $this->callbackPointer = function ($digest) {
            return ($this->customFunction)($digest, $this->options);
        };
    }

    public function signPDF($inputPath, $outputPath, $imagePath, $url, $page, $isPades, $typ, $x, $y, $width, $height) {
        $this->libsign->pdf_sign(
            $inputPath, $outputPath, $imagePath, $url,
            $page, $isPades, $typ,
            $x, $y, $width, $height,
            $this->callbackPointer
        );
    }
}

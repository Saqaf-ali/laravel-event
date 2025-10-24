<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGeneratorService
{
    public function generate($text, int $size = 400, ?string $logoPath = null)
    {
        // Set default logo path if not provided
        if ($logoPath === null) {
            $logoPath = public_path('logo.png');
        }
        $text = 'dddd';
        $builder = new Builder(
            writer: new PngWriter(),
            data: $text,

            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: $size,
            margin: 10,
            logoPath: $logoPath,
            logoResizeToWidth: 60,
            logoPunchoutBackground: true,
        );

        return $builder->build();
    }
}

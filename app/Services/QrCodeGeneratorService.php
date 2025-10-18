<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Endroid\QrCode\Writer\SvgWriter;

class QrCodeGeneratorService
{
    public function generate(string $text, int $size = 400): ResultInterface
    {
        $builder = new Builder(
            writer: new SvgWriter(), // استخدام SvgWriter لضمان الاستقرار وعدم الاعتماد على امتداد GD/Imagick
            data: $text,
            size: $size,
        );

        return $builder->build();
    }
}

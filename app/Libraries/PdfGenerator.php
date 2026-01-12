<?php

namespace App\Libraries;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Arial');

        $this->dompdf = new Dompdf($options);
    }

    public function generate($html, $filename = 'document.pdf', $paper = 'A4', $orientation = 'portrait')
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper, $orientation);
        $this->dompdf->render();

        return $this->dompdf->stream($filename, ['Attachment' => false]);
    }

    public function preview($html, $filename = 'document.pdf', $paper = 'A4', $orientation = 'portrait')
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper, $orientation);
        $this->dompdf->render();

        return $this->dompdf->stream($filename, ['Attachment' => false]);
    }
}

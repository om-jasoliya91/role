<?php

namespace App\Libraries;

class PdfGenerator
{
    public function generate($html, $paperSize = 'A4', $orientation = 'portrait', $stream = false, $filename = 'document.pdf')
    {
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->setPaper($paperSize, $orientation);
        $dompdf->loadHtml($html);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename, ['Attachment' => 0]);
        } else {
            return $dompdf->output();
        }
    }
}

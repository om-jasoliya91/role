<?php

namespace App\Libraries;

class PdfGenerator
{
 public function generate($html, $paperSize = 'A4', $orientation = 'portrait', $stream = false, $filename = 'document.pdf')
{
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paperSize, $orientation);
    $dompdf->render();

    if ($stream) {
        // Stream to browser, inline display
        $dompdf->stream($filename, ['Attachment' => 0]);
        return null;
    }

    return $dompdf->output();
}


}

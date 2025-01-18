<?php
require_once('TCPDF-main/tcpdf.php');

class PDFHelper {
    public $pdf;
    public $html_content;

    public function __construct() {
        $this->pdf = new TCPDF();
        $this->html_content = '';

        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);

        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Lukas Kemfertas');
        $this->pdf->SetTitle('Kelionės maršrutas');
        $this->pdf->SetSubject('Kelionės planas');


        $this->pdf->AddPage('L', 'A4');

        $this->pdf->SetFont('dejavusans', '', 12);
    }

    public function append($content) {
        $this->html_content .= $content;
    }

    public function output($filename) {
        $this->pdf->writeHTML($this->html_content, true, false, true, false, '');

        $this->pdf->Output($filename, 'D');
    }

    public function addPage() {
        $this->pdf->AddPage('L', 'A4');
    }

    public function addLine() {
        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(10,  $this->pdf->GetY(), 200,  $this->pdf->GetY());
        $this->pdf->Ln(10);
    }
}
?>
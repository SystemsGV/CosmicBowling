<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use nguyenary\QRCodeMonkey\QRCode;

require(public_path('fpdf/fpdf.php'));

class TestView extends Controller
{
    public function index()
    {
        $title = 'Test';
        $qr = $this->generarQRTransparente('1240515151');

        // Crear una nueva instancia de FPDF
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();



        // Establecer la fuente
        $pdf->SetFont('Arial', 'B', 16);

        // Configuración del color de fondo
        $pdf->SetFillColor(177, 43, 119); // Color RGB para #b12b77

        // Dibuja el rectángulo
        $pdf->Rect(10, 10, 190, 30, 'F'); // x, y, width, height, 'F' para llenar el rectángulo

        // Establece el color de texto a blanco
        $pdf->SetTextColor(255, 255, 255); // Color RGB para blanco
        $pdf->Image(public_path('frontend/logo.png'), 12, 9, 30, 30);

        // Título
        $pdf->SetY(15); // Ajusta la posición Y para que el texto esté centrado en el rectángulo
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, 'COSMIC BOWLING', 0, 1, 'C');

        // Subtítulo
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 10, 'TICKET DE RESERVA', 0, 1, 'C');

        // Restaura el color de texto a negro (opcional)
        $pdf->SetTextColor(0, 0, 0); // Color RGB para negro

        // Crear un espacio
        $pdf->Ln(10);

        // Añadir la información del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'APELLIDOS Y NOMBRES:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, 'GORA RAMOS Marlon Emerson', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'DNI:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, '75214038', 0, 1);

        // Añadir la información del ticket
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'NRO TICKET:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, '#110758', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'PRECIO:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, 'S/. 96', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'FECHA ENTRADA:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, '31/10/2024', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'DETALLE:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, '31/10/2024', 0, 1);


        // Añadir el código QR
        $pdf->Ln(10);
        $pdf->Image($qr, 130, 46, 60, 60);

        // Añadir la fecha
        $pdf->Ln(60);


        // Salida del PDF
        $pdf->Output();
    }

    public function generarQRTransparente($texto)
    {
        $qrcode = new QRCode($texto);

        $qrcode->setConfig([
            'bgColor' => '',
            'body' => 'circular',
            'bodyColor' => '#0277bd',
            'brf1' => [],
            'brf2' => [],
            'brf3' => [],
            'erf1' => [],
            'erf2' => [],
            'erf3' => [],
            'eye' => 'frame13',
            'eye1Color' => '#000000',
            'eye2Color' => '#000000',
            'eye3Color' => '#000000',
            'eyeBall' => 'ball14',
            'eyeBall1Color' => '#000000',
            'eyeBall2Color' => '#000000',
            'eyeBall3Color' => '#000000',
            'gradientColor1' => '#000000',
            'gradientColor2' => '#000000',
            'gradientOnEyes' => 'true',
            'gradientType' => 'linear',
        ]);

        $qrcode->setSize(1000);
        $qrcode->setFileType('png');
        $imagenBase64 = $qrcode->create();

        return $imagenBase64;
    }
}

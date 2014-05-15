<?php

abstract class PDF_Generator {
	protected $data = array();
	abstract public function generate_and_show();
	public function set_data($data) { $this->data = $data; }
	public function get_data() { return $this->data; }
}

class FPDF_Generator extends PDF_Generator {
	private $FPDF_INC = 'third_party/fpdf17/fpdf.php';
	protected $pdf;

	private function init_pdf() {
		require_once APPPATH.$this->FPDF_INC;
		$this->pdf = new FPDF();
		$this->pdf->cMargin = 1;
		$this->pdf->AddPage();
	}

	protected function generate_pdf() { return null; }

	private function output_pdf() {
		$this->pdf->Output();
	}

	#Override
	public function generate_and_show() {
		$this->init_pdf();
		$this->generate_pdf();
		$this->output_pdf();
	}
}

class Pedido_PDF extends FPDF_Generator {
	private $encabezados_usuario = array('Usuario', 'Departamento', 'Encargado', 'Fecha', 'Hora');
	private $encabezados_pedido = array('No.', 'Imagen', 'Código', 'Descripción', 'Variante', 'Precio unitario', 'Cantidad', 'Subtotal');
	private $columns_width = array(10, 24, 24, 32, 25, 30, 20, 25);

	private function create_header() {
		$this->pdf->SetFont('Arial', 'B', 18);
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->MultiCell(80, 20, $this->data['nombre_tienda']);
		$this->pdf->SetXY($x + 80, $y);
		$this->pdf->SetFont('Arial', 'B', 15);
		$this->pdf->Cell(100, 20, "Detalle de pedido", false, true, 'R');
	}

	private function create_usuario_details_table() {
		# Encabezados
		$this->pdf->SetFont('Arial', 'B', 8.7);
		$this->pdf->SetFillColor(249, 249, 249);
		$this->pdf->SetDrawColor(221, 221, 221);
		foreach ($this->encabezados_usuario as $encabezado) {
			$this->pdf->Cell(38, 7, utf8_decode($encabezado), true, false, 'L', true);
		}
		$this->pdf->Ln();
		# Datos
		$this->pdf->SetFillColor(255, 255, 255);
		$this->pdf->SetDrawColor(221, 221, 221);
		$columnas = array( 
			$this->data['usuario_nombre'],
			$this->data['usuario_departamento'],
			$this->data['usuario_encargado'],
			$this->data['pedido_fecha'],
			$this->data['pedido_hora']
		);
		$this->pdf->SetFont('Arial', '', 8.7);
		$y = $this->pdf->GetY();
		foreach ($columnas as $columna) {
			$x = $this->pdf->GetX();
			$this->pdf->MultiCell(38, 7, utf8_decode($columna), true, 'L', true);
			$this->pdf->SetXY($x + 38, $y);
		}
		$this->pdf->Ln();
	}

	private function create_disclaimer() {
		$this->pdf->Ln();

		$y = $this->pdf->GetY();
		$this->pdf->SetFont('Arial', 'B', 7.5);
		$this->pdf->MultiCell(19, 4, 'Nota: ');

		$this->pdf->SetXY(19, $y);
		$this->pdf->SetFont('Arial', '', 7.5);
		$texto = 
		"Los precios listados en la siguiente tabla son los precios que estaban vigentes en el momento en que este pedido fue elaborado. 
Los totales mostrados son calculados usando esos precios. Podrían diferir de los precios actuales de cada producto.";
		$this->pdf->MultiCell(0, 4, utf8_decode($texto), false, 'L');

		$this->pdf->Ln();
	}

	private function create_pedido_details_table() {
		# Encabezados
		$this->pdf->SetFont('Arial', 'B', 8.7);
		$this->pdf->SetFillColor(249, 249, 249);
		$this->pdf->SetDrawColor(221, 221, 221);
		for ($i=0; $i < sizeof($this->encabezados_pedido); $i++) {
			$width = $i < sizeof($this->columns_width) ? $this->columns_width[$i] : 20;
			$encabezado =  utf8_decode($this->encabezados_pedido[$i]);
			$this->pdf->Cell($width, 7, $encabezado, true, false, 'L', true);	
		}
		$this->pdf->Ln();

		# Filas
		$this->pdf->SetFont('Arial', '', 8.7);
		$this->pdf->SetFillColor(255, 255, 255);
		
		foreach ($this->data['compras'] as $compra) {
			$imgsize = getimagesize($compra['imagen']);
			$height = $imgsize[1] * $width / $imgsize[0] - 0.2;

			for ($i=0; $i < sizeof($compra); $i++) {
				$width = $i < sizeof($this->columns_width) ? $this->columns_width[$i] : 20;
				$columna = utf8_decode(array_values($compra)[$i]);

				switch ($i) {
				case 1:	/* Mostrar imagen */
					$x = $this->pdf->GetX();
					$y = $this->pdf->GetY();
					$columna = $this->pdf->Image($columna, $x + 0.7, $y + 1, $this->columns_width[$i] - 1.5);
				default: /* Mostrar resto de las celdas */
					$x = $this->pdf->GetX();
					$y = $this->pdf->GetY();
					$this->pdf->MultiCell($width, $height, $columna, true);
					$this->pdf->SetXY($x + $width, $y);
				}

			}

			$this->pdf->Ln();
		}
		$this->pdf->Ln();
	}

	# Override
	protected function generate_pdf() {
		$this->create_header();
		$this->create_usuario_details_table();
		$this->create_disclaimer();
		$this->create_pedido_details_table();
	}
}

?>
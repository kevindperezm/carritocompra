<?php

class Report {
	private $data = array();
	private $generator;
	public function Report($generator) { $this->generator = $generator; }
	public function generate() { $this->generator->generate($this->data); }
	public function set_data($data) { $this->data = $data; }
	public function get_data() { return $this->data; }
	public function set_generator($generator) { $this->generator = $generator; }
	public function get_generator() { return $this->generator; }
}

# Generic_Generator
# Sirve como la clase base de todos los generadores de reportes.
class Generic_Generator {
	protected function init($data) { return null; }
	protected function header($data) { return null; }
	protected function body($data) { return null; }
	protected function footer($data) { return null; }
	protected function output($data) { return null; }
	public function generate($data) {
		$this->init($data);
		$this->header($data);
		$this->body($data);
		$this->footer($data);
		$this->output($data);
	}
}

# GenericePDF_Generator
# Sirve como la clase base de los generadores de reportes que generan archivos
# PDF. Utiliza fpdf.
# TODO: Actualizar y cambiar fpdf por tcpdf.
class GenericPDF_Generator extends Generic_Generator {
	private $FPDF_INC = 'third_party/fpdf17/fpdf.php';
	protected $pdf;
	protected function init($data) {
		require_once APPPATH.$this->FPDF_INC;
		$this->pdf = new FPDF();
		$this->pdf->cMargin = 1;
		$this->pdf->AddPage();
	}
	protected function output($data) {	$this->pdf->Output(); }
}

# PedidoPDF_Generator
# Generador de PDF's con información de un pedido.
class PedidoPDF_Generator extends GenericPDF_Generator {
	private $encabezados_usuario = array('Usuario', 'Departamento', 'Encargado', 'Fecha', 'Hora');
	private $encabezados_pedido = array('No.', 'Imagen', 'Código', 'Descripción', 'Variante', 'Precio unitario', 'Cantidad', 'Subtotal');
	private $columns_width = array(10, 24, 24, 32, 25, 30, 20, 25);

	private function create_header($data) {
		$this->pdf->SetFont('Arial', 'B', 18);
		$x = $this->pdf->GetX();
		$y = $this->pdf->GetY();
		$this->pdf->MultiCell(80, 20, $data['nombre_tienda']);
		$this->pdf->SetXY($x + 80, $y);
		$this->pdf->SetFont('Arial', 'B', 15);
		$this->pdf->Cell(100, 20, "Detalle de pedido", false, true, 'R');
	}

	private function create_usuario_details_table($data) {
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
			$data['usuario_nombre'],
			$data['usuario_departamento'],
			$data['usuario_encargado'],
			$data['pedido_fecha'],
			$data['pedido_hora']
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

	private function create_disclaimer($data) {
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

	private function create_pedido_details_table($data) {
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
		foreach ($data['compras'] as $compra) {
			$imgsize = getimagesize($compra['imagen']);
			$height = $imgsize[1] * $width / $imgsize[0] - 0.2;
			for ($i=0; $i < sizeof($compra); $i++) {
				$width = $i < sizeof($this->columns_width) ? $this->columns_width[$i] : 20;
				$columna = utf8_decode(array_values($compra)[$i]);
				switch ($i) {
				case 1:	/* Mostrar imagen */
					$x = $this->pdf->GetX();
					$y = $this->pdf->GetY();
					// var_dump($x);
					// var_dump($y);
					// var_dump($columna);
					// var_dump($imgsize);
					// var_dump($this->columns_width[$i]);
					// die();
					## TODO: Bug que impide mostrar imagen en tabla.
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
		## TODO: Mostrar cargo total por pedido calculado con los subtotales
		$this->pdf->Ln();
	}

	#Override
	protected function header($data) {
		$this->create_header($data);
	}

	#Override
	protected function body($data) {
		$this->create_usuario_details_table($data);
		$this->create_disclaimer($data);
		$this->create_pedido_details_table($data);
	}

	#Override
	protected function output($data) {
		$this->pdf->Output('detalles-pedido'.$data['pedido_fecha'], 'I');
	}
}

?>
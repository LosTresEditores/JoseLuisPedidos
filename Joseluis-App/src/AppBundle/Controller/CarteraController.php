<?php
	/**
	 * Created by PhpStorm.
	 * User: gilbe
	 * Date: 24/01/2018
	 * Time: 10:10 PM
	 */
	
	namespace AppBundle\Controller;
	
	
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use AppBundle\Services\Helpers;
	
	class CarteraController extends Controller
	{
		public function newAction(Request $request)
		{
		
		}
		
		public function listAction(Request $request)
		{
			$helpers = $this->get(helpers::class);
			
			$token = $request->get('authorization', null);
			$authCheck = $helpers->authCheck($token, false);
			
			if ($authCheck) {
				$identity = $helpers->authCheck($token, true);
				
				$em = $this->getDoctrine()->getManager();
				
				$dql = 'SELECT c FROM BackendBundle:Cartera c ORDER BY c.id DESC';
				$query = $em->createQuery($dql);
				
				$page = $request->query->getInt('page', 1);
				$paginator = $this->get('knp_paginator');
				$items_per_page = 10;
				
				$pagination = $paginator->paginate($query, $page, $items_per_page);
				$total_items_count = $pagination->getTotalItemCount();
				
				$data = array(
					'status' => 'success',
					'code' => 200,
					'msg' => 'Authorization is valid !!',
					'total_items_count' => $total_items_count,
					'page_actual' => $page,
					'items_per_page' => $items_per_page,
					'total_pages' => ceil($total_items_count / $items_per_page),
					'data' => $pagination
				);
			} else {
				$data = array(
					'status' => 'error',
					'code' => 400,
					'msg' => 'Authorization is not valid !!'
				);
			}
			
			return $helpers->json($data);
		}
		
		public function reportWeekAction(Request $request)
		{
			$helpers = $this->get(helpers::class);
			
			$token = $request->get('authorization', null);
			$authCheck = $helpers->authCheck($token, false);
			
			if ($authCheck) {
				$identity = $helpers->authCheck($token, true);
				
				$em = $this->getDoctrine()->getManager();
				
				$hoy = getdate();
				$year = $year = substr($hoy['year'], 2);
				$mon = sprintf("%'.02d", $hoy['mon']);
				$mday = sprintf("%'.02d", $hoy['mday']);
				$hour = sprintf("%'.02d", $hoy['hours']);
				$min = sprintf("%'.02d", $hoy['minutes']);
				$seg = sprintf("%'.02d", $hoy['seconds']);
				
				$pdf = new \FPDF('L', 'mm', 'letter');
				
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',16);
				$pdf->SetTextColor(40,40,40);
				$pdf->SetDrawColor(30,30,30);
				
				$pdf->Image('./assets/images/company/Logo_06.png',10,5,30,35);
				
				$cartera = $em->getRepository('BackendBundle:Cartera')->findAll();
				
				$carteraSeller = array();
				
				foreach ($cartera as $key_1 => $val_1)
				{
					$carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['name'] = $val_1->getIdOrder()->getIdSeller()->getName() . ' ' . $val_1->getIdOrder()->getIdSeller()->getSurname();
					if (!isset($carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['total']))
						$carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['total'] = $val_1->getValor();
					else
						$carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['total'] += $val_1->getValor();
					// return $helpers->json($carteraSeller);
				}
				
				$pdf->setXY(80, 10);
				$pdf->Cell(120,10,'CUENTAS POR COBRAR', 0, 1, 'C', 0);
				$pdf->setX(80);
				$pdf->Cell(120,10,'INFORME SEMANAL DE CARTERA', 0, 0, 'C', 0);
				
				$ordArrayS = array();
				
				foreach ($carteraSeller as $key_1 => $val_1)
				{
					$nd = $em->getRepository('BackendBundle:NotaDebito')->findBy(
						array(
							'idSeller' => $key_1
						)
					);
					/*if ($key_1 == 11) {
						return $helpers->json($nd);
					}*/
					$nc = $em->getRepository('BackendBundle:NotaCredito')->findBy(
						array(
							'idSeller' => $key_1
						)
					);
					$co = $em->getRepository('BackendBundle:Consignacion')->findBy(
						array(
							'idSeller' => $key_1
						)
					);
					
					$NDTotal = 0.0;
					$cont = 0;
					if ($nd != null) {
						foreach ($nd as $ndKey_1 => $ndVal_1)
						{
							$NDTotal = $NDTotal + $ndVal_1->getValor();
						}
					}
					
					$NCTotal = 0.0;
					if ($nc != null) {
						foreach ($nc as $ncKey_1 => $ncVal_1)
						{
							$NCTotal += $ncVal_1->getValor();
						}
					}
					
					$COTotal = 0.0;
					if ($co != null) {
						foreach ($co as $coKey_1 => $coVal_1)
						{
							$COTotal += $coVal_1->getValor();
						}
					}
					
					$carteraSeller[$key_1]['notadebito'] = $NDTotal;
					$carteraSeller[$key_1]['notacredito'] = $NCTotal;
					$carteraSeller[$key_1]['consignacion'] = $COTotal;
					$carteraSeller[$key_1]['saldo'] = ($carteraSeller[$key_1]['total'] + $NDTotal) - ($COTotal + $NCTotal) ;
					$ordArrayS[$key_1] =  $carteraSeller[$key_1]['total'];
				}
				
				array_multisort($ordArrayS, SORT_DESC, SORT_NUMERIC, $carteraSeller);
				
				$pdf->SetFillColor(230,230,230);
				$pdf->SetFont('Arial','B',10);
				
				$pdf->setXY(10, 40);
				$pdf->Cell(70,10,'DISTRIBUIDOR', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'ENERO 6', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'ENERO 13', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'ENERO 20', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'ENERO 27', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'CONSIGNACIONES', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'VENTA ANUAL', 1, 0, 'C', 1);
				
				$dx = 10;
				$dy = 50;
				
				$ts1 = 0;
				$ts2 = 0;
				$ts3 = 0;
				$ts4 = 0;
				$con = 0;
				$van = 0;
				$consec = 0;
				foreach ($carteraSeller as $key_1 => $val_1)
				{
					foreach ($val_1 as $key_2 => $val_2)
					{
						$pdf->setXY($dx, $dy);
						if ($key_2 == 'name') {
							$consec++;
							$pdf->Cell(5,5,$consec, 1, 0, 'C', 0);
							$pdf->Cell(65,5,$val_2, 1, 0, 'C', 0);
							$pdf->Cell(30,5,'0', 1, 0, 'C', 0);
							$pdf->Cell(30,5,'0', 1, 0, 'C', 0);
							$pdf->Cell(30,5,'0', 1, 0, 'C', 0);
						}
						if ($key_2 == 'saldo') {
							$pdf->setXY(170, $dy);
							$pdf->Cell(30,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							if ($val_2 > 0 )
								$ts4 += $val_2;
						}
						if ($key_2 == 'consignacion') {
							$pdf->setXY(200, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$con += $val_2;
						}
						if ($key_2 == 'total') {
							$pdf->setXY(235, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$van += $val_2;
						}
					}
					$dy += 5;
				}
				$pdf->setXY(10, $dy);
				$pdf->Cell(70,7,'TOTAL GENERAL', 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($ts1, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($ts2, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($ts3, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($ts4, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($con, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($van, 0, '.', ','), 1, 0, 'C', 1);
				
				
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',16);
				$pdf->SetTextColor(40,40,40);
				$pdf->SetDrawColor(30,30,30);
				
				$pdf->Image('./assets/images/company/Logo_06.png',10,2,30,35);
				$pdf->setXY(80, 10);
				$pdf->Cell(120,10,'CUENTAS POR COBRAR', 0, 1, 'C', 0);
				$pdf->setX(80);
				$pdf->Cell(120,10,'INFORME SEMANAL DE CARTERA DETALLADA', 0, 0, 'C', 0);
				$pdf->SetFillColor(230,230,230);
				$pdf->SetFont('Arial','B',10);
				
				$pdf->setXY(10, 40);
				$pdf->Cell(70,10,'DISTRIBUIDOR', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'NOTAS DEBITO', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'NOTAS CREDITO', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'CONSIGNACIONES', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'SALDO', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'VENTA ANUAL', 1, 0, 'C', 1);
				
				$dx = 10;
				$dy = 50;
				
				$tnd = 0;
				$tnc = 0;
				$con = 0;
				$sal = 0;
				$van = 0;
				
				$consec = 0;
				
				$ordArray = array();
				foreach ($carteraSeller as $key_1 => $val_1)
				{
					foreach ($val_1 as $key_2 => $val_2)
					{
						$pdf->setXY($dx, $dy);
						if ($key_2 == 'name') {
							$consec++;
							$pdf->Cell(5,5,$consec, 1, 0, 'C', 0);
							$pdf->Cell(65,5,$val_2, 1, 0, 'C', 0);
						}
						if ($key_2 == 'notadebito') {
							$pdf->setXY(80, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$tnd += $val_2;
						}
						if ($key_2 == 'notacredito') {
							$pdf->setXY(115, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$tnc += $val_2;
						}
						if ($key_2 == 'consignacion') {
							$pdf->setXY(150, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$con += $val_2;
						}
						if ($key_2 == 'saldo') {
							$pdf->setXY(185, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							if ($val_2 > 0)
								$sal += $val_2;
						}
						if ($key_2 == 'total') {
							$pdf->setXY(220, $dy);
							$pdf->Cell(35,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$van += $val_2;
							$ordArray[$key_1] = $van;
						}
					}
					$dy += 5;
				}
				// array_multisort($ordArray, $carteraSeller);
				$pdf->setXY(10, $dy);
				$pdf->Cell(70,7,'TOTAL GENERAL', 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($tnd, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($tnc, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($con, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($sal, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($van, 0, '.', ','), 1, 0, 'C', 1);
				
				$code_new = $year.$mon.$mday.$hour.$min.$seg;
				
				$route = './assets/reports/carteras/' . $year;
				if (!file_exists($route))
					mkdir($route, 0, true);
				$pdf->Output($route."/Cartera-" . $code_new . ".pdf","F");
				
				//$routeData = "http://localhost/JoseLuisSoftware/Joseluis-App/web/assets/reports/carteras/" . $year . "/Cartera-" . $code_new . ".pdf";
				$routeData = "http://192.168.0.10/Joseluis-App/web/assets/reports/carteras/" . $year . "/Cartera-" . $code_new . ".pdf";
				
				$data = array(
					'status' => 'success',
					'code' => 200,
					'data' => $routeData
				);
			} else {
				$data = array(
					'status' => 'error',
					'code' => 400,
					'msg' => 'Authorization is not valid !!'
				);
			}
			
			return $helpers->json($data);
		}
		
		public function reportDetailAction(Request $request, $id = null)
		{
			var_dump('aqui');die();
		}
		public function reportAgeAction(Request $request)
		{
			$helpers = $this->get(helpers::class);
			
			$token = $request->get('authorization', null);
			$authCheck = $helpers->authCheck($token, false);
			
			if ($authCheck) {
				$identity = $helpers->authCheck($token, true);
				
				$em = $this->getDoctrine()->getManager();
				
				$hoy = getdate();
				$year = $year = substr($hoy['year'], 2);
				$mon = sprintf("%'.02d", $hoy['mon']);
				$mday = sprintf("%'.02d", $hoy['mday']);
				$hour = sprintf("%'.02d", $hoy['hours']);
				$min = sprintf("%'.02d", $hoy['minutes']);
				$seg = sprintf("%'.02d", $hoy['seconds']);
				
				$pdf = new \FPDF('L', 'mm', 'letter');
				
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',16);
				$pdf->SetTextColor(40,40,40);
				$pdf->SetDrawColor(30,30,30);
				
				$pdf->Image('./assets/images/company/Logo_06.png',10,5);
				
				$cartera = $em->getRepository('BackendBundle:Cartera')->findBy(
					array(
						'pagado' => 'FALSE'
					)
				);
				
				$carteraSeller = array();
				
				foreach ($cartera as $key_1 => $val_1)
				{
					$carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['name'] = $val_1->getIdOrder()->getIdSeller()->getName() . ' ' . $val_1->getIdOrder()->getIdSeller()->getSurname();
					if (!isset($carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['total']))
						$carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['total'] = $val_1->getValor();
					else
						$carteraSeller[$val_1->getIdOrder()->getIdSeller()->getId()]['total'] += $val_1->getValor();
					// return $helpers->json($carteraSeller);
				}
				
				$pdf->setXY(80, 10);
				$pdf->Cell(120,10,'CUENTAS POR COBRAR', 0, 1, 'C', 0);
				$pdf->setX(80);
				$pdf->Cell(120,10,'INFORME POR FECHA DE VENCIMIENTO', 0, 0, 'C', 0);
				
				foreach ($carteraSeller as $key_1 => $val_1)
				{
					$nd = $em->getRepository('BackendBundle:NotaDebito')->findBy(
						array(
							'idSeller' => $key_1
						)
					);
					$nc = $em->getRepository('BackendBundle:NotaCredito')->findBy(
						array(
							'idSeller' => $key_1
						)
					);
					$co = $em->getRepository('BackendBundle:Consignacion')->findBy(
						array(
							'idSeller' => $key_1
						)
					);
					
					$NDTotal = 0.0;
					if ($nd != null) {
						foreach ($nd as $ndKey_1 => $ndVal_1)
						{
							if ($ndKey_1 == 'valor')
								$NDTotal += $ndVal_1->getValor();
						}
					}
					
					$NCTotal = 0.0;
					if ($nc != null) {
						foreach ($nc as $ncKey_1 => $ncVal_1)
						{
							if ($ncKey_1 == 'valor')
								$NCTotal += $ncVal_1->getValor();
						}
					}
					
					$COTotal = 0.0;
					if ($co != null) {
						foreach ($co as $coKey_1 => $coVal_1)
						{
							if ($coKey_1 == 'valor')
								$COTotal += $coVal_1->getValor();;
						}
					}
					
					$carteraSeller[$key_1]['notadebito'] = $NDTotal;
					$carteraSeller[$key_1]['notacredito'] = $NCTotal;
					$carteraSeller[$key_1]['consignacion'] = $COTotal;
					$carteraSeller[$key_1]['saldo'] = ($carteraSeller[$key_1]['total'] + $NDTotal) - ($COTotal + $NCTotal) ;
				}
				
				$pdf->SetFillColor(230,230,230);
				$pdf->SetFont('Arial','B',10);
				
				$pdf->setXY(10, 60);
				$pdf->Cell(70,10,'DISTRIBUIDOR', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'TOTAL', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'SIN VENCER', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'30 A 60 Dias', 1, 0, 'C', 1);
				$pdf->Cell(30,10,'60 A 90 Dias', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'90 A 120 Dias', 1, 0, 'C', 1);
				$pdf->Cell(35,10,'Mas de 120 Dias', 1, 0, 'C', 1);
				
				$dx = 10;
				$dy = 70;
				
				$ts1 = 0;
				$ts2 = 0;
				$ts3 = 0;
				$ts4 = 0;
				$con = 0;
				$van = 0;
				
				foreach ($carteraSeller as $key_1 => $val_1)
				{
					foreach ($val_1 as $key_2 => $val_2)
					{
						$pdf->setXY($dx, $dy);
						if ($key_2 == 'name') {
							$pdf->Cell(70,5,$val_2, 1, 0, 'C', 0);
						}
						if ($key_2 == 'total') {
							$pdf->setXY(80, $dy);
							$pdf->Cell(30,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$pdf->Cell(30,5,number_format($val_2, 0, '.', ','), 1, 0, 'C', 0);
							$pdf->Cell(30,5,number_format(0, 0, '.', ','), 1, 0, 'C', 0);
							$pdf->Cell(30,5,number_format(0, 0, '.', ','), 1, 0, 'C', 0);
							$pdf->Cell(35,5,number_format(0, 0, '.', ','), 1, 0, 'C', 0);
							$pdf->Cell(35,5,number_format(0, 0, '.', ','), 1, 0, 'C', 0);
							$van += $val_2;
						}
					}
					$dy += 5;
				}
				$pdf->setXY(10, $dy);
				$pdf->Cell(70,7,'TOTAL GENERAL', 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($van, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($van, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($ts1, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(30,7,number_format($ts1, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($ts1, 0, '.', ','), 1, 0, 'C', 1);
				$pdf->Cell(35,7,number_format($ts1, 0, '.', ','), 1, 0, 'C', 1);
				
				$code_new = $year.$mon.$mday.$hour.$min.$seg;
				
				$route = './assets/reports/carteras/' . $year;
				if (!file_exists($route))
					mkdir($route, 0, true);
				$pdf->Output($route."/Cartera-" . $code_new . ".pdf","F");
				
				//$routeData = "http://localhost/JoseLuisSoftware/Joseluis-App/web/assets/reports/carteras/" . $year . "/Cartera-" . $code_new . ".pdf";
				$routeData = "http://192.168.0.10/Joseluis-App/web/assets/reports/carteras/" . $year . "/Cartera-" . $code_new . ".pdf";
				
				$data = array(
					'status' => 'success',
					'code' => 200,
					'data' => $routeData
				);
			} else {
				$data = array(
					'status' => 'error',
					'code' => 400,
					'msg' => 'Authorization is not valid !!'
				);
			}
			
			return $helpers->json($data);
		}
	}
<?php
	/**
	 * Created by PhpStorm.
	 * User: gilbe
	 * Date: 1/02/2018
	 * Time: 9:42 AM
	 */
	
	namespace AppBundle\Controller;
	
	
	use BackendBundle\Entity\EmbalajePedido;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use AppBundle\Services\Helpers;
	
	class EmbalajeCajaPedidoController extends Controller
	{
		public function newAction(Request $request)
		{
			$helpers = $this->get(helpers::class);
			
			$token = $request->get('authorization', null);
			$authCheck = $helpers->authCheck($token);
			
			if ($authCheck) {
				$identity = $helpers->authCheck($token, true);
				
				$json = $request->get('json', null);
				
				if ($json != null) {
					$params = json_decode($json);
					
					$em = $this->getDoctrine()->getManager();
					
					$id_embalaje_caja = (isset($params->idEmbalajeCaja)) ? $params->idEmbalajeCaja : null;
					$id_order_detail = (isset($params->idOrderDetail)) ? $params->idOrderDetail : null;
					$description = (isset($params->description)) ? $params->description : null;
					$caja = (isset($params->caja)) ? $params->caja : null;
					$cantidad = (isset($params->cantidad)) ? $params->cantidad : null;
					
					if ($id_embalaje_caja != null) {
						$embalajeCaja = $em->getRepository('BackendBundle:EmbalajeCaja')->findOneBy(
							array(
								'id' => $id_embalaje_caja
							)
						);
					} else {
						$embalajeCaja = $id_embalaje_caja;
					}
					
					if ($id_order_detail != null) {
						$orderDetail = $em->getRepository('BackendBundle:OrderDetail')->findOneBy(
							array(
								'id' => $id_order_detail
							)
						);
					} else {
						$orderDetail = $id_order_detail;
					}
					
					if ($embalajeCaja != null && $orderDetail != null) {
						$embalajePedido = new EmbalajePedido();
						$embalajePedido->setIdEmbalajeCaja($embalajeCaja);
						$embalajePedido->setIdOrderDetail($orderDetail);
						$embalajePedido->setDescription($description);
						$embalajePedido->setCaja($caja);
						$embalajePedido->setCantidad($cantidad);
						
						$em->persist($embalajePedido);
						$em->flush();
						
						$data = array(
							'status' => 'success',
							'code' => 200,
							'msg' => 'New embalaje order created !!',
							'data' => $embalajePedido
						);
					} else {
						$data = array(
							'status' => 'error',
							'code' => 400,
							'msg' => 'Data incorrect !!'
						);
					}
				} else {
					$data = array(
						'status' => 'error',
						'code' => 400,
						'msg' => 'Json not valid !!'
					);
				}
			} else {
				$data = array(
					'status' => 'error',
					'code' => 400,
					'msg' => 'Authorization not valid !!'
				);
			}
			
			return $helpers->json($data);
		}
	}
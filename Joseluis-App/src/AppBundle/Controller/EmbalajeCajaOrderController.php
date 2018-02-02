<?php
	/**
	 * Created by PhpStorm.
	 * User: gilbe
	 * Date: 1/02/2018
	 * Time: 9:07 AM
	 */
	
	namespace AppBundle\Controller;
	
	
	use BackendBundle\Entity\EmbCajaOrder;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use AppBundle\Services\Helpers;
	
	class EmbalajeCajaOrderController extends Controller
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
					
					$id_embalaje = (isset($params->idEmbalaje)) ? $params->idEmbalaje : null;
					$id_order = (isset($params->idOrder)) ? $params->idOrder : null;
					$state = 'ACTIVO';
					
					if ($id_embalaje != null) {
						$embalaje = $em->getRepository('BackendBundle:Embalaje')->findOneBy(
							array(
								'id' => $id_embalaje
							)
						);
					} else {
						$embalaje = $id_embalaje;
					}
					
					if ($id_order != null) {
						$order = $em->getRepository('BackendBundle:Order')->findOneBy(
							array(
								'id' => $id_order
							)
						);
					} else {
						$order = $id_order;
					}
					
					if ($embalaje != null && $order != null) {
						$embalajeCajaOrder = new EmbCajaOrder();
						$embalajeCajaOrder->setIdEmbalaje($embalaje);
						$embalajeCajaOrder->setIdOrder($order);
						$embalajeCajaOrder->setState($state);
						
						$em->persist($embalajeCajaOrder);
						$em->flush();
						
						$data = array(
							'status' => 'success',
							'code' => 200,
							'msg' => 'New embalaje caja order created !!',
							'data' => $embalajeCajaOrder
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
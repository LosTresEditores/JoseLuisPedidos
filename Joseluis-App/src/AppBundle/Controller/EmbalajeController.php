<?php
	/**
	 * Created by PhpStorm.
	 * User: gilbe
	 * Date: 1/02/2018
	 * Time: 7:28 AM
	 */
	
	namespace AppBundle\Controller;
	
	
	use BackendBundle\Entity\Embalaje;
	use BackendBundle\Entity\EmbCajaOrder;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use AppBundle\Services\Helpers;
	
	class EmbalajeController extends Controller
	{
		public function newAction(Request $request, $id = null)
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
					
					$idUser = $em->getRepository('BackendBundle:User')->findOneBy(
						array(
							'id' => $identity->sub
						)
					);
					$id_order = $em->getRepository('BackendBundle:Order')->findOneBy(
						array(
							'code' => $id
						)
					);
					$guia = (isset($params->guia)) ? $params->guia : null;
					$createdAt = new \DateTime('now');
					$state = 'ACTIVO';
					
					$id_embalaje = $em->getRepository('BackendBundle:Embalaje')->findOneBy(
						array(
							'idOrder' => $id_order
						)
					);
					
					if ($id_embalaje)
					
					if ($idUser != null && $id_order != null) {
						$embalaje = new Embalaje();
						$embalaje->setIdOrder($id_order);
						$embalaje->setIdUser($idUser);
						$embalaje->setCreatedAt($createdAt);
						$embalaje->setState($state);
						
						$em->persist($embalaje);
						$em->flush();
						
						$stateEO = 'ACTIVO';
						
						$embalajeOrder = new EmbCajaOrder();
						$embalajeOrder->setIdEmbalaje($embalaje);
						$embalajeOrder->setIdOrder($id_order);
						$embalajeOrder->setState($stateEO);
						
						$em->persist($embalajeOrder);
						$em->flush();
						
						$data = array(
							'status' => 'success',
							'code' => 200,
							'msg' => 'New embalaje created !!',
							'data' => $embalaje,
							'dataEO' => $embalajeOrder
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
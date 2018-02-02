<?php
	/**
	 * Created by PhpStorm.
	 * User: gilbe
	 * Date: 1/02/2018
	 * Time: 9:07 AM
	 */
	
	namespace AppBundle\Controller;
	
	
	use BackendBundle\Entity\EmbalajeCaja;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\HttpFoundation\Request;
	use AppBundle\Services\Helpers;
	
	class EmbalajeCajaController extends Controller
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
					$description = (isset($params->description)) ? $params->description : null;
					$observation = (isset($params->observation)) ? $params->observation : null;
					$state = 'ACTIVO';
					
					$embalaje = $em->getRepository('BackendBundle:Embalaje')->findOneBy(
						array(
							'id' => $id_embalaje
						)
					);
					
					if ($embalaje != null) {
						$embalajeCaja = new EmbalajeCaja();
						$embalajeCaja->setIdEmbalaje($embalaje);
						$embalajeCaja->setDescription($description);
						$embalajeCaja->setObservation($observation);
						$embalajeCaja->setState($state);
						
						$em->persist($embalajeCaja);
						$em->flush();
						
						$data = array(
							'status' => 'success',
							'code' => 200,
							'msg' => 'New embalaje caja created !!',
							'data' => $embalajeCaja
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
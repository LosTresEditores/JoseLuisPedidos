<?php
/**
 * Created by PhpStorm.
 * User: Gilberto Guerrero Quinayas
 * Date: 01/12/2017
 * Time: 09:01 AM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\Cartera;
use BackendBundle\Entity\Order;
use BackendBundle\Entity\OrderDetail;
use BackendBundle\Entity\Product;
use BackendBundle\Entity\UserPerOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class OrderController extends Controller
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

                $id_seller = (isset($params->idSeller)) ? $params->idSeller : null;
                $id_school = (isset($params->idSchool)) ? $params->idSchool : null;
                $id_ship = (isset($params->idShip)) ? $params->idShip : null;
                $id_ship_type = (isset($params->idShipType)) ? $params->idShipType : null;
                $id_order_type = (isset($params->idOrderType)) ? $params->idOrderType : null;
                $id_city = (isset($params->idCity)) ? $params->idCity : null;
                $code = (isset($params->code)) ? $params->code : null;
                $previous_order = (isset($params->previousOrder)) ? $params->previousOrder : null;
                $createdAt = new \DateTime('now');
                $updatedAt = null;
                $canceledAt = null;
                /*$date_application = (isset($params->dateApplication)) ? $params->dateApplication : null;
	            $date_ship = (isset($params->dateShip)) ? $params->dateShip : null;
	            $date_return = (isset($params->dateReturn)) ? $params->dateReturn : null;*/
	            $date_application = null;
	            $date_ship = null;
	            $date_return = null;
                $observations = (isset($params->observations)) ? $params->observations : null;
                $ship_name = (isset($params->shipName)) ? $params->shipName : null;
                $ship_to = (isset($params->shipTo)) ? $params->shipTo : null;
                $ship_address = (isset($params->shipAddress)) ? $params->shipAddress : null;
                $ship_phone = (isset($params->shipPhone)) ? $params->shipPhone : null;
                $total = (isset($params->total)) ? $params->total : null;
	            $facturado = (isset($params->facturado)) ? $params->facturado : null;
                $state = (isset($params->state)) ? $params->state : null;
                
                if ($id_seller != null) {
                    $seller = $em->getRepository('BackendBundle:User')->findOneBy(
                        array(
                            'id' => $id_seller->id
                        )
                    );
                } else {
                    $seller = $id_seller;
                }

                if ($id_school != null) {
                    $school = $em->getRepository('BackendBundle:School')->findOneBy(
                        array(
                            'id' => $id_school
                        )
                    );
                } else {
                    $school = $id_school;
                }

                if ($id_ship != null) {
                    $ship = $em->getRepository('BackendBundle:Shipping')->findOneBy(
                        array(
                            'id' => $id_ship->id
                        )
                    );
                } else {
                    $ship = $id_ship;
                }

                if ($id_ship_type != null) {
                    $ship_type = $em->getRepository('BackendBundle:ShippingType')->findOneBy(
                        array(
                            'id' => $id_ship_type->id
                        )
                    );
                } else {
                    $ship_type = $id_ship_type;
                }

                if ($id_order_type != null) {
                    $order_type = $em->getRepository('BackendBundle:OrderType')->findOneBy(
                        array(
                            'id' => $id_order_type->id
                        )
                    );
                } else {
                    $order_type = $id_order_type;
                }

                if ($id_city != null) {
                    $city = $em->getRepository('BackendBundle:City')->findOneBy(
                        array(
                            'id' => $id_city
                        )
                    );
                } else {
                    $city = $id_city;
                }

                if ($seller != null) {
	                $user = $em->getRepository('BackendBundle:User')->findOneBy(
		                array(
			                'id' => $identity->sub
		                )
	                );
	                
                    $order = new Order();
                    $order->setIdUserperorder($user);
                    $order->setIdSeller($seller);
                    $order->setIdSchool($school);
                    $order->setIdShip($ship);
                    $order->setIdShipType($ship_type);
                    $order->setIdOrderType($order_type);
                    $order->setIdCity($city);
                    $order->setCode($code);
                    $order->setPreviousOrder($previous_order);
                    $order->setCreatedAt($createdAt);
                    $order->setUpdatedAt($updatedAt);
                    $order->setCanceledAt($canceledAt);
                    $order->setDateApplication($date_application);
                    $order->setDateShip($date_ship);
                    $order->setDateReturn($date_return);
                    $order->setObservations($observations);
                    $order->setShipName($ship_name);
                    $order->setShipTo($ship_to);
                    $order->setShipAddress($ship_address);
                    $order->setShipPhone($ship_phone);
                    $order->setTotal($total);
                    $order->setFacturado($facturado);
                    $order->setState($state);

                    $em->persist($order);
                    $em->flush();

                    $hoy = getdate();
                    $year = $year = substr($hoy['year'], 2);
                    $mon = sprintf("%'.02d", $hoy['mon']);
                    $mday = sprintf("%'.02d", $hoy['mday']);
                    $hour = sprintf("%'.02d", $hoy['hours']);
                    $min = sprintf("%'.02d", $hoy['minutes']);
                    $seg = sprintf("%'.02d", $hoy['seconds']);
                    $codeid = sprintf("%'.05d", $order->getId());
                    $codeoid = $order->getId();

                    $code_new = $year.$mon.$mday.$codeoid;
                    $order->setCode($code_new);
                    $em->persist($order);
                    $em->flush();

                    $process_state = $em->getRepository('BackendBundle:ProcessState')->findOneBy(
                        array(
                            'id' => 1
                        )
                    );

                    $upo_created = new \DateTime('now');
                    $upo_state = 'ACTIVO';

                    $user_per_order = new UserPerOrder();
                    $user_per_order->setIdOrder($order);
                    $user_per_order->setIdUser($user);
                    $user_per_order->setIdProcessState($process_state);
                    $user_per_order->setCreatedAt($upo_created);
                    $user_per_order->setState($upo_state);

                    $em->persist($user_per_order);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New order created !!',
                        'data' => $order
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
	
	public function copyAction(Request $request, $id = null)
	{
		$helpers = $this->get(helpers::class);
		
		$token = $request->get('authorization', null);
		$authCheck = $helpers->authCheck($token);
		
		if ($authCheck) {
			$identity = $helpers->authCheck($token, true);
			
			$json = $request->get('json', null);
			
			$em = $this->getDoctrine()->getManager();
			
			$order_type = $em->getRepository('BackendBundle:OrderType')->findOneBy(
				array(
					'id' => 2
				)
			);
			
			if ($order_type != null) {
				$user = $em->getRepository('BackendBundle:User')->findOneBy(
					array(
						'id' => $identity->sub
					)
				);
				
				$orderC = $em->getRepository('BackendBundle:Order')->findOneBy(
					array(
						'code' => $id
					)
				);
				
				$createdAt = new \DateTime('now');
				
				$order = new Order();
				$order->setIdUserperorder($user);
				$order->setIdSeller($orderC->getIdSeller());
				$order->setIdSchool($orderC->getIdSchool());
				$order->setIdShip($orderC->getIdShip());
				$order->setIdShipType($orderC->getIdShipType());
				$order->setIdOrderType($order_type);
				$order->setIdCity($orderC->getIdCity());
				$order->setPreviousOrder($orderC->getCode());
				$order->setCreatedAt($createdAt);
				$order->setObservations($orderC->getObservations());
				$order->setShipName($orderC->getShipName());
				$order->setShipTo($orderC->getShipTo());
				$order->setShipAddress($orderC->getShipAddress());
				$order->setShipPhone($orderC->getShipPhone());
				$order->setTotal($orderC->getTotal());
				$order->setFacturado($orderC->getFacturado());
				$order->setState('ACTIVO');
				
				$em->persist($order);
				$em->flush();
				
				$hoy = getdate();
				$year = $year = substr($hoy['year'], 2);
				$mon = sprintf("%'.02d", $hoy['mon']);
				$mday = sprintf("%'.02d", $hoy['mday']);
				$hour = sprintf("%'.02d", $hoy['hours']);
				$min = sprintf("%'.02d", $hoy['minutes']);
				$seg = sprintf("%'.02d", $hoy['seconds']);
				$codeid = sprintf("%'.05d", $order->getId());
				$codeoid = $order->getId();
				
				$code_new = $year.$mon.$mday.$codeoid;
				$order->setCode($code_new);
				$em->persist($order);
				$em->flush();
				
				$process_state = $em->getRepository('BackendBundle:ProcessState')->findOneBy(
					array(
						'id' => 1
					)
				);
				
				$upo_created = new \DateTime('now');
				$upo_state = 'ACTIVO';
				
				$user_per_order = new UserPerOrder();
				$user_per_order->setIdOrder($order);
				$user_per_order->setIdUser($user);
				$user_per_order->setIdProcessState($process_state);
				$user_per_order->setCreatedAt($upo_created);
				$user_per_order->setState($upo_state);
				
				$em->persist($user_per_order);
				$em->flush();
				
				$orderDetailC = $em->getRepository('BackendBundle:OrderDetail')->findBy(
					array(
						'idOrder' => $orderC
					)
				);
				
				$odState = 'ACTIVO';
				foreach ($orderDetailC as $key_1 => $val_1) {
					$orderDetail = new OrderDetail();
					$orderDetail->setIdOrder($order);
					$orderDetail->setIdProduct($val_1->getIdProduct());
					$orderDetail->setQuantityOrder($val_1->getQuantityOrder());
					$orderDetail->setState($odState);
					
					$em->persist($orderDetail);
					$em->flush();
					
					$product = $em->getRepository('BackendBundle:Product')->findOneBy(
						array(
							'id' => $val_1->getIdProduct()
						)
					);
					$new_order = $product->getNewOrder() + $val_1->getQuantityOrder();
					$product->setNewOrder($new_order);
					$em->persist($product);
					$em->flush();
				}
				
				$data = array(
					'status' => 'success',
					'code' => 200,
					'msg' => 'New order copied !!',
					'data' => $order
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
				'msg' => 'Authorization not valid !!'
			);
		}
		
		return $helpers->json($data);
	}
	
	public function copyCalificacionAction(Request $request, $id = null)
	{
		$helpers = $this->get(helpers::class);
		
		$token = $request->get('authorization', null);
		$authCheck = $helpers->authCheck($token);
		
		if ($authCheck) {
			$identity = $helpers->authCheck($token, true);
			
			$json = $request->get('json', null);
			
			$em = $this->getDoctrine()->getManager();
			
			$order_type = $em->getRepository('BackendBundle:OrderType')->findOneBy(
				array(
					'id' => 4
				)
			);
			
			if ($order_type != null) {
				$user = $em->getRepository('BackendBundle:User')->findOneBy(
					array(
						'id' => $identity->sub
					)
				);
				
				$orderC = $em->getRepository('BackendBundle:Order')->findOneBy(
					array(
						'code' => $id
					)
				);
				
				$createdAt = new \DateTime('now');
				
				$order = new Order();
				$order->setIdUserperorder($user);
				$order->setIdSeller($orderC->getIdSeller());
				$order->setIdSchool($orderC->getIdSchool());
				$order->setIdShip($orderC->getIdShip());
				$order->setIdShipType($orderC->getIdShipType());
				$order->setIdOrderType($order_type);
				$order->setIdCity($orderC->getIdCity());
				$order->setPreviousOrder($orderC->getCode());
				$order->setCreatedAt($createdAt);
				$order->setObservations($orderC->getObservations());
				$order->setShipName($orderC->getShipName());
				$order->setShipTo($orderC->getShipTo());
				$order->setShipAddress($orderC->getShipAddress());
				$order->setShipPhone($orderC->getShipPhone());
				$order->setTotal($orderC->getTotal());
				$order->setFacturado($orderC->getFacturado());
				$order->setState('ACTIVO');
				
				$em->persist($order);
				$em->flush();
				
				$hoy = getdate();
				$year = $year = substr($hoy['year'], 2);
				$mon = sprintf("%'.02d", $hoy['mon']);
				$mday = sprintf("%'.02d", $hoy['mday']);
				$hour = sprintf("%'.02d", $hoy['hours']);
				$min = sprintf("%'.02d", $hoy['minutes']);
				$seg = sprintf("%'.02d", $hoy['seconds']);
				$codeid = sprintf("%'.05d", $order->getId());
				$codeoid = $order->getId();
				
				$code_new = $year.$mon.$mday.$codeoid;
				$order->setCode($code_new);
				$em->persist($order);
				$em->flush();
				
				$process_state = $em->getRepository('BackendBundle:ProcessState')->findOneBy(
					array(
						'id' => 1
					)
				);
				
				$upo_created = new \DateTime('now');
				$upo_state = 'ACTIVO';
				
				$user_per_order = new UserPerOrder();
				$user_per_order->setIdOrder($order);
				$user_per_order->setIdUser($user);
				$user_per_order->setIdProcessState($process_state);
				$user_per_order->setCreatedAt($upo_created);
				$user_per_order->setState($upo_state);
				
				$em->persist($user_per_order);
				$em->flush();
				
				$orderDetailC = $em->getRepository('BackendBundle:OrderDetail')->findBy(
					array(
						'idOrder' => $orderC
					)
				);
				
				$odState = 'ACTIVO';
				foreach ($orderDetailC as $key_1 => $val_1) {
					$orderDetail = new OrderDetail();
					$orderDetail->setIdOrder($order);
					$orderDetail->setIdProduct($val_1->getIdProduct());
					$orderDetail->setQuantityOrder($val_1->getQuantityOrder());
					$orderDetail->setState($odState);
					
					$em->persist($orderDetail);
					$em->flush();
					
					$product = $em->getRepository('BackendBundle:Product')->findOneBy(
						array(
							'id' => $val_1->getIdProduct()
						)
					);
					$new_order = $product->getNewOrder() + $val_1->getQuantityOrder();
					$product->setNewOrder($new_order);
					$em->persist($product);
					$em->flush();
				}
				
				$data = array(
					'status' => 'success',
					'code' => 200,
					'msg' => 'New order copied !!',
					'data' => $order
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
				'msg' => 'Authorization not valid !!'
			);
		}
		
		return $helpers->json($data);
	}

    public function editAction(Request $request, $id = null)
    {
        $helpers = $this->get(helpers::class);

        $em = $this->getDoctrine()->getManager();

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $json = $request->get('json', null);

            if ($json != null) {
                $params = json_decode($json);

                $em = $this->getDoctrine()->getManager();
	
	            $id_seller = (isset($params->idSeller)) ? $params->idSeller : null;
	            $id_school = (isset($params->idSchool)) ? $params->idSchool : null;
	            $id_ship = (isset($params->idShip)) ? $params->idShip : null;
	            $id_ship_type = (isset($params->idShipType)) ? $params->idShipType : null;
	            $id_order_type = (isset($params->idOrderType)) ? $params->idOrderType : null;
	            $id_city = (isset($params->idCity)) ? $params->idCity : null;
                $code = (isset($params->code)) ? $params->code : null;
                $previous_order = (isset($params->previous_order)) ? $params->previous_order : null;
                $updatedAt = new \DateTime('now');
                $date_application = (isset($params->date_application)) ? $params->date_application : null;
                $date_ship = (isset($params->date_ship)) ? $params->date_ship : null;
                $date_return = (isset($params->date_return)) ? $params->date_return : null;
	            $observations = (isset($params->observations)) ? $params->observations : null;
                $ship_name = (isset($params->ship_name)) ? $params->ship_name : null;
                $ship_to = (isset($params->ship_to)) ? $params->ship_to : null;
                $ship_address = (isset($params->ship_address)) ? $params->ship_address : null;
                $ship_phone = (isset($params->ship_phone)) ? $params->ship_phone : null;
                $total = (isset($params->total)) ? $params->total : null;
	            $facturado = (isset($params->facturado)) ? $params->facturado : null;
                $state = (isset($params->state)) ? $params->state : null;
	
	            if ($id_seller != null) {
		            $seller = $em->getRepository('BackendBundle:User')->findOneBy(
			            array(
				            'id' => $id_seller
			            )
		            );
	            } else {
		            $seller = $id_seller;
	            }
	
	            if ($id_school != null) {
		            $school = $em->getRepository('BackendBundle:School')->findOneBy(
			            array(
				            'id' => $id_school
			            )
		            );
	            } else {
		            $school = $id_school;
	            }
	
	            if ($id_ship != null) {
		            $ship = $em->getRepository('BackendBundle:Shipping')->findOneBy(
			            array(
				            'id' => $id_ship
			            )
		            );
	            } else {
		            $ship = $id_ship;
	            }
	
	            if ($id_ship_type != null) {
		            $ship_type = $em->getRepository('BackendBundle:ShippingType')->findOneBy(
			            array(
				            'id' => $id_ship_type
			            )
		            );
	            } else {
		            $ship_type = $id_ship_type;
	            }
	
	            if ($id_order_type != null) {
		            $order_type = $em->getRepository('BackendBundle:OrderType')->findOneBy(
			            array(
				            'id' => $id_order_type
			            )
		            );
	            } else {
		            $order_type = $id_order_type;
	            }
	
	            if ($id_city != null) {
		            $city = $em->getRepository('BackendBundle:City')->findOneBy(
			            array(
				            'id' => $id_city
			            )
		            );
	            } else {
		            $city = $id_city;
	            }

                if ($seller != null) {
                    $order = $em->getRepository('BackendBundle:Order')->findOneBy(
                        array(
                            'id' => $id
                        )
                    );

                    $order->setIdSeller($seller);
                    $order->setIdSchool($school);
                    $order->setIdShip($ship);
                    $order->setIdShipType($ship_type);
                    $order->setIdOrderType($order_type);
                    $order->setIdCity($city);
                    $order->setCode($code);
                    $order->setPreviousOrder($previous_order);
                    $order->setUpdatedAt($updatedAt);
                    $order->setDateApplication($date_application);
                    $order->setDateShip($date_ship);
                    $order->setDateReturn($date_return);
                    $order->setObservations($observations);
                    $order->setShipName($ship_name);
                    $order->setShipTo($ship_to);
                    $order->setShipAddress($ship_address);
                    $order->setShipPhone($ship_phone);
                    $order->setTotal($total);
                    $order->setFacturado($facturado);
                    $order->setState($state);

                    if ($state == 'DESPACHO') {
                        $od = $em->getRepository('BackendBundle:OrderDetail')->findBy(
                            array(
                                'idOrder' => $id,
                                'state' => 'ACTIVO'
                            )
                        );

                        if (count($od) > 0) {
                            $data = array(
                                'status' => 'error',
                                'code' => 202,
                                'msg' => 'No se han procesado todas las solicitudes !!',
                                'data' => $order
                            );
                        } else {
                            $em->persist($order);
                            $em->flush();

                            $user = $em->getRepository('BackendBundle:User')->findOneBy(
                                array(
                                    'id' => $identity->sub
                                )
                            );

                            $process_state = $em->getRepository('BackendBundle:ProcessState')->findOneBy(
                                array(
                                    'id' => 2
                                )
                            );

                            $upo_created = new \DateTime('now');
                            $upo_state = 'ACTIVO';

                            $user_per_order = new UserPerOrder();
                            $user_per_order->setIdOrder($order);
                            $user_per_order->setIdUser($user);
                            $user_per_order->setIdProcessState($process_state);
                            $user_per_order->setCreatedAt($upo_created);
                            $user_per_order->setState($upo_state);

                            $em->persist($user_per_order);
                            $em->flush();
	
                            if ($order->getFacturado() == "TRUE") {
	                            $odV = $em->getRepository('BackendBundle:OrderDetail')->findBy(
		                            array(
			                            'idOrder' => $id
		                            )
	                            );
	
	                            $createdAt = new \DateTime('now');
	                            $valor = 0;
	
	                            foreach ($odV as $key_1 => $val_1) {
		                            $valor = $valor + $val_1->getPriceOrder() + $val_1->getPricePremarcado() + $val_1->getPriceCalificado() + $val_1->getPricePlanb();
	                            }
	
	                            $cartera = new Cartera();
	                            $cartera->setIdOrder($order);
	                            $cartera->setValor($valor);
	                            $cartera->setCreatedAt($createdAt);
	                            $cartera->setState('ACTIVO');
	
	                            $em->persist($cartera);
	                            $em->flush();
                            }

                            $data = array(
                                'status' => 'success',
                                'code' => 200,
                                'msg' => 'Order updated !!',
                                'data' => $order
                            );
                        }
                    } else {
                        $em->persist($order);
                        $em->flush();

                        $user = $em->getRepository('BackendBundle:User')->findOneBy(
                            array(
                                'id' => $identity->sub
                            )
                        );

                        $process_state = $em->getRepository('BackendBundle:ProcessState')->findOneBy(
                            array(
                                'id' => 2
                            )
                        );

                        $upo_created = new \DateTime('now');
                        $upo_state = 'ACTIVO';

                        $user_per_order = new UserPerOrder();
                        $user_per_order->setIdOrder($order);
                        $user_per_order->setIdUser($user);
                        $user_per_order->setIdProcessState($process_state);
                        $user_per_order->setCreatedAt($upo_created);
                        $user_per_order->setState($upo_state);

                        $em->persist($user_per_order);
                        $em->flush();

                        $data = array(
                            'status' => 'success',
                            'code' => 200,
                            'msg' => 'Order updated !!',
                            'data' => $order
                        );
                    }
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
	
	public function deleteAction(Request $request, $id = null)
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

            $dql = 'SELECT o FROM BackendBundle:Order o ORDER BY o.id DESC';
            $query = $em->createQuery($dql);

            $page = $request->query->getInt('page', 1);
            $paginator = $this->get('knp_paginator');
            $items_per_page = 5;

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

    public function listRoleAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $role = $identity->role;
            $idOrderType = 0;
            if ($role == 1 || $role == 2 || $role == 5)
                $idOrderType = 0;
            if ($role == 3)
                $idOrderType = 2;
            if ($role == 4)
                $idOrderType = 1;
            if ($role == 6)
                $idOrderType = 3;
            if ($role == 7)
                $idOrderType = 4;

            $em = $this->getDoctrine()->getManager();

            if ($idOrderType == 0)
                $dql = "SELECT o FROM BackendBundle:Order o ORDER BY o.id DESC";
            else
                $dql = "SELECT o FROM BackendBundle:Order o WHERE o.idOrderType = $idOrderType AND o.state != 'DESPACHO' ORDER BY o.id DESC";
            $query = $em->createQuery($dql);

            $page = $request->query->getInt('page', 1);
            $paginator = $this->get('knp_paginator');
            $items_per_page = 5;

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

    public function searchAction(Request $request, $search = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            if ($search != null) {
                $dql = "SELECT o FROM BackendBundle:Order o WHERE o.code LIKE :search ORDER BY o.id DESC";
                $query = $em->createQuery($dql)
                    ->setParameter("search", "$search");
            } else {
                $dql = 'SELECT o FROM BackendBundle:Order o ORDER BY o.id DESC';
                $query = $em->createQuery($dql);
            }

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

    public function reportAction(Request $request, $id = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        $order = new Order();

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            $order = $em->getRepository('BackendBundle:Order')->findOneBy(
                array(
                    'id' => $id
                )
            );

            $orderDetails = $em->getRepository('BackendBundle:OrderDetail')->findBy(
                array(
                    'idOrder' => $order
                )
            );
	
            $hoy = getdate();
            $year = $year = substr($hoy['year'], 2);
            $mon = sprintf("%'.02d", $hoy['mon']);
            $mday = sprintf("%'.02d", $hoy['mday']);
            $hour = sprintf("%'.02d", $hoy['hours']);
            $min = sprintf("%'.02d", $hoy['minutes']);
            $seg = sprintf("%'.02d", $hoy['seconds']);
            $codeid = sprintf("%'.02d", $id);

            $pdf = new \FPDF();

            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(30,30,30);

            $pdf->Image('./assets/images/company/Logo_06.png',10,5);

            $pdf->setXY(80, 10);
            $pdf->Cell(120,10,$order->getCode(), 1, 0, 'C', 0);

            $pdf->setXY(80, 20);
            $pdf->Cell(120,30,' ', 1, 0, 'C', 0);

            $pdf->SetFont('Arial','B',8);
            $pdf->setXY(80, 20);
            $pdf->Cell(40,5,'APLICACION', 0, 0, 'C', 0);
            $pdf->setXY(120, 20);
            $pdf->Cell(40,5,'ENVIO', 0, 0, 'C', 0);
            $pdf->setXY(160, 20);
            $pdf->Cell(40,5,'RETORNO', 0, 0, 'C', 0);
	
	        $pdf->SetFont('Arial','',8);
            $pdf->setXY(80, 25);
            $pdf->Cell(40,5,$order->getDateApplication(), 0, 0, 'C', 0);
            $pdf->setXY(120, 25);
            $pdf->Cell(40,5,$order->getDateShip(), 0, 0, 'C', 0);
            $pdf->setXY(160, 25);
            $pdf->Cell(40,5,$order->getDateReturn(), 0, 0, 'C', 0);

            $pdf->SetFont('Arial','B',8);
            $pdf->setXY(80, 30);
            $pdf->Cell(60,5,'ENVIO', 0, 0, 'C', 0);
            $pdf->setXY(140, 30);
            $pdf->Cell(60,5,'ENVIADO A', 0, 0, 'C', 0);
	
	        $pdf->SetFont('Arial','',8);
	        $pdf->setXY(80, 35);
	        $pdf->Cell(60,5,$order->getShipName(), 0, 0, 'C', 0);
            $pdf->setXY(140, 35);
            $pdf->Cell(60,5,$order->getShipTo(), 0, 0, 'C', 0);
	
	        $pdf->SetFont('Arial','B',8);
            $pdf->setXY(80, 40);
            $pdf->Cell(60,5,'DIRECCION', 0, 0, 'C', 0);
            $pdf->setXY(140, 40);
            $pdf->Cell(60,5,'TELEFONO', 0, 0, 'C', 0);
	
	        $pdf->SetFont('Arial','',8);
	        $pdf->setXY(80, 45);
	        $pdf->Cell(60,5,$order->getShipAddress(), 0, 0, 'C', 0);
            $pdf->setXY(140, 45);
            $pdf->Cell(60,5,$order->getShipPhone(), 0, 0, 'C', 0);

            $pdf->SetFillColor(230,230,230);
	
	        $pdf->SetFont('Arial','B',8);
            $pdf->setXY(5, 60);
            $pdf->Cell(100,5,'DATOS DEL DISTRIBUIDOR', 1, 0, 'C', 1);

            $pdf->SetDrawColor(230,230,230);
	
	        $pdf->SetFont('Arial','',8);
            $pdf->setXY(5, 66);
            $pdf->Cell(95,5,'NOMBRE : ' . $order->getIdSeller()->getName() . ' ' . $order->getIdSeller()->getSurname(), 1, 0, 'L', 0);
            $pdf->setXY(5, 71);
            $pdf->Cell(95,5,'CIUDAD : ' . $order->getIdSeller()->getIdCity()->getDescription(), 1, 0, 'L', 0);
	        $pdf->SetFont('Arial','',7);
            $pdf->setXY(5, 76);
            $pdf->Cell(95,5,'DIRECCION : ' . iconv('UTF-8', 'windows-1252', $order->getIdSeller()->getAddress()), 1, 0, 'L', 0);
	        $pdf->SetFont('Arial','',8);
            $pdf->setXY(5, 81);
            $pdf->Cell(95,5,'TELEFONO : ' . $order->getIdSeller()->getPhone(), 1, 0, 'L', 0);
            $pdf->setXY(5, 86);
            $pdf->Cell(95,5,'EMAIL : ' . $order->getIdSeller()->getEmail(), 1, 0, 'L', 0);
            
            $pdf->SetDrawColor(30,30,30);
            
	        $pdf->SetFont('Arial','B',8);
            $pdf->setXY(110, 60);
            $pdf->Cell(95,5,'DATOS DEL COLEGIO', 1, 0, 'C', 1);
            
            $pdf->SetDrawColor(230,230,230);
            
            $deschool_1 = substr($order->getIdSchool()->getDescription(),0, 42);
            $deschool_2 = substr($order->getIdSchool()->getDescription(), 42 , 80);
	        $pdf->SetFont('Arial','',8);
            $pdf->setXY(110, 66);
            $pdf->Cell(95,5,'NOMBRE : ' . iconv('UTF-8', 'windows-1252', $deschool_1), 1, 0, 'L', 0);
            $pdf->setXY(110, 71);
            $pdf->Cell(95,5,iconv('UTF-8', 'windows-1252', $deschool_2), 1, 0, 'L', 0);
            $pdf->setXY(110, 76);
            $pdf->Cell(95,5,'CIUDAD : ' . $order->getIdSchool()->getIdCity()->getDescription(), 1, 0, 'L', 0);
	        $pdf->SetFont('Arial','',7);
            $pdf->setXY(110, 81);
            $pdf->Cell(95,5,'DIRECCION : ' . iconv('UTF-8', 'windows-1252', $order->getIdSchool()->getAddress()), 1, 0, 'L', 0);
	        $pdf->SetFont('Arial','',8);
            $pdf->setXY(110, 86);
            $pdf->Cell(95,5,'TELEFONO : ' . $order->getIdSchool()->getPhone(), 1, 0, 'L', 0);
            
	        $pdf->SetFont('Arial','B',8);
            $pdf->SetDrawColor(30,30,30);
            $pdf->setXY(5, 95);
            
            if ($order->getIdOrderType()->getId() == 1 || $order->getIdOrderType()->getId() == 2 || $order->getIdOrderType()->getId() == 5) {
	            $pdf->Cell(20,5,'ITEM', 1, 0, 'C', 1);
	            $pdf->Cell(30,5,'CODIGO', 1, 0, 'C', 1);
	            $pdf->Cell(100,5,'PRODUCTO', 1, 0, 'C', 1);
	            $pdf->Cell(25,5,'DESCRIPCION', 1, 0, 'C', 1);
	            $pdf->Cell(25,5,'CANTIDAD', 1, 0, 'C', 1);
            }
	
	        if ($order->getIdOrderType()->getId() == 3 || $order->getIdOrderType()->getId() == 4) {
		        $pdf->SetFont('Arial','B',7);
		        $pdf->Cell(20,5,'ITEM', 1, 0, 'C', 1);
		        $pdf->Cell(30,5,'CODIGO', 1, 0, 'C', 1);
		        $pdf->Cell(65,5,'PRODUCTO', 1, 0, 'C', 1);
		        $pdf->Cell(25,5,'DESCRIPCION', 1, 0, 'C', 1);
		        $pdf->Cell(20,5,'CANTIDAD', 1, 0, 'C', 1);
		        $pdf->Cell(20,5,'PREMARCADO', 1, 0, 'C', 1);
		        $pdf->Cell(20,5,'CALIFICACION', 1, 0, 'C', 1);
		        $pdf->SetFont('Arial','B',8);
	        }
	        
            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(230,230,230);
	        $pdf->SetFont('Arial','',8);

            $y = 101;
            $x = 5;
            $i = 0;
            foreach ($orderDetails as $key_1 => $val_1) {
            	$i++;
            	if ($i > 30){
		            $pdf->SetFont('Arial','',6);
		            $pdf->setXY($x, $y+10);
		            $pdf->Cell(20,5,'ELABORADO POR: ' . $order->getIdUserperorder()->getName() . ' ' . $order->getIdUserperorder()->getSurname() . ' ', 0, 0, 'L', 0);
		            $pdf->setXY($x, $y+13);
		            $pdf->Cell(20,5,'FECHA ELABORACION: ' . date_format($order->getCreatedAt(), 'Y-m-d H:i:s'), 0, 0, 'L', 0);
		            
		            $pdf->AddPage();
		            
		            $i = 0;
		            $y = 30;
		            $x = 5;
		
		            $pdf->SetFont('Arial','B',8);
		            $pdf->SetFillColor(230,230,230);
		            $pdf->SetDrawColor(30,30,30);
		            $pdf->setXY($x, $y);
		            
		
		            if ($order->getIdOrderType()->getId() == 1 || $order->getIdOrderType()->getId() == 2 || $order->getIdOrderType()->getId() == 5) {
			            $pdf->Cell(20,5,'ITEM', 1, 0, 'C', 1);
			            $pdf->Cell(30,5,'CODIGO', 1, 0, 'C', 1);
			            $pdf->Cell(100, 5, 'PRODUCTO', 1, 0, 'C', 1);
			            $pdf->Cell(25, 5, 'DESCRIPCION', 1, 0, 'C', 1);
			            $pdf->Cell(25, 5, 'CANTIDAD', 1, 0, 'C', 1);
		            }
		
		            if ($order->getIdOrderType()->getId() == 3 || $order->getIdOrderType()->getId() == 4) {
			            $pdf->SetFont('Arial','B',7);
			            $pdf->Cell(20,5,'ITEM', 1, 0, 'C', 1);
			            $pdf->Cell(30,5,'CODIGO', 1, 0, 'C', 1);
			            $pdf->Cell(65,5,'PRODUCTO', 1, 0, 'C', 1);
			            $pdf->Cell(25,5,'DESCRIPCION', 1, 0, 'C', 1);
			            $pdf->Cell(20,5,'CANTIDAD', 1, 0, 'C', 1);
			            $pdf->Cell(20,5,'PREMARCADO', 1, 0, 'C', 1);
			            $pdf->Cell(20,5,'CALIFICACION', 1, 0, 'C', 1);
			            $pdf->SetFont('Arial','B',8);
		            }
		
		            $pdf->SetFillColor(0,0,0);
		            $pdf->SetDrawColor(230,230,230);
		            $pdf->SetFont('Arial','',8);
		            $y = $y + 6;
	            }
                $pdf->setXY($x, $y);
                $pdf->Cell(20,5,$val_1->getId(), 1, 0, 'C', 0);
	            if ($order->getIdOrderType()->getId() == 1 || $order->getIdOrderType()->getId() == 2 || $order->getIdOrderType()->getId() == 5) {
		            $pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', $val_1->getIdProduct()->getCode()), 1, 0, 'C', 0);
		            $pdf->Cell(100, 5, iconv('UTF-8', 'windows-1252', $val_1->getIdProduct()->getDescription()), 1, 0, 'L', 0);
		            $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $val_1->getDescription()), 1, 0, 'C', 0);
		            $pdf->Cell(25, 5, $val_1->getQuantityOrder(), 1, 0, 'C', 0);
	            }
	            if ($order->getIdOrderType()->getId() == 3 || $order->getIdOrderType()->getId() == 4) {
		            $pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', $val_1->getIdProduct()->getCode()), 1, 0, 'C', 0);
		            $pdf->Cell(65, 5, iconv('UTF-8', 'windows-1252', $val_1->getIdProduct()->getDescription()), 1, 0, 'L', 0);
		            $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $val_1->getDescription()), 1, 0, 'C', 0);
		            $pdf->Cell(20, 5, $val_1->getQuantityOrder(), 1, 0, 'C', 0);
		            $pdf->Cell(20, 5, $val_1->getQuantityPremarcado(), 1, 0, 'C', 0);
		            $pdf->Cell(20, 5, $val_1->getQuantityCalificado(), 1, 0, 'C', 0);
	            }
                $x = 5;
                $y += 5;
            }

            $y += 5;
	        $pdf->SetFont('Arial','B',8);
            $pdf->setXY($x, $y);
            $pdf->Cell(30,5,'OBSERVACIONES', 0, 0, 'C', 0);
            
	        $obsOrder_1 = substr($order->getObservations(),0, 110);
	        $obsOrder_2 = substr($order->getObservations(), 110 , 110);
	        $obsOrder_3 = substr($order->getObservations(), 220 , 110);
	        
	        $pdf->SetFont('Arial','',8);
	        $pdf->setXY($x, $y);
            $pdf->Cell(190,20,$obsOrder_1, 0, 0, 'L', 0);
	        $pdf->setXY($x, $y+5);
	        $pdf->Cell(190,20,$obsOrder_2, 0, 0, 'L', 0);
	        $pdf->setXY($x, $y+10);
	        $pdf->Cell(190,20,$obsOrder_3, 0, 0, 'L', 0);
	
	        $pdf->SetFont('Arial','',6);
	        $pdf->setXY($x, $y+27);
            $pdf->Cell(20,5,'ELABORADO POR: ' . $order->getIdUserperorder()->getName() . ' ' . $order->getIdUserperorder()->getSurname() . ' ', 0, 0, 'L', 0);
	        $pdf->setXY($x, $y+30);
	        $pdf->Cell(20,5,'FECHA ELABORACION: ' . date_format($order->getCreatedAt(), 'Y-m-d H:i:s'), 0, 0, 'L', 0);

            $code_new = $id.'-'.$year.$mon.$mday.$codeid;

            $route = './assets/reports/orders/' . $id;
            if (!file_exists($route))
                mkdir($route, 0, true);
            $pdf->Output($route."/Order-" . $code_new . ".pdf","F");

            //$routeData = "http://localhost/JoseLuisSoftware/Joseluis-App/web/assets/reports/orders/" . $id . "/Order-" . $code_new . ".pdf";
	        $routeData = "http://192.168.0.10/Joseluis-App/web/assets/reports/orders/" . $id . "/Order-" . $code_new . ".pdf";

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
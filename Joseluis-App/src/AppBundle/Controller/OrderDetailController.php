<?php
/**
 * Created by PhpStorm.
 * User: 54-
 * Date: 01/12/2017
 * Time: 09:19 AM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\OrderDetail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class OrderDetailController extends Controller
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

                $id_order = (isset($params->id_order)) ? $params->id_order : null;
                $id_product = (isset($params->id_product)) ? $params->id_product : null;
                $description = (isset($params->description)) ? $params->description : null;
                $quantity_order = (isset($params->quantity_order)) ? $params->quantity_order : null;
                $quantity_premarcado = (isset($params->quantity_premarcado)) ? $params->quantity_premarcado : null;
                $quantity_calificado = (isset($params->quantity_calificado)) ? $params->quantity_calificado : null;
                $quantity_planb = (isset($params->quantity_planb)) ? $params->quantity_planb : null;
                $price_order = (isset($params->price_order)) ? $params->price_order : null;
                $price_premarcado = (isset($params->price_premarcado)) ? $params->price_premarcado : null;
                $price_calificado = (isset($params->price_calificado)) ? $params->price_calificado : null;
                $price_planb = (isset($params->price_planb)) ? $params->price_planb : null;
	            $facturado = (isset($params->facturado)) ? $params->facturado : null;
                $state = 'ACTIVO';

                if ($id_order != null) {
                    $order = $em->getRepository('BackendBundle:Order')->findOneBy(
                        array(
                            'id' => $id_order
                        )
                    );
                } else {
                    $order = $id_order;
                }

                if ($id_product != null) {
                    $product = $em->getRepository('BackendBundle:Product')->findOneBy(
                        array(
                            'id' => $id_product
                        )
                    );
                } else {
                    $product = $id_product;
                }

                if ($order != null && $product != null) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->setIdOrder($order);
                    $orderDetail->setIdProduct($product);
                    $orderDetail->setDescription($description);
                    $orderDetail->setQuantityOrder($quantity_order);
                    $orderDetail->setQuantityPremarcado($quantity_premarcado);
                    $orderDetail->setQuantityCalificado($quantity_calificado);
                    $orderDetail->setQuantityPlanb($quantity_planb);
                    $orderDetail->setPriceOrder($price_order);
                    $orderDetail->setPricePremarcado($price_premarcado);
                    $orderDetail->setPriceCalificado($price_calificado);
                    $orderDetail->setPricePlanb($price_planb);
                    $orderDetail->setFacturado($facturado);
                    $orderDetail->setState($state);

                    $em->persist($orderDetail);
                    $em->flush();

                    if ($order->getIdOrderType()->getId() == 1 || $order->getIdOrderType()->getId() == 2) {
                        $new_order = $product->getNewOrder() + $orderDetail->getQuantityOrder();
                        $product->setNewOrder($new_order);
                        $em->persist($product);
                        $em->flush();
                    }

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New order detail created !!',
                        'data' => $orderDetail
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

    public function editAction(Request $request, $id = null)
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

                $id_order = (isset($params->id_order)) ? $params->id_order : null;
                $id_product = (isset($params->id_product)) ? $params->id_product : null;
                $description = (isset($params->description)) ? $params->description : null;
                $quantity_order = (isset($params->quantity_order)) ? $params->quantity_order : null;
                $quantity_premarcado = (isset($params->quantity_premarcado)) ? $params->quantity_premarcado : null;
                $quantity_calificado = (isset($params->quantity_calificado)) ? $params->quantity_calificado : null;
                $quantity_planb = (isset($params->quantity_planb)) ? $params->quantity_planb : null;
                $price_order = (isset($params->price_order)) ? $params->price_order : null;
                $price_premarcado = (isset($params->price_premarcado)) ? $params->price_premarcado : null;
                $price_calificado = (isset($params->price_calificado)) ? $params->price_calificado : null;
                $price_planb = (isset($params->price_planb)) ? $params->price_planb : null;
                $facturado = (isset($params->facturado)) ? $params->facturado : null;
	            $state = (isset($params->state)) ? $params->state : null;

                if ($id_order != null && !is_object($id_order)) {
                    $order = $em->getRepository('BackendBundle:Order')->findOneBy(
                        array(
                            'id' => $id_order
                        )
                    );
                } else {
                    $order = $id_order;
                }

                if ($id_product != null && !is_object($id_product)) {
                    $product = $em->getRepository('BackendBundle:Product')->findOneBy(
                        array(
                            'id' => $id_product
                        )
                    );
                } else {
                    $product = $id_product;
                }

                if ($order != null && $product != null) {
                    $orderDetail = $em->getRepository('BackendBundle:OrderDetail')->findOneBy(
                        array(
                            'id' => $id
                        )
                    );
                    $orderDetail->setIdOrder($order);
                    $orderDetail->setIdProduct($product);
                    $orderDetail->setDescription($description);
                    $orderDetail->setQuantityOrder($quantity_order);
                    $orderDetail->setQuantityPremarcado($quantity_premarcado);
                    $orderDetail->setQuantityCalificado($quantity_calificado);
                    $orderDetail->setQuantityPlanb($quantity_planb);
                    $orderDetail->setPriceOrder($price_order);
                    $orderDetail->setPricePremarcado($price_premarcado);
                    $orderDetail->setPriceCalificado($price_calificado);
                    $orderDetail->setPricePlanb($price_planb);
	                $orderDetail->setFacturado($facturado);
                    $orderDetail->setState($state);

                    $em->persist($orderDetail);
                    $em->flush();

                    if ($orderDetail->getState() == 'PROCESADO') {
                        $new_order = $product->getNewOrder() - $orderDetail->getQuantityOrder();
                        $existence = $product->getExistence() - $orderDetail->getQuantityOrder();
                        $order_prod = $product->getOrderProducto() + $orderDetail->getQuantityOrder();
                        $product->setNewOrder($new_order);
                        $product->setExistence($existence);
                        $product->setOrderProducto($order_prod);
                        $em->persist($product);
                        $em->flush();
	
	                    $value_sp = $em->getRepository('BackendBundle:ValueSellerProduct')->findOneBy(
		                    array(
			                    'idSellerCategory' => $order->getIdSeller()->getIdSellerCategory()->getId(),
			                    'idProductCategory' => $product->getIdProductCategory()->getId()
		                    )
	                    );
	                    
	                    if ($order->getIdOrderType()->getId() == 1){
	                    	$vODtotal = $value_sp->getPriceProduct() * $orderDetail->getQuantityOrder();
		                    $orderDetail->setPriceOrder($vODtotal);
		                    $em->persist($orderDetail);
		                    $em->flush();
	                    }
	                    if ($order->getIdOrderType()->getId() == 2){
		                    $vODtotal = $value_sp->getPriceProduct() * $orderDetail->getQuantityOrder();
		                    $orderDetail->setPriceOrder($vODtotal);
		                    $em->persist($orderDetail);
		                    $em->flush();
	                    }
	                    if ($order->getIdOrderType()->getId() == 3){
		                    $vODtotal = $value_sp->getPricePremarcado() * $orderDetail->getQuantityPremarcado();
		                    //$cod = $orderDetail->getQuantityOrder();
		                    //$vODtotal = $value_sp->getPricePremarcado() * $orderDetail->getQuantityOrder();
		
		                    $vODtotal = $vODtotal - (($vODtotal * 10) / 100);
		
		                    //$orderDetail->setQuantityPremarcado($cod);
		                    $orderDetail->setPricePremarcado($vODtotal);
		                    $em->persist($orderDetail);
		                    $em->flush();
	                    }
	                    if ($order->getIdOrderType()->getId() == 4){
		                    $vODtotal = $value_sp->getPriceCalificado() * $orderDetail->getQuantityCalificado();
		                    //$vODtotal = $value_sp->getPriceCalificado() * $orderDetail->getQuantityOrder();
		                    $orderDetail->setPriceCalificado($vODtotal);
		                    $em->persist($orderDetail);
		                    $em->flush();
	                    }
	                    if ($order->getIdOrderType()->getId() == 5){
		                    $vODtotal = $value_sp->getPriceProduct() * $orderDetail->getQuantityOrder();
		                    $orderDetail->setPriceOrder($vODtotal);
		                    $em->persist($orderDetail);
		                    $em->flush();
	                    }
                    }

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'Edit order detail !!',
                        'data' => $orderDetail
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
	
	public function editOrderAction(Request $request, $id = null)
	{
		$helpers = $this->get(helpers::class);
		
		$token = $request->get('authorization', null);
		$authCheck = $helpers->authCheck($token);
		
		if ($authCheck) {
			$identity = $helpers->authCheck($token, true);
			
			$em = $this->getDoctrine()->getManager();
			
			$order = $em->getRepository('BackendBundle:Order')->findOneBy(
				array(
					'id' => $id
				)
			);
			
			if ($order != null) {
				$orderDetails = $em->getRepository('BackendBundle:OrderDetail')->findBy(
					array(
						'idOrder' => $order->getId()
					)
				);
				
				foreach ($orderDetails as $key_1 => $val_1)
				{
					if ($val_1->getState() == 'ACTIVO') {
						$product = $em->getRepository('BackendBundle:Product')->findOneBy(
							array(
								'id' => $val_1->getIdProduct()
							)
						);
						
						$new_order = $product->getNewOrder() - $val_1->getQuantityOrder();
						$existence = $product->getExistence() - $val_1->getQuantityOrder();
						$order_prod = $product->getOrderProducto() + $val_1->getQuantityOrder();
						$product->setNewOrder($new_order);
						$product->setExistence($existence);
						$product->setOrderProducto($order_prod);
						$em->persist($product);
						$em->flush();
						
						$value_sp = $em->getRepository('BackendBundle:ValueSellerProduct')->findOneBy(
							array(
								'idSellerCategory' => $order->getIdSeller()->getIdSellerCategory()->getId(),
								'idProductCategory' => $product->getIdProductCategory()->getId()
							)
						);
						
						if ($order->getIdOrderType()->getId() == 1){
							$vODtotal = $value_sp->getPriceProduct() * $val_1->getQuantityOrder();
							$val_1->setPriceOrder($vODtotal);
							$val_1->setState('PROCESADO');
						}
						if ($order->getIdOrderType()->getId() == 2){
							$vODtotal = $value_sp->getPriceProduct() * $val_1->getQuantityOrder();
							$val_1->setPriceOrder($vODtotal);
							$val_1->setState('PROCESADO');
						}
						if ($order->getIdOrderType()->getId() == 3){
							$vODtotal = $value_sp->getPricePremarcado() * $val_1->getQuantityPremarcado();
							//$vODtotal = $value_sp->getPricePremarcado() * $val_1->getQuantityOrder();
							
							// $cod = $val_1->getQuantityOrder();
							
							$vODtotal = $vODtotal - (($vODtotal * 10) / 100);
							// $val_1->setQuantityPremarcado($cod);
							$val_1->setPricePremarcado($vODtotal);
							$val_1->setState('PROCESADO');
						}
						if ($order->getIdOrderType()->getId() == 4){
							$vODtotal = $value_sp->getPriceCalificado() * $val_1->getQuantityCalificado();
							// $vODtotal = $value_sp->getPriceCalificado() * $val_1->getQuantityOrder();
							$val_1->setPriceCalificado($vODtotal);
							$val_1->setState('PROCESADO');
						}
						if ($order->getIdOrderType()->getId() == 5){
							$vODtotal = $value_sp->getPriceProduct() * $val_1->getQuantityOrder();
							$val_1->setPriceOrder($vODtotal);
							$val_1->setState('PROCESADO');
						}
					}
				}
				$j = 0;
				$i = sizeof($orderDetails);
				
				while (sizeof($orderDetails) <= sizeof($orderDetails)-1)
				{
					
					$orderDetail = $em->getRepository('BackendBundle:OrderDetail')->findBy(
						array(
							'id' => $orderDetails->getId()
						)
					);
					
					$orderDetail->setPriceOrder($orderDetails->getPriceOrder());
					$orderDetail->setState($orderDetails->getState());
					$em->persist($orderDetail);
					$em->flush();
					$j++;
					
					return $helpers->json($orderDetail);
				}
				
				$data = array(
					'status' => 'success',
					'code' => 200,
					'msg' => 'Edit order detail !!',
					'data' => $orderDetails
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
	
	public function editCaliidnAction(Request $request, $id = null)
	{
		$helpers = $this->get(helpers::class);
		
		$token = $request->get('authorization', null);
		$authCheck = $helpers->authCheck($token);
		
		if ($authCheck) {
			$identity = $helpers->authCheck($token, true);
			
			$json = $request->get('json', null);
			
			$em = $this->getDoctrine()->getManager();
			
			$params = json_decode($json);
			$id_order_detail = (isset($params->id)) ? $params->id : null;
			$id_product = (isset($params->id_product)) ? $params->id_product : null;
			
			$caliidn = $em->getRepository('BackendBundle:JlCaliidn')->findOneBy(
				array(
					'caliidn' => $id,
					'idProduct' => $id_product
				)
			);
			
			if ($caliidn != null) {
				if ($json != null) {
					
					$em = $this->getDoctrine()->getManager();
					
					$orderDetail = $em->getRepository('BackendBundle:OrderDetail')->findOneBy(
						array(
							'id' => $id_order_detail
						)
					);
					
					// $orderDetail->setIdCaliidn($caliidn);
					$orderDetail->setQuantityPremarcado($caliidn->getCountPS1());
					$orderDetail->setQuantityCalificado($caliidn->getCountCS1());
					$em->persist($orderDetail);
					$em->flush();
					
					$data = array(
						'status' => 'success',
						'code' => 200,
						'msg' => 'Edit order detail !!',
						'data' => $orderDetail
					);
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
 
	public function listAction(Request $request, $id = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            if ($id != null) {
                $dql = 'SELECT o FROM BackendBundle:OrderDetail o WHERE o.idOrder = ' . $id . ' ORDER BY o.id DESC';
                $query = $em->createQuery($dql);

                $page = $request->query->getInt('page', 1);
                $paginator = $this->get('knp_paginator');
                $items_per_page = 70;

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
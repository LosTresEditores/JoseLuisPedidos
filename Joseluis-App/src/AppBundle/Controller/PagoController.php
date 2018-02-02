<?php
/**
 * Created by PhpStorm.
 * User: Gilberto Guerrero Q
 * Date: 27/12/2017
 * Time: 10:26 PM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\Pago;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class PagoController extends Controller
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

                $id_seller = (isset($params->id_seller)) ? $params->id_seller : null;
                $description = (isset($params->description)) ? $params->description : null;
                $valor = (isset($params->valor)) ? $params->valor : null;
                $createdAt = new \DateTime('now');
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

                if ($id_seller != null && $valor != null) {
                    $pago = new Pago();
                    $pago->setIdSeller($seller);
                    $pago->setDescription($description);
                    $pago->setValor($valor);
                    $pago->setCreatedAt($createdAt);
                    $pago->setState($state);

                    $em->persist($pago);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New pago created !!',
                        'data' => $pago
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

                $id_seller = (isset($params->id_seller)) ? $params->id_seller : null;
                $description = (isset($params->description)) ? $params->description : null;
                $valor = (isset($params->valor)) ? $params->valor : null;
                $createdAt = new \DateTime('now');
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

                if ($id_seller != null && $valor != null) {
                    $pago = $em->getRepository('BackendBundle:Pago')->findOneBy(
                        array(
                            'id' => $id
                        )
                    );
                    $pago->setIdSeller($seller);
                    $pago->setDescription($description);
                    $pago->setValor($valor);
                    $pago->setCreatedAt($createdAt);
                    $pago->setState($state);

                    $em->persist($pago);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'Pago updated !!',
                        'data' => $pago
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

    public function listAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            $dql = 'SELECT p FROM BackendBundle:Pago p ORDER BY p.id DESC';
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
}
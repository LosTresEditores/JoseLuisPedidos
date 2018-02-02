<?php
/**
 * Created by PhpStorm.
 * User: 54-
 * Date: 01/12/2017
 * Time: 10:11 AM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\ProductWineries;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class ProductWineriesController extends Controller
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

                $id_wineries = (isset($params->idWineries)) ? $params->idWineries : null;
                $id_product = (isset($params->idProduct)) ? $params->idProduct : null;
                $created_at = new \DateTime('now');
                $description = (isset($params->description)) ? $params-> description : null;
                $quantity = (isset($params->quantity)) ? $params->quantity : null;
                $state = (isset($params->state)) ? $params->state : null;

                if ($id_wineries != null) {
                    $wineries = $em->getRepository('BackendBundle:Wineries')->findOneBy(
                        array(
                            'id' => $id_wineries
                        )
                    );
                } else {
                    $wineries = $id_wineries;
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

                $user = $em->getRepository('BackendBundle:User')->findOneBy(
                    array(
                        'id' => $identity->sub
                    )
                );

                if ($product != null) {
                    $productWineries = new ProductWineries();
                    $productWineries->setIdWineries($wineries);
                    $productWineries->setIdProduct($product);
                    $productWineries->setIdUser($user);
                    $productWineries->setCreatedAt($created_at);
                    $productWineries->setDescription($description);
                    $productWineries->setQuantity($quantity);
                    $productWineries->setState($state);

                    $em->persist($productWineries);
                    $em->flush();

                    $quantity = $product->getQuantity() + $productWineries->getQuantity();
                    $existence = $product->getExistence() + $productWineries->getQuantity();
                    $product->setQuantity($quantity);
                    $product->setExistence($existence);
                    $em->persist($product);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New product wineries created !!',
                        'data' => $product
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

    public function editAction(Request $request)
    {
        echo 'Edit';
        die();
    }

    public function listAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            $dql = 'SELECT p FROM BackendBundle:ProductWineries p ORDER BY p.id DESC';
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
}
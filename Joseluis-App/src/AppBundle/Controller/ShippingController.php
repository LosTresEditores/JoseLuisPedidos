<?php
/**
 * Created by PhpStorm.
 * User: 54-
 * Date: 01/12/2017
 * Time: 09:55 AM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class ShippingController extends Controller
{
    public function newAction(Request $request)
    {
        echo 'New';
        die();
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

            $dql = 'SELECT s FROM BackendBundle:Shipping s ORDER BY s.id ASC';
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
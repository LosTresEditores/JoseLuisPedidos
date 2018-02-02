<?php
/**
 * Created by PhpStorm.
 * User: 54-
 * Date: 01/12/2017
 * Time: 09:58 AM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class ValueSellerProductController extends Controller
{
    public function listAction(Request $request, $id = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            if ($id != null) {
                $dql = 'SELECT v FROM BackendBundle:ValueSellerProduct v WHERE v.idSellerCategory = ' . $id . ' ORDER BY v.id DESC';
                $query = $em->createQuery($dql);

                $page = $request->query->getInt('page', 1);
                $paginator = $this->get('knp_paginator');
                $items_per_page = 1000;

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
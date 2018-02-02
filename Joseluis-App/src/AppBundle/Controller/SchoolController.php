<?php
/**
 * Created by PhpStorm.
 * User: 54-
 * Date: 01/12/2017
 * Time: 09:42 AM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\School;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class SchoolController extends Controller
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

                $id_school = (isset($params->idSchool)) ? $params->idSchool : null;
                $id_city = (isset($params->idCity)) ? $params->idCity : null;
                $dane = (isset($params->dane)) ? $params->dane : null;
                $icfes = (isset($params->icfes)) ? $params->icfes : null;
                $nit = (isset($params->nit)) ? $params->nit : null;
                $description = (isset($params->description)) ? $params->description : null;
                $address = (isset($params->address)) ? $params->address : null;
                $phone = (isset($params->phone)) ? $params->phone : null;
                $email = (isset($params->email)) ? $params->email : null;
                $web = (isset($params->web)) ? $params->web : null;
                $image = (isset($params->image)) ? $params->image : null;
                $type = (isset($params->type)) ? $params->type : null;
                $state = (isset($params->state)) ? $params->state : null;

                if ($id_school != null) {
                    $school_id = $em->getRepository('BackendBundle:School')->findOneBy(
                        array(
                            'id' => $id_school->id
                        )
                    );
                } else {
                    $school_id = $id_school;
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

                if ($dane != null && $description != null) {
                    $school = new School();
                    $school->setIdSchool($school_id);
                    $school->setIdCity($city);
                    $school->setDane($dane);
                    $school->setIcfes($icfes);
                    $school->setNit($nit);
                    $school->setDescription($description);
                    $school->setAddress($address);
                    $school->setPhone($phone);
                    $school->setEmail($email);
                    $school->setWeb($web);
                    $school->setImage($image);
                    $school->setType($type);
                    $school->setState($state);

                    $em->persist($school);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New school created !!',
                        'data' => $school
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

                $id_school = (isset($params->idSchool)) ? $params->idSchool : null;
                $id_city = (isset($params->idCity)) ? $params->idCity : null;
                $dane = (isset($params->dane)) ? $params->dane : null;
                $icfes = (isset($params->icfes)) ? $params->icfes : null;
                $nit = (isset($params->nit)) ? $params->nit : null;
                $description = (isset($params->description)) ? $params->description : null;
                $address = (isset($params->address)) ? $params->address : null;
                $phone = (isset($params->phone)) ? $params->phone : null;
                $email = (isset($params->email)) ? $params->email : null;
                $web = (isset($params->web)) ? $params->web : null;
                $image = (isset($params->image)) ? $params->image : null;
                $type = (isset($params->type)) ? $params->type : null;
                $state = (isset($params->state)) ? $params->state : null;

                if ($id_school != null) {
                    $school_id = $em->getRepository('BackendBundle:School')->findOneBy(
                        array(
                            'id' => $id_school->id
                        )
                    );
                } else {
                    $school_id = $id_school;
                }

                if ($id_city != null) {
                    $city = $em->getRepository('BackendBundle:City')->findOneBy(
                        array(
                            'id' => $id_city->id
                        )
                    );
                } else {
                    $city = $id_city;
                }

                if ($dane != null && $description != null) {
                    $school = $em->getRepository('BackendBundle:School')->findOneBy(
                        array(
                            'id' => $id
                        )
                    );
                    $school->setIdSchool($school_id);
                    $school->setIdCity($city);
                    $school->setDane($dane);
                    $school->setIcfes($icfes);
                    $school->setNit($nit);
                    $school->setDescription($description);
                    $school->setAddress($address);
                    $school->setPhone($phone);
                    $school->setEmail($email);
                    $school->setWeb($web);
                    $school->setImage($image);
                    $school->setType($type);
                    $school->setState($state);

                    $em->persist($school);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'School updated !!',
                        'data' => $school
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

            $dql = 'SELECT s FROM BackendBundle:School s ORDER BY s.id ASC';
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

    public function listIdAction(Request $request, $id = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            if ($id != null) {
                $dql = "SELECT s FROM BackendBundle:School s WHERE s.id LIKE :id";
                $query = $em->createQuery($dql)
                    ->setParameter("id", $id);
            } else {
                $dql = 'SELECT s FROM BackendBundle:School s ORDER BY s.id DESC';
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

    public function searchAction(Request $request, $search = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            if ($search != null) {
                $dql = "SELECT s FROM BackendBundle:School s WHERE s.dane LIKE :search OR s.description LIKE '%$search%' ORDER BY s.id DESC";
                $query = $em->createQuery($dql)
                    ->setParameter("search", "%$search%");
            } else {
                $dql = 'SELECT s FROM BackendBundle:School s ORDER BY s.id DESC';
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
}
<?php
/**
 * Created by Corporation Saber365.
 * User: Gilberto Guerrero Quinayas
 * Date: 27/11/2017
 * Time: 03:23 PM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $json = $request->get('json', null);

        if ($json != null) {
            $params = json_decode($json);

            $email = (isset($params->email)) ? $params->email : null;
            $password = (isset($params->password)) ? $params->password : null;
            $gethash = (isset($params->gethash)) ? $params->gethash : null;

            $emailConstraint = new Assert\Email();
            $emailConstraint->message = 'This email is not valid !!';

            $validate_email = $this->get('validator')->validate($email, $emailConstraint);

            if ($email != null && count($validate_email) == 0 && $password != null) {
                $jwt_auth = $this->get(jwtauth::class);

                $pwd = hash('sha256', $password);

                $signup = $jwt_auth->signIn($email, $pwd, $gethash);

                return new JsonResponse($signup);
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'msg' => 'Email or password incorrect !!'
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'msg' => 'Send json via post !!'
            );
        }

        return $helpers->json($data);
    }

    public function newAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $json = $request->get('json', null);

        if ($json != null) {
            $params = json_decode($json);

            $em = $this->getDoctrine()->getManager();

            $id_role = (isset($params->id_role)) ? $params->id_role : null;
            $id_seller_cat = (isset($params->id_seller_cat)) ? $params->id_seller_cat : null;
            $id_city = (isset($params->id_city)) ? $params->id_city : null;
            $name = (isset($params->name)) ? $params->name : null;
            $surname = (isset($params->surname)) ? $params->surname : null;
            $email = (isset($params->email)) ? $params->email : null;
            $password = (isset($params->password)) ? $params->password : null;
            $address = (isset($params->address)) ? $params->address : null;
            $phone = (isset($params->phone)) ? $params->phone : null;
            $birth = (isset($params->birth)) ? $params->birth : null;
            $document_type = (isset($params->document_type)) ? $params->document_type : null;
            $document_number = (isset($params->document_number)) ? $params->document_number : null;
            $createdAt = new \DateTime('now');
            $updatedAt = null;
            $deletedAt = null;
            $image = null;
            $state = 'ACTIVO';

            if ($id_role != null) {
                $role = $em->getRepository('BackendBundle:Role')->findOneBy(
                    array(
                        'id' => $id_role
                    )
                );
            } else {
                $role = $id_role;
            }

            if ($id_seller_cat != null) {
                $seller_category = $em->getRepository('BackendBundle:SellerCategory')->findOneBy(
                    array(
                        'id' => $id_seller_cat
                    )
                );
            } else {
                $seller_category = $id_seller_cat;
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

            $emailConstraint = new Assert\Email();
            $emailConstraint->message = 'This email is not valid !!';

            $validate_email = $this->get('validator')->validate($email, $emailConstraint);

            if (count($validate_email) == 0 && $email != null && $password != null && $name != null) {
                $pwd = hash('sha256', $password);

                $user = new User();
                $user->setIdRole($role);
                $user->setIdSellerCategory($seller_category);
                $user->setIdCity($city);
                $user->setName($name);
                $user->setSurname($surname);
                $user->setEmail($email);
                $user->setPassword($pwd);
                $user->setAddress($address);
                $user->setPhone($phone);
                $user->setBirth($birth);
                $user->setDocType($document_type);
                $user->setDocNumber($document_number);
                $user->setCreatedAt($createdAt);
                $user->setUpdatedAt($updatedAt);
                $user->setDeletedAt($deletedAt);
                $user->setImage($image);
                $user->setState($state);

                $isset_user = $em->getRepository('BackendBundle:User')->findBy(
                    array(
                        'email' => $email
                    )
                );

                if (count($isset_user) == 0) {
                    $em->persist($user);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New user created !!',
                        'data' => $user
                    );
                } else {
                    $data = array(
                        'status' => 'error',
                        'code' => 400,
                        'msg' => 'User not created, duplicated !!'
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
                'msg' => 'Json is not valid !!'
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

            $dql = 'SELECT u FROM BackendBundle:User u ORDER BY u.id ASC';
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

    public function sellersAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            $dql = 'SELECT u FROM BackendBundle:User u WHERE u.idSellerCategory in (1,2,3) ORDER BY u.id ASC';
            $query = $em->createQuery($dql);

            $page = $request->query->getInt('page', 1);
            $paginator = $this->get('knp_paginator');
            $items_per_page = 100;

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

    public function uploadImageAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('BackendBundle:User')->findOneBy(
                array(
                    'id' => $identity->sub
                )
            );

            $file = $request->files->get('image');

            if (!empty($file) && $file != null) {
                $ext = $file->guessExtension();

                if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                    $file_name = time() . '.' . $ext;
                    $file->move('assets/users/' . $identity->sub . '/', $file_name);

                    $user->setImage($file_name);
                    $em->persist($user);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'Image for user uploaded success !!'
                    );
                } else {
                    $data = array(
                        'status' => 'error',
                        'code' => 400,
                        'msg' => 'File not valid !!'
                    );
                }

            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'msg' => 'Image not uploaded !!'
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
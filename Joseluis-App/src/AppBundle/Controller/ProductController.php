<?php
/**
 * Created by Corporation Saber365.
 * User: Gilberto Guerrero Quinayas
 * Date: 30/11/2017
 * Time: 09:45 AM
 */

namespace AppBundle\Controller;


use BackendBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\Helpers;

class ProductController extends Controller
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
                $id_product_category = (isset($params->idProductCategory)) ? $params->idProductCategory : null;
                $code = (isset($params->code)) ? $params->code : null;
                $description = (isset($params->description)) ? $params->description : null;
                $quantity = (isset($params->quantity)) ? $params->quantity : null;
                $price = (isset($params->price)) ? $params->price : null;
                $existence = (isset($params->existence)) ? $params->existence : null;
                $order_product = (isset($params->orderProducto)) ? $params->orderProducto : null;
                $new_order = (isset($params->newOrder)) ? $params->newOrder : null;
                $image = (isset($params->image)) ? $params->image : null;
                $state = (isset($params->state)) ? $params->state : null;

                if ($id_wineries != null) {
                    $wineries = $em->getRepository('BackendBundle:Wineries')->findOneBy(
                        array(
                            'id' => $id_wineries->id
                        )
                    );
                } else {
                    $wineries = $id_wineries;
                }

                if ($id_product_category != null) {
                    $product_category = $em->getRepository('BackendBundle:ProductCategory')->findOneBy(
                        array(
                            'id' => $id_product_category->id
                        )
                    );
                } else {
                    $product_category = $id_product_category;
                }

                if ($code != null && $description != null) {
                    $product = new Product();
                    $product->setIdWineries($wineries);
                    $product->setIdProductCategory($product_category);
                    $product->setCode($code);
                    $product->setDescription($description);
                    $product->setQuantity($quantity);
                    $product->setPrice($price);
                    $product->setExistence($existence);
                    $product->setOrderProducto($order_product);
                    $product->setNewOrder($new_order);
                    $product->setImage($image);
                    $product->setState($state);

                    $em->persist($product);
                    $em->flush();

                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'msg' => 'New product created !!',
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

                if ($id != null) {
                    $id_wineries = (isset($params->idWineries)) ? $params->idWineries : null;
                    $id_product_category = (isset($params->idProductCategory)) ? $params->idProductCategory : null;
                    $code = (isset($params->code)) ? $params->code : null;
                    $description = (isset($params->description)) ? $params->description : null;
                    $quantity = (isset($params->quantity)) ? $params->quantity : null;
                    $price = (isset($params->price)) ? $params->price : null;
                    $existence = (isset($params->existence)) ? $params->existence : null;
                    $order_product = (isset($params->orderProducto)) ? $params->orderProducto : null;
                    $new_order = (isset($params->newOrder)) ? $params->newOrder : null;
                    $image = (isset($params->image)) ? $params->image : null;
                    $state = (isset($params->state)) ? $params->state : null;

                    if ($id_wineries != null) {
                        $wineries = $em->getRepository('BackendBundle:Wineries')->findOneBy(
                            array(
                                'id' => $id_wineries->id
                            )
                        );
                    } else {
                        $wineries = $id_wineries;
                    }

                    if ($id_product_category != null) {
                        $product_category = $em->getRepository('BackendBundle:ProductCategory')->findOneBy(
                            array(
                                'id' => $id_product_category->id
                            )
                        );
                    } else {
                        $product_category = $id_product_category;
                    }

                    if ($code != null && $description != null) {
                        $product = $em->getRepository('BackendBundle:Product')->findOneBy(
                            array(
                                'id' => $id
                            )
                        );
                        $product->setIdWineries($wineries);
                        $product->setIdProductCategory($product_category);
                        $product->setCode($code);
                        $product->setDescription($description);
                        $product->setQuantity($quantity);
                        $product->setPrice($price);
                        $product->setExistence($existence);
                        $product->setOrderProducto($order_product);
                        $product->setNewOrder($new_order);
                        $product->setImage($image);
                        $product->setState($state);

                        $em->persist($product);
                        $em->flush();

                        $data = array(
                            'status' => 'success',
                            'code' => 200,
                            'msg' => 'Product updated !!',
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
                        'msg' => 'Product not valid !!'
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

    public function uploadImageAction(Request $request)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $id_product = $request->get('id', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            $product = $em->getRepository('BackendBundle:Product')->findOneBy(
                array(
                    'id' => $id_product
                )
            );

            $file = $request->files->get('image');

            if (!empty($file) && $file != null) {
                $ext = $file->guessExtension();

                if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                    $file_name = time() . '.' . $ext;
                    $file->move('assets/products/', $file_name);

                    $product->setImage($file_name);
                    $em->persist($product);
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

    public function listAction(Request $request, $id = null)
    {
        $helpers = $this->get(helpers::class);

        $token = $request->get('authorization', null);
        $authCheck = $helpers->authCheck($token, false);

        if ($authCheck) {
            $identity = $helpers->authCheck($token, true);

            $em = $this->getDoctrine()->getManager();

            if ($id == null)
                $dql = 'SELECT p FROM BackendBundle:Product p ORDER BY p.id ASC';
            else
                $dql = 'SELECT p FROM BackendBundle:Product p WHERE p.id = ' . $id . ' ORDER BY p.id ASC';

            $query = $em->createQuery($dql);

            $page = $request->query->getInt('page', 1);
            $paginator = $this->get('knp_paginator');
            $items_per_page = 20;

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
                $dql = "SELECT p FROM BackendBundle:Product p WHERE p.id LIKE :id";
                $query = $em->createQuery($dql)
                    ->setParameter("id", $id);
            } else {
                $dql = 'SELECT p FROM BackendBundle:Product p ORDER BY p.id ASC';
                $query = $em->createQuery($dql);
            }

            $page = $request->query->getInt('page', 1);
            $paginator = $this->get('knp_paginator');
            $items_per_page = 20;

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
                $dql = "SELECT p FROM BackendBundle:Product p WHERE p.description LIKE :search OR p.code LIKE :search ORDER BY p.id ASC";
                $query = $em->createQuery($dql)
                    ->setParameter("search", "%$search%");
            } else {
                $dql = 'SELECT p FROM BackendBundle:Product p ORDER BY p.id ASC';
                $query = $em->createQuery($dql);
            }

            $page = $request->query->getInt('page', 1);
            $paginator = $this->get('knp_paginator');
            $items_per_page = 20;

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
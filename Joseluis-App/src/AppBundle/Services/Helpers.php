<?php
/**
 * Created by Corporation Saber365.
 * User: Gilberto Guerrero Quinayas
 * Date: 27/11/2017
 * Time: 03:14 PM
 */

namespace AppBundle\Services;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use AppBundle\Services\JwtAuth;

class Helpers
{
    public $jwt_auth;

    public function __construct($manager)
    {
        $this->jwt_auth = new JwtAuth($manager);
    }

    public function json($data, $status = 200, $headers = array(), $context = array())
    {
        $normalizers = array(new GetSetMethodNormalizer());
        $encoders = array('json' => new JsonEncoder());

        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($data, 'json');

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function authCheck($hash, $getIdentity = false)
    {
        $jwt_auth = $this->jwt_auth;

        $auth = false;

        if ($hash != null) {
            if ($getIdentity == false) {
                $check_token = $jwt_auth->checkToken($hash);
                if ($check_token == true) {
                    $auth = true;
                }
            } else {
                $check_token = $jwt_auth->checkToken($hash, true);
                if (is_object($check_token)) {
                    $auth = $check_token;
                }
            }
        }

        return $auth;
    }
}
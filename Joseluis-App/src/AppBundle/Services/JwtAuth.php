<?php
/**
 * Created by Corporation Saber365.
 * User: Gilberto Guerrero Quinayas
 * Date: 27/11/2017
 * Time: 03:11 PM
 */

namespace AppBundle\Services;


use Doctrine\ORM\Mapping\Id;
use Firebase\JWT\JWT;

class JwtAuth
{
    public $manager;
    public $key;

    public function __construct($manager)
    {
        $this->manager = $manager;
        $this->key = '@-EhgZ48:x7@9-R79Euz';
    }

    public function signIn($email, $password, $getHash = false)
    {
        $user = $this->manager->getRepository('BackendBundle:User')->findOneBy(
            array(
                'email' => $email,
                'password' => $password
            )
        );

        $signup = false;

        if (is_object($user)) {
            $signup = true;
        }

        if ($signup == true) {

            $role = 0;
            if ($user->getIdrole() != null)
                $role = $user->getIdrole()->getId();

            $seller = 0;
            if ($user->getIdSellerCategory() != null)
                $seller = $user->getIdSellerCategory()->getId();

            $token = array(
                'sub' => $user->getId(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'password' => $user->getPassword(),
                'image' => $user->getImage(),
                'role' => $role,
                'seller' => $seller,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));

            if ($getHash) {
                return $decoded;
            } else {
                return $jwt;
            }
        } else {
            return array(
                'status' => 'error',
                'code' => 400,
                'msg' => 'Login failed !!'
            );
        }
    }

    public function checkToken($jwt, $getIdentity = false)
    {
        $auth = false;

        try{
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        }catch (\UnexpectedValueException $e) {
            $auth = false;
        }catch (\DomainException $e) {
            $auth = false;
        }

        if (isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        if ($getIdentity == true) {
            return $decoded;
        } else {
            return $auth;
        }
    }
}
<?php

use Firebase\JWT\JWT;
use Phalcon\Config;
use Phalcon\Di;

class JWTUtils
{
    public static function encodeJWT(Administrateurs $administrateurs): string
    {
        $di = Di::getDefault();
        /** @var Config $JWTConfig */
        $JWTConfig = $di->get('config')->get('JWT');
        $token = [
            'data' => [
                'id' => intval($administrateurs->getId()),
                'role' => null,
            ]
        ];

        return JWT::encode($token, $JWTConfig->get('key'), $JWTConfig->get('algorithme'));
    }

    public static function verifToken($token): bool
    {
        $di = Di::getDefault();
        /** @var Config $JWTConfig */
        $JWTConfig = $di->get('config')->get('JWT');

        try {
            $data = JWT::decode($token, $JWTConfig->get('key'), [$JWTConfig->get('algorithme')]);
            return isset($data);

        } catch (Exception $ex) {
            return false;
        }
    }

    public static function decodeJWT($token): array
    {
        $di = Di::getDefault();
        /** @var Config $JWTConfig */
        $JWTConfig = $di->get('config')->get('JWT');

        try {
            return (array)JWT::decode($token, $JWTConfig->get('key'), [$JWTConfig->get('algorithme')]);
        } catch (Exception $ex) {
            return [];
        }
    }
}
<?php

namespace Src\Services;

use DateTimeImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Src\Http\Mysqli;


class AuthJwt
{
    private static $secret_key = 'my-key-token123';

    //Создаём токен
    static function create($id)
    {
        $config = Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText(self::$secret_key));

        $time = new DateTimeImmutable();

        $token = $config->builder()
            ->issuedBy('/')
            ->permittedFor('/')
            ->identifiedBy(md5("user_id_{$id}"), true)
            ->issuedAt($time)
            ->canOnlyBeUsedAfter($time->modify('+1 minute'))
            ->expiresAt($time->modify('+1 hour'))
            ->withClaim('userId', $id)
            ->getToken($config->signer(), $config->signingKey());

        return $token->toString();
    }

//    Получение пользователя из токена
    static function getUserId(string $token_check)
    {
        $config = Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText(self::$secret_key));
        $token = $config->parser()->parse($token_check);
        return (int) $token->claims()->get('userId');
    }

    static function checkUserInSistem (int $userId)
    {
        $sql = "SELECT id
                FROM users
                where id = {$userId}";
        $connect = new Mysqli();
        $connect->query($sql, 'SELECT');
        $param = $connect->result;
        return (bool)count($connect->result);
    }
}
<?php

namespace Src\Http;

use DateTimeImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha512;

class AuthJwt
{

    //Создаём токен
    static function create($id) {

        $config = Configuration::forUnsecuredSigner();

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

//        $token->headers();
//
//        $token->claims();

         echo $token->toString();
    }

    //Проверка токена
//    public function validate(string $token_check):array {
//
//        $result=[];
//        $signer = new Sha512();
//
//
//        try {
//            $token = (new Parser())->parse($token_check);
//
//            $id=$token->getClaim('userId');
//
//            $data = new ValidationData();
//            $data->setIssuer('/');
//            $data->setAudience('/');
//            $data->setId(md5("user_id_{$id}"));
//            $data->setCurrentTime(time()+61);
//
//            $result['userId']=$id;
//            $result['isValid']=$token->verify($signer,$this->secret_key);
//
//            if($result['isValid']) {
//                $result['isValid']=!$token->isExpired();
//            }
//
//            return $result;
//
//        }catch (\Exception $e) {
//            return $result;
//        }
//
//    }

}
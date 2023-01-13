<?php

use Firebase\JWT\JWT;

//use App\Models\UserModel;
//use Config\Services;

function getJWTFromRequest($authenticationHeader): string
{
    //! musi mieć nagłówek
    if (is_null($authenticationHeader))
    { //JWT is absent
        throw new Exception('Missing or invalid JWT in request');
    }
    //Header should be splitted, because is in the format: Bearer XXXXXXXXX
    return explode(' ', $authenticationHeader)[1]; //? to jest ciekawe...
}

function validateJWTFromRequest(string $encodedToken)
{
    // to poniżej to pierwotna wersja:
    //$key = Services::getSecretKey();
    $key = service('getSecretKey');

    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);

    //? to poniżej, bo token jest jako obiekt, więc może go trzeba zamienić na array???
    //$decodedToken = (array) $decodedToken;

    $userModel = service('userModel');

    //todo nic ta metoda nie zwraca??? - pierwotnie, nie...
    if($userModel->getUserByEmail($decodedToken->email))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getSignedJWTForUser($email)
{
    $issuedAtTime = time();

    $tokenLifeTime = getenv('JWT_TIME_TO_LIVE');
    
    $tokenExpiration = $issuedAtTime + $tokenLifeTime;
    $payload = [
        'email' => $email,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration,
    ];

    //? ustawienie opóźnienia, ale czy to dobre miejsce???
    //JWT::$leeway = 60; // $leeway in seconds

    $jwt = JWT::encode($payload, service('getSecretKey') );
    return $jwt;
}
<?php

use Firebase\JWT\JWT;
//use App\Models\UserModel;
//use Config\Services;

function getJWTFromRequestHeader($authenticationHeader): string
{
    //! musi mieć nagłówek
    if (is_null($authenticationHeader))
    { 
        throw new Exception('Missing or invalid JWT in request');
    }
    //Header should be splitted, because is in the format: Bearer XXXXXXXXX
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    //primary version:  $key = Services::getSecretKey();
    $key = service('getSecretKey');
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    //? should we change it into array or leave it as an object?
    //$decodedToken = (array) $decodedToken;

    $userModel = service('userModel');

    $timeLeft = $decodedToken->exp - time();

    log_message(5,'Pozostało czasu tokenowi: '.$timeLeft);

    if($userModel->getUserByEmail($decodedToken->email) && ($timeLeft > 0))
    {
        return true;
    }
    else
    { //? throw an error or return false?
        throw new Exception('Missing or invalid JWT in request');
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
    // ! po co jest to leeway?
    //JWT::$leeway = 60; // $leeway in seconds

    $jwt = JWT::encode($payload, service('getSecretKey') );
    return $jwt;
}
?>
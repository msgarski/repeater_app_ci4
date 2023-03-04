<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Exception;

class JWTAuthenticationFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        $authorizationHeader = $request->getServer('HTTP_AUTHORIZATION');
        
        try {
            helper('jwt');
            $encodedToken = getJWTFromRequestHeader($authorizationHeader);
            if(validateJWTFromRequest($encodedToken)){
                return $request;
            }else{
                // failure and... what?
            }
        } catch (Exception $e) {
            return Services::response()
                ->setJSON(
                    [
                        'error' => $e->getMessage()
                    ]
                )
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}
?>
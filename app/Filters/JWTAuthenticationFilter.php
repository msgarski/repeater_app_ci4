<?php

namespace App\Filters;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Header;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\IncomingRequest;
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
        $http = $request;
        // error_log( print_r( $http, true ), 3, 'my.log' );

        
        try {

            helper('jwt');
            $encodedToken = getJWTFromRequestHeader($authorizationHeader);
            if(validateJWTFromRequest($encodedToken)){
                return $request;
            }else{
                $response = service('response');
                $response->setStatusCode(403);
                return $response; 
            }
        } catch (Exception $e) {
            return Services::response()
                ->setJSON(
                    [
                        'error' => $e->getMessage()
                    ]
                )
                ->setStatusCode(ResponseInterface::HTTP_FORBIDDEN);
        }
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
        
    }
}
?>
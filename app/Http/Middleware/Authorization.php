<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests as AuthenticatesRequestsContract;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Firebase\JWT\JWT;

class Authorization extends Authorize
{
    protected $auth;
    private static $secret = null;

    
    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public static function getSecret()
    {
        if (self::$secret === null) {
            self::$secret = config('app.token_secret');
        }
        return self::$secret;
    }

    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $authorizationHeader = $request->header('Authorization');
            if (!$authorizationHeader) {
                throw new UnauthorizedHttpException('Bearer', 'No se proporcionó un token');
            }

            $token = $this->parseToken($authorizationHeader);
            if (!$token) {
                throw new UnauthorizedHttpException('Bearer', 'Token inválido');
            }

            $payload = $this->verifyToken($token);
            if (!$payload) {
                throw new UnauthorizedHttpException('Bearer', 'Token inválido');
            }

            $request->validatedId = $payload['id'];

            return $next($request);
        } catch (UnauthorizedHttpException $error) {
            return response()->json(['error' => $error->getMessage()], 401);
        } catch (AuthenticationException | AuthorizationException $error) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    private function parseToken($authorizationHeader)
    {
        if (preg_match('/Bearer\s+(.+)/', $authorizationHeader, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function verifyToken($token)
    {
        try {
            $secret = self::getSecret();
            $result = JWT::decode($token, $secret, ['HS256']);
            return (array)$result;
        } catch (\Exception $error) {
            return null;
        }
    }
}

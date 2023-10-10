<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Providers\AuthServiceProvider;

class Authorization extends Authorize
{
    protected $auth;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $token = $this->getTokenFromRequest($request);

            if (!$token) {
                throw new UnauthorizedHttpException('Bearer', 'No se proporcionó un token');
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

    private function getTokenFromRequest($request)
    {
        $authorizationHeader = $request->header('Authorization');

        if (preg_match('/Bearer\s+(.+)/', $authorizationHeader, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function verifyToken($token)
    {
        try {
            $result = AuthServiceProvider::verifyJWTGettingPayload($token);
            return (array)$result;
        } catch (\Exception $error) {
            return null;
        }
    }
}

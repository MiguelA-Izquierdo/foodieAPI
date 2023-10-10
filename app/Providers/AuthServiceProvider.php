<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Exceptions\HttpError;

class AuthServiceProvider extends ServiceProvider
{
    private static $secret = null;

    public static function getSecret()
    {
        if (self::$secret === null) {
            self::$secret = config('app.token_secret');
        }
        return self::$secret;
    }

    public static function hash($passwd)
    {
        $saltRounds = 10;
        return Hash::make($passwd, [
            'rounds' => $saltRounds
        ]);
    }

    public static function compare($passwd, $hash)
    {
        return Hash::check($passwd, $hash);
    }

    public static function signJWT($payload)
    {
        $secret = self::getSecret(); // Obtener la clave secreta
        $token = JWT::encode($payload, $secret, 'HS256');
        return $token;
    }

    public static function verifyJWTGettingPayload($token)
    {
        try {
          
            $secret = self::getSecret(); 
            $result = JWT::decode($token, new Key($secret, 'HS256'));
            if (is_string($result)) {
                throw new \Exception();
            }

            return (array)$result;
        } catch (\Exception $error) {
            throw new HttpError(498, 'Invalid token', $error->getMessage());
        }
    }

    public function register()
    {
        // Aquí puedes registrar cualquier servicio que desees.
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Aquí puedes realizar configuraciones adicionales, como configuración de políticas de autorización.
    }
}

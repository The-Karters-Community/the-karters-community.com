<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Api\AbstractApiController;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class AuthController extends AbstractApiController {
    protected JWTGuard $auth;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        /** @var JWTGuard $auth */
        $auth = Auth::guard('api');

        $this->auth = $auth;
    }

    /**
     * Login the user thanks to their credentials.
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function login(): JsonResponse {
        /*
         * Retrieve credentials from request header.
         *
         * Format of the X-API-CREDENTIALS header: identifier@key
         * so we explode it at the @.
         */
        $header = request()->headers->get('X-API-CREDENTIALS');
        $explodedHeader = explode('@', $header);

        $identifier = $explodedHeader[0] ?? null;
        $key = $explodedHeader[1] ?? null;

        // If the header, the identifier or the key is null, throw an exception.
        if (is_null($header) || (is_null($identifier) || is_null($key))) {
            throw new ApiException("Missing X-Api-Credentials header.", 401);
        }

        try {
            $jwt = $this->auth->attempt([
                'identifier' => $identifier,
                'key' => $key
            ]);
        } catch (Exception $exception) {
            throw new ApiException("Wrong credentials.", 401);
        }

        if (empty($jwt)) {
            throw new ApiException("Wrong credentials.", 401);
        }

        return $this->respondWithToken($jwt);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse {
        return $this->send([
            'user' => $this->auth->user(),

            'authorization' => [
                'token' => $token,
                'type' => 'bearer',

                'expires_at' => [
                    'timestamp' => Carbon::now()
                        ->addMinutes(config('jwt.ttl'))
                        ->getTimestamp(),

                    'timezone' => config('app.timezone')
                ]
            ]
        ]);
    }
}

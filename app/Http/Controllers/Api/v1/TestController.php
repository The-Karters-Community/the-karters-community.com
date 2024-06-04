<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\AbstractApiController;
use Illuminate\Http\JsonResponse;

class TestController extends AbstractApiController {
    /**
     * Serve as testing purpose.
     *
     * @return JsonResponse
     */
    public function ping(): JsonResponse {
        return $this->send('pong');
    }
}

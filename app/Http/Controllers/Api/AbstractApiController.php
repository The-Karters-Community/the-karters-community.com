<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class AbstractApiController extends Controller {
    /**
     * Send a JSON response.
     *
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function send(mixed $data = [], int $status = 200): JsonResponse {
        $response = [
            'status' => ($status === 200) ? 'success' : 'error'
        ];

        if (!empty($data)) {
            $response = array_merge($response, [
                'data' => $data
            ]);
        }

        return response()->json($response, $status);
    }
}

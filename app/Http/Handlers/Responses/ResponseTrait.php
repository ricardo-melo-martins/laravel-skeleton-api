<?php

declare(strict_types=1);

namespace App\Http\Handlers\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ResponseTrait
{
    private mixed $_data;

    public function responseOk(array | string $data, int $statusCode = 200): JsonResponse
    {
        $data = $this->evaluateData($data);

        return response()->json($data, $statusCode);
    }

    public function responseCreateOk(array | string $data, int $statusCode = 201): JsonResponse
    {
        $data = $this->evaluateData($data);

        return response()->json($data, $statusCode);
    }

    public function responseUpdateOk(array | string $data, int $statusCode = 200): JsonResponse
    {
        $data = $this->evaluateData($data);

        return response()->json($data, $statusCode);
    }

    public function responseDeleteOk(array | string $data, int $statusCode = 200): JsonResponse
    {
        $data = $this->evaluateData($data);

        return response()->json($data, $statusCode);
    }

    private function evaluateData(mixed $data)
    {
        Log::debug(gettype($data));
        
        if(gettype($data) === 'object'){
            $data = ['data' => $data];
        }

        if(gettype($data) === 'string')
        {
            $data = json_decode($data, true);
            $data = ['data' => $data];

        }

        if(!config('app.debug'))
        {
            if(array_key_exists('debug', $data)){
                unset($data['debug']);
            }
        }

        return $data;
    }

}

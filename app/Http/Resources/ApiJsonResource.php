<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiJsonResource extends JsonResource
{
    public function __construct(
        private mixed $data,
        private ?string $message = null,
        private int $status = 200,
    ) {}

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        self::withoutWrapping();

        return [
            'message' => $this->message ?? 'Request completed successfully',
            'data' => $this->data,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode($this->status);
    }
}

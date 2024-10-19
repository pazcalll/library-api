<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiErrorResource extends JsonResource
{
    public function __construct(
        private null|array|object $errors = null,
        private ?string $message = null,
        private int $status = 400,
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
            'message' => $this->message ?? 'Request failed',
            'errors' => $this->errors,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode($this->status);
    }
}

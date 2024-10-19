<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiPaginatedResource extends JsonResource
{
    public function __construct(
        private LengthAwarePaginator $data,
    ) {}

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->data->items(),
            'current_page' => $this->data->currentPage(),
            'per_page' => $this->data->perPage(),
            'total' => $this->data->total(),
        ];
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode(200);
    }
}

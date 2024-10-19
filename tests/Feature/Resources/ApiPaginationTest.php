<?php

namespace Tests\Feature\Resources;

use App\Http\Resources\ApiPaginatedResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ApiPaginationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_pagination_expectation(): void
    {
        $paginatedData = new LengthAwarePaginator([
            ['foo' => 'bar'],
            ['baz' => 'qux'],
            ['quux' => 'corge'],
        ], 3, 3, 10);

        $resource = new ApiPaginatedResource($paginatedData);
        $response = $resource->response()->getData(true);

        $this->assertSame($paginatedData->items(), $response['data']);
        $this->assertSame($paginatedData->currentPage(), $response['current_page']);
        $this->assertSame($paginatedData->perPage(), $response['per_page']);
        $this->assertSame($paginatedData->total(), $response['total']);
    }
}

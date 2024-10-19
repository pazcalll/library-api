<?php

namespace Tests\Feature\Resources;

use App\Http\Resources\ApiJsonResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiJsonTest extends TestCase
{
    public function test_api_json_3_param_expectation(): void
    {
        $data = ['foo' => 'bar'];
        $message = 'Request completed successfully';
        $status = 200;

        $resource = new ApiJsonResource($data, $message, $status);
        $response = $resource->response();
        $responseArray = $response->getData(true);

        $this->assertSame($data, $responseArray['data']);
        $this->assertSame($message, $responseArray['message']);
        $this->assertSame($status, $response->getStatusCode());
    }

    public function test_api_json_data_only(): void
    {
        $data = ['foo' => 'bar'];

        $resource = new ApiJsonResource($data);
        $response = $resource->response()->getData(true);

        $this->assertSame($data, $response['data']);
    }

    public function test_api_json_message_only(): void
    {
        $message = 'Request completed successfully';

        $resource = new ApiJsonResource(message: $message);
        $response = $resource->response()->getData(true);

        $this->assertSame($message, $response['message']);
    }

    public function test_api_json_status_only(): void
    {
        $status = 201;

        $resource = new ApiJsonResource(status: $status);
        $response = $resource->response();
        $this->assertSame($status, $response->getStatusCode());
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'author_id',
                    'description',
                    'publish_date',
                    'created_at',
                    'updated_at',
                ],
            ],
            'per_page',
            'total',
        ]);
    }

    public function test_index_change_length(): void {
        $response = $this->get('/api/books?length=10');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'per_page' => 10,
        ]);
    }

    public function test_index_paginate(): void {
        $response = $this->get('/api/books?page=2');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'current_page' => 2,
        ]);
    }

    public function test_show(): void
    {
        $response = $this->get('/api/books/1');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'title',
                'author_id',
                'description',
                'publish_date',
                'created_at',
                'updated_at',
                'author' => [
                    'id',
                    'name',
                    'birth_date',
                    'bio',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_store(): void
    {
        $response = $this->post('/api/books', [
            'title' => 'Test Book',
            'author_id' => 1,
            'description' => 'Test Description',
            'publish_date' => '2021-01-01',
        ]);

        $response->assertStatus(201);

        $response->assertJsonFragment([
            'title' => 'Test Book',
            'author_id' => 1,
            'description' => 'Test Description',
            'publish_date' => '2021-01-01',
        ]);
    }

    public function test_update(): void
    {
        $response = $this->put('/api/books/1', [
            'title' => 'Updated Book',
            'author_id' => 1,
            'description' => 'Updated Description',
            'publish_date' => '2021-01-01',
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'title' => 'Updated Book',
            'author_id' => 1,
            'description' => 'Updated Description',
            'publish_date' => '2021-01-01',
        ]);
    }

    public function test_delete(): void
    {
        $response = $this->delete('/api/books/1');

        $response->assertStatus(200);
    }
}

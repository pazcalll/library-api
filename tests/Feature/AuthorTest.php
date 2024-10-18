<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Concerns\TestDatabases;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/api/authors');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'birth_date',
                    'bio',
                    'created_at',
                    'updated_at',
                ],
            ],
            'per_page',
            'total',
        ]);
    }

    public function test_index_change_length(): void {
        $response = $this->get('/api/authors?length=10');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'per_page' => 10,
        ]);
    }

    public function test_index_paginate(): void {
        $response = $this->get('/api/authors?page=2');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'current_page' => 2,
        ]);
    }

    public function test_show(): void
    {
        $response = $this->get('/api/authors/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'name',
                'birth_date',
                'bio',
                'created_at',
                'updated_at',
            ],
        ]);

        $response->assertJsonFragment([
            'id' => 1,
        ]);
    }

    public function test_store(): void
    {
        $response = $this->postJson('/api/authors', [
            'name' => 'Test Author',
            'birth_date' => '1990-01-01',
            'bio' => 'Test Bio',
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'name' => 'Test Author',
            'birth_date' => '1990-01-01',
            'bio' => 'Test Bio',
        ]);
    }

    public function test_update(): void
    {
        $response = $this->putJson('/api/authors/1', [
            'name' => 'Updated Author',
            'birth_date' => '1990-01-01',
            'bio' => 'Updated Bio',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Updated Author',
            'bio' => 'Updated Bio',
            'birth_date' => '1990-01-01',
        ]);
    }

    public function test_delete(): void
    {
        $response = $this->delete('/api/authors/1');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => 1,
        ]);
    }

    public function test_books(): void
    {
        $response = $this->get('/api/authors/1/books');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'publish_date',
                    'author_id',
                    'created_at',
                    'updated_at',
                ],
            ],
            'per_page',
            'total',
        ]);
    }
}

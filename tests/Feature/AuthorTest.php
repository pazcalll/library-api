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
    public function test_index_structure(): void
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

    public function test_show_structure(): void
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

    public function test_create_author(): void
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

    public function test_update_patch_author(): void
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

    public function test_update_put_author(): void
    {
        $response = $this->putJson('/api/authors/1', [
            'name' => 'Updated Author',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Updated Author',
        ]);
    }

    public function test_delete_author(): void
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
            'message',
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
        ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{

    public function test_get_all_blog_request()
    {
        $response = $this->get('/api/blogs');

        $response->assertStatus(200)->assertJson([
            'blogs' => true,
        ]);;
    }

    public function test_get_one_blog_with_comments_request()
    {
        $response = $this->get('/api/blogs/1');

        $response->assertStatus(200)->assertJson([
            'blog' => true,
        ])->assertJsonStructure([
            'blog' => [
                'comments',
            ]
        ]);
    }
}

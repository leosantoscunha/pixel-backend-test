<?php

namespace Tests\Feature;

use App\Models\Comment;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_comment_with_errors_request()
    {
        $response = $this->postJson('/api/blogs/1/comment', []);

        $response->assertStatus(422)->assertJsonStructure([
            'errors'
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_comment_with_success_request()
    {
        $comment = Comment::factory()->make();
        $comment->blog_id = 1;
        $response = $this->postJson('/api/blogs/1/comment', $comment->toArray());

        $response->assertStatus(201)
            ->assertJsonStructure([
            'status',
            'message'
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_put_comment_that_does_not_exist_request()
    {
        $comment = 'This comment was update';

        $response = $this->putJson('/api/comment/999999999999', [
            'comment' => $comment
        ]);

        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_put_comment_with_success_request()
    {
        $comment = 'This comment was update';

        $lastRecordDate = Comment::all('id')->sortByDesc('id')->take(1)->first();
        $commentId = $lastRecordDate->id;

        $response = $this->putJson("/api/comment/{$commentId}", [
            'comment' => $comment
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_comment_that_does_not_exist_request()
    {
        $comment = 'This comment was update';

        $response = $this->deleteJson('/api/comment/999999999999', [
            'comment' => $comment
        ]);

        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_comment_request()
    {
        $comment = 'This comment was update';

        $lastRecordDate = Comment::all('id')->sortByDesc('id')->take(1)->first();
        $commentId = $lastRecordDate->id;

        $response = $this->deleteJson("/api/comment/{$commentId}", [
            'comment' => $comment
        ]);

        $response->assertStatus(200);
    }
}

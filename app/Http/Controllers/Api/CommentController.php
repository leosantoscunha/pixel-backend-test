<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = \Validator::make($request->all(), [
            'blog_id' => 'exists:App\Models\Blog,id',
            'title' => 'required|max:8',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $title = $request->get('title');
        $name = $request->get('name');
        $email = $request->get('email');
        $comment = $request->get('comment');
        $blog = $request->get('blog_id');

        try {
            Comment::create([
                'title' => $title,
                'name' => $name,
                'email' => $email,
                'comment' => $comment,
                'blog_id' => $blog,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Comments created successfully'
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['errors' => ['message' => 'Error to create comment']], 422);
        }

    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $validator = \Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newComment = $request->get('comment');

        try {
            $comment->comment = $newComment;
            $comment->save();

            return response()->json([
                'status' => true,
                'message' => 'Comments updated successfully'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['errors' => ['message' => 'Error to updated comment']], 422);
        }

    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment): \Illuminate\Http\JsonResponse
    {

        try {
            $comment->delete();

            return response()->json([
                'status' => true,
                'message' => 'Comments deleted successfully'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['errors' => ['message' => 'Error to updated comment']], 422);
        }
    }
}

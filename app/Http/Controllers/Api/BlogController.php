<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $blogs = Blog::all();

        return response()->json([
            'blogs' => $blogs,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $blog = Blog::with('comments')->where('id', $id)->first();

        return response()->json([
            'blog' => $blog,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'parent_id' => $request->post('parent_id'),
            'news_id' => $request->post('news_id'),
            'text' => $request->post('text'),
            'user_id' => auth()->user()->id
        ]);
        return Comment::where('id', $comment->id)->with('user', 'replies')->first();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Comment::where([['parent_id', null], ['news_id', $id]])->with('user', 'replies.user')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

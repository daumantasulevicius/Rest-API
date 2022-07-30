<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentPostRequest;
use App\Http\Requests\CommentPutRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returnData = Comment::with('data')->paginate(25);
        return response()->json($returnData, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentPostRequest $request)
    {
        $comment = new Comment;
        $comment->data_id = $request->data_id;
        $comment->comment = $request->comment;
        $comment->save();
        return response()->json(['message' => "New comment added"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::with('data')->find($id);
        if ($comment !== null) {
            return response()->json($comment, 200);
        }
        else
            return response()->json(['error' => "Item not found"], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentPutRequest $request, $id)
    {
        $comment = Comment::find($id);
        if ($comment !== null) {
            $comment->update($request->all());
            return response()->json(['success' => "Item updated"], 200);
        }
        else
            return response()->json(['error' => "Item not found"], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $found = Comment::find($id);
        if ($found === null)
            return response()->json(['error' => "Element not found"], 404);
        else {
            $found->delete();
            return response()->json(['message' => "Element deleted successfully"], 200);
        }
    }
}

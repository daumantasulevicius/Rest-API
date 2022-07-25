<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returnData = Data::paginate(25)->toJson(JSON_PRETTY_PRINT);
        return response($returnData, 200);
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
     * @param \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = new Data;
        $data->index_start_at = $request->index_start_at;
        $data->integer = $request->integer;
        $data->float = $request->float;
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->fullname = $request->fullname;
        $data->email = $request->email;
        $data->bool = $request->bool;
        $data->save();
        return response()->json("New item added", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Data::find($id)->toJson(JSON_PRETTY_PRINT));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutRequest;
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
        $returnData = Data::with('comments')->paginate(25);
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
        return response()->json(['message' => "New item added"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Data::with('comments')->find($id), 200);
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
    public function update(PutRequest $request, $id)
    {
        Data::find($id)->update($request->all());
        return response()->json("Item updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $found = Data::find($id);
        if ($found === null)
            return response()->json(['message' => "Element not found"], 404);
        else {
            $found->delete();
            return response()->json(['message' => "Element deleted successfully"], 200);
        }
    }
    public function filter(Request $request)
    {
        $operator_arr = array("gt"=>">", "ge"=>">=", "lt"=>"<", "le"=>"<=", "eq"=>"=", "ne"=>"!=");
        $query = Data::select('*');
        foreach ($request->query() as $key => $value) {
            if(is_array($value))
                foreach ($value as $array_key => $array_value){
                    $query->where($key, $operator_arr[$array_key], $array_value);
                }
            else
                $query->where($key, '=', $value);
        }
        return response()->json($query->get(), 200);
    }
    public function search($phrase)
    {
        $searchFields = ['index_start_at','integer','float','name','surname','fullname','email','bool','comment'];
        $returnData = Data::select('*')->where(function ($query) use ($phrase, $searchFields) {
            $searchWildcard = '%' . $phrase . '%';
            foreach ($searchFields as $field) {
                $query->orWhere($field, 'LIKE', $searchWildcard);
            }
        })->get();
        return response()->json($returnData, 200);
    }
}

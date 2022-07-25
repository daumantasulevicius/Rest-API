<?php

namespace App\Http\Controllers;

use App\Jobs\MakeFeedRequest;
use Illuminate\Http\Request;

class MakeFeedRequestController extends Controller
{
    public function getFeed()
    {
        MakeFeedRequest::dispatch();
        return response()->json(['message' => 'Feed has been read']);
    }
}

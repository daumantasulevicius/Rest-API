<?php

namespace App\Jobs;

use App\Models\Data;
use http\Exception\RuntimeException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class MakeFeedRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get('https://gist.githubusercontent.com/emodus/27d245484a85c2286722b9d146c53354/raw/c9af224580a22cbde969127527c4500e3f7d2a9e/dummyFeed')->json();

        $item_arr = $response['items'];
        foreach ($item_arr as $item) {
            $data = new Data;
            $data->id = $item['index'];
            $data->index_start_at = $item['index_start_at'];
            $data->integer = $item['integer'];
            $data->float = $item['float'];
            $data->name = $item['name'];
            $data->surname = $item['surname'];
            $data->fullname = $item['fullname'];
            $data->email = $item['email'];
            if($item['bool'] === 'true')
                $data->bool = true;
            else
                $data->bool = false;
//            dd($item);
            $data->save();
        }

//        dd($response['items']);


    }
}

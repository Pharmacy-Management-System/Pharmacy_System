<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignNewOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $orders = Order::where('status', "New")->get();
        foreach( $orders as $order){
            $order->pharmacy_id = Pharmacy::where('area_id', $order->address->area_id)->orderby("priority", "desc")->first()->id;
            $order->status = "Processing";
            $order->save();
        }

    }
}

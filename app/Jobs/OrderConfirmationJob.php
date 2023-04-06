<?php

namespace App\Jobs;

use App\Models\Client;
use App\Models\User;
use App\Notifications\OrderConfirmationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $client;
    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $order)
    {
        $this->client = $client;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client->notify((new OrderConfirmationNotification($this->order)));
    }
}

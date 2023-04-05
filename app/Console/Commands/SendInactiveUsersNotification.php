<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\InactiveUserNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendInactiveUsersNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:inactive-users-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('last_login', '<', Carbon::now()->subMonth())->get();
        foreach ($users as $user) {
            $user->notify((new InactiveUserNotification));
        }
    }
}

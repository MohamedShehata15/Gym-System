<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Console\Command;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';


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
    public function handle() {
        $users = User::where('last_login', '<=', now()->subDay(30)->toDateString())->get();
        foreach ($users as $user) {
            $user->notify(new UserNotification([
                'message' => "We missed you 😎🤩"
            ]));
        }
    }
}

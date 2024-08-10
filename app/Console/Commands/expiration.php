<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire user every 5 mintes antomatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allUsers = User::where('expire',0)->get();

        foreach ($allUsers as $user) {
            $user->update(['expire'=>1]);
        }
    }
}

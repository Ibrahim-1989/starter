<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifyEmail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notify:Email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for all user every day';

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
        $getAllEmails = User::pluck('email')->toArray();
        $data = ['title'=>'Programming','body'=>'PHP'];
        foreach ($getAllEmails as $userEmail) {
            Mail::to($userEmail)->send(new NotifyEmail($data));
        }
    }
}

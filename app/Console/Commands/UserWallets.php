<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Courier;

class UserWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\Courier::create([
            'courier_name' => 'test',
        ]);
    }
}

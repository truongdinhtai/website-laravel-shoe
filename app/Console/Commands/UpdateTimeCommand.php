<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:update';

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
        $tables = [
            'articles',
            'articles_tags',
            'categories',
            'menus',
            'orders',
            'otps',
            'pages',
            'permissions',
            'products',
            'products_images',
            'products_options',
            'products_value',
            'products_wholesale_price',
            'roles',
            'settings',
            'slides',
            'tags',
            'transactions',
            'users',
            'users_has_types',
            'user_types',
            'votes',
            'warehouses'
        ];

        foreach ($tables as $table) {
            $this->info("========= TABLE: " . $table);
            DB::table($table)->update([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}

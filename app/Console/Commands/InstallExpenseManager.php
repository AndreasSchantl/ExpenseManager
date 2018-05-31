<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallExpenseManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:expensemanager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the Expense Mangaer';

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
     * @return mixed
     */
    public function handle()
    {
        $this->call('key:generate');
        $this->call('migrate');
        $this->call('db:seed', [
            '--class' => 'DatabaseSeeder'
        ]);
    }
}

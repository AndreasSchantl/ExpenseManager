<?php

use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expense_types')->insert([
            'id' => 1,
            'name' => __('app.installer_exp_type_general')
        ]);
    }
}

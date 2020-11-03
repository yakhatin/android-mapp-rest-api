<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert(
            array(
                array(
                    'user_type_title' => 'Пользователь',
                    'privilegie_level' => 100
                ),
                array(
                    'user_type_title' => 'Редактор',
                    'privilegie_level' => 200
                ),
                array(
                    'user_type_title' => 'Модератор',
                    'privilegie_level' => 300
                ),
                array(
                    'user_type_title' => 'Администратор',
                    'privilegie_level' => 1000
                )
            )
        );
    }
}
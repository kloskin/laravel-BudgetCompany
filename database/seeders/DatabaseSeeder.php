<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        Generowanie losowych danych

//        Email wziąć z bazy danych hasło to : password

        User::factory(10)->hasTransactions(10)->create();


     /*   User::factory(5)->create();*/

    }
}

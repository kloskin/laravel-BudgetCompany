<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        $dateIssue = $this->faker->date('Ymd');
        $randomNumber = rand(0, 100);
        $simulatedTransactionId = rand(1, 999);

        return [
           /* 'user_id'=>User::factory(),*/
           /*'transaction_id' => Transaction::factory(),*/
            'number' => 'BC' . $dateIssue . $randomNumber . $simulatedTransactionId,
            'issue_date' => function (array $attributes) {
                // Pobierz datę transakcji
                $transactionDate = Transaction::find($attributes['transaction_id'])->date;

                // Dodaj losową liczbę dni do daty transakcji
                return $transactionDate;
            },
            'due_date' => function (array $attributes) {
                // Pobierz datę transakcji
                $transactionDate = Transaction::find($attributes['transaction_id'])->date;

                // Dodaj losową liczbę dni do daty transakcji
                return \Carbon\Carbon::parse($transactionDate)->addDays(rand(1, 30))->format('Y-m-d');
            },
            'status'=> $this->faker->randomElement(['Paid','Waiting']),
        ];
    }
}

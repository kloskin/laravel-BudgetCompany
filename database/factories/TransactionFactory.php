<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        $startDate = '-1 year';
        $endDate = 'now';

        $issueDate = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');

        return [
           /* 'user_id'=>User::factory(),*/
            'type'=> $this->faker->randomElement(['Income','Expense']),
            'amount'=>$this->faker->numberBetween(100,10000),
            'title'=>$this->faker->sentence,
            'description'=>$this->faker->text(400),
            'date'=>$issueDate
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Transaction $transaction) {
            Invoice::factory()->create(['transaction_id' => $transaction->id, 'user_id'=>$transaction->user->id]);
        });
    }

}

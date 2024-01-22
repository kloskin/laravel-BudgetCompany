<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('unique_transaction_for_invoice', function ($attribute, $value, $parameters, $validator) {
            return !Invoice::where('transaction_id', $value)->exists();
        });


        View::composer(['transactions.budget', 'transactions.home'], function ($view) {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            $incomeSum = Transaction::where('type', 'Income')
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->sum('amount');

            $expenseSum = Transaction::where('type', 'Expense')
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->sum('amount');

            $view->with('incomeSum', $incomeSum)
                ->with('expenseSum', $expenseSum);
        });

    }
}

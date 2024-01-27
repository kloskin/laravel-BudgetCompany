<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:Income,Expense',
            'amount' => 'required|numeric|min:0',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
        ]);


        $transaction = $request->user()->transactions()->create($validatedData);

        return response()->json([
            'transaction' => $transaction
        ]);
    }
    public function show(Transaction $transaction)
    {
        if (!$transaction) {
            return response()->json([
                'error' => 'Transaction not found.'
            ], 404);
        }
        return response()->json([
            'transaction' => $transaction
        ]);
    }
    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update',$transaction);

        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'type' => 'required|in:Income,Expense',
            'amount' => 'required|numeric|min:0',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
        ]);


        // Utworzenie transakcji i przechwycenie jej
        $transaction->update($validatedData);

        return response()->json([
            'transaction' => $transaction
        ]);
    }
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete',$transaction);

        $transaction->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sort = $request->input('sort', 'created_at'); // default_column to domyślna kolumna do sortowania
        $direction = $request->input('direction', 'desc'); // Domyślny kierunek sortowania


        $allowedSorts = ['amount', 'date', 'created_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        $transactions = Transaction::orderBy($sort, $direction)->paginate(15);

        if (Auth::user()->isAdmin()) {
            // Dla admina: Pobierz wszystkie transakcje z sortowaniem
            $transactionsEdit = Transaction::orderBy($sort, $direction)->paginate(15);
        } else {
            // Dla zwykłego użytkownika: Pobierz tylko jego transakcje z sortowaniem
            $transactionsEdit = Transaction::where('user_id', Auth::id())->orderBy($sort, $direction)->paginate(15);
        }


        return view('transactions.index',[
            'transactions'=>$transactions,
            'transactionsEdit'=>$transactionsEdit
        ]);
    }

    public function budget()
    {
        $data = [];
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('F');

            $income = Transaction::where('type', 'Income')
                ->whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->sum('amount');

            $expense = Transaction::where('type', 'Expense')
                ->whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->sum('amount');

            $data[] = $income - $expense;
        }


        return view('transactions.budget', compact('data', 'months'));
    }

    public function home()
    {
        $latestInvoice = Invoice::latest()->first();
        $latestTransaction = Transaction::latest()->first();

        return view('transactions.home', compact('latestInvoice', 'latestTransaction'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'type' => 'required|in:Income,Expense',
            'amount' => 'required|numeric|min:0',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
        ]);


        // Utworzenie transakcji i przechwycenie jej
        $transaction = $request->user()->transactions()->create($validatedData);

        if($request->transaction==1){

            $dueDate = Carbon::parse($request->input('date'))->addDays(30);

            $dateString = str_replace("-","", $request->date);
            $invoice = [
                'transaction_id' => $transaction->id, //
                'number' => 'BC'.$dateString.rand(0,100). $transaction->id,
                'issue_date' => $transaction->date,
                'due_date' => $dueDate,
                'status' => 'Waiting',
            ];

            $request->user()->invoices()->create($invoice);
        }

        $currentTab = $request->input('tab' , 1);
        session(['selectedTab' => $currentTab]);
        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', [
            'transaction'=> $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('update',$transaction);

        return view('transactions.edit', [
            'transaction'=>$transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete',$transaction);

        $transaction->delete();
        return redirect(route('transactions.index'));
    }
}

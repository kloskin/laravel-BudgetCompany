<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Validator;



class InvoiceController extends Controller
{

    public function generatePDF(Invoice $invoice)
    {
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->number . '.pdf');
    }

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
        if (Auth::user()->isAdmin()) {
            $invoicesEdit = Invoice::orderBy($sort, $direction)->paginate(15);
        }else{
            $invoicesEdit = Invoice::where('user_id', Auth::id())->paginate(15);
        }
        $invoices = Invoice::orderBy($sort, $direction)->paginate(15);

        $transactionsWithoutInvoice = Transaction::whereDoesntHave('invoice')->get();

        return view('invoices.index', [
            'invoices' => $invoices,
            'invoicesEdit' => $invoicesEdit,
            'transactionsWithoutInvoice' => $transactionsWithoutInvoice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedInvoice = $request->validate([
            'due_date' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|in:Paid,Waiting',
            'transaction_id' => [
                'required',
                'numeric',
                Rule::when($request->input('transaction_id') != 0, [
                    Rule::exists('transactions', 'id'),
                    'unique_transaction_for_invoice'
                ]),
            ],
        ]);

        /*Walidacja aby data transakcji nie była większa od daty płatności*/
        $validator = Validator::make($request->all(), [
            'due_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->transaction_id != 0) {
                        $transaction = Transaction::findOrFail($request->transaction_id);
                        if ($value < $transaction->date) {
                            $fail('The ' . $attribute . ' must be equal or later than the transaction date.');
                        }
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $dateIssue = str_replace("-","", $request->issue_date);

        DB::beginTransaction(); // Rozpocznij transakcję

        try {
            if ($request->transaction_id == 0) {

                $request->validate(['issue_date' => 'required|date']);

                $validatedTransaction = $request->validate([
                    'type' => 'required|in:Income,Expense',
                    'amount' => 'required|numeric|min:0',
                    'title' => 'required',
                    'description' => 'required',
                ]);

                $validatedTransaction['date'] = $request->issue_date;

                $transaction = $request->user()->transactions()->create($validatedTransaction);

                $validatedInvoice['issue_date'] = $request->issue_date;
                $validatedInvoice['number'] = 'BC'.$dateIssue.rand(0,100). $transaction->id;
                $validatedInvoice['transaction_id'] = $transaction->id;

            } else {
                $transaction = Transaction::findOrFail($request->transaction_id);
                $dateIssue = str_replace("-", "", $transaction->date);
                $validatedInvoice['issue_date'] = $transaction->date;
                $validatedInvoice['number'] = 'BC'.$dateIssue.rand(0,100). $request->transaction_id;
            }

            $request->user()->invoices()->create($validatedInvoice);

            DB::commit(); // Zatwierdź transakcję


            $currentTab = $request->input('tab' , 1);
            session(['selectedTab' => $currentTab]);
            return redirect(route('invoices.index'));

        } catch (\Exception $e) {
            DB::rollback(); // Cofnij transakcję w przypadku błędu
            // Obsługa błędu, np. przekazanie informacji o błędzie do widoku
            return back()->withErrors(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show',[
            'invoice'=>$invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $this->authorize('update',$invoice);

        $transactionsWithoutInvoice = Transaction::whereDoesntHave('invoice')->get();

        return view('invoices.edit', [
            'invoice'=>$invoice,
            'transactionsWithoutInvoice' => $transactionsWithoutInvoice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->authorize('update',$invoice);
        $validatedInvoice = $request->validate([
            'issue_date' => 'required|date',
            'number' => 'required',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|in:Paid,Waiting',
        ]);

        $invoice->transaction_id = $request->input('transaction_id');

        if ($invoice->isDirty('transaction_id')) {
            $request->validate([
                'transaction_id' => [
                    'required',
                    'numeric',
                    Rule::exists('transactions', 'id'),
                    'unique_transaction_for_invoice'
                ],
            ]);
        }


        $invoice->fill($validatedInvoice);
        $invoice->save();

        return redirect(route('invoices.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
           $this->authorize('delete',$invoice);

                $invoice->delete();
                return redirect(route('invoices.index'));
    }
}

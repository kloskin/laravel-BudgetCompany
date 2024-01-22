<x-budget_company.layout>

    <div class="w-full bg-white border border-gray-500 rounded-lg shadow mt-10">

        <ul class="myTextColor1  text-xs sm:text-lg font-medium text-center divide-x flex rounded-lg  rtl:divide-x-reverse"  role="tablist">
            <li class="w-full">
                <div id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg rounded-se-lg focus:outline-none myBgColor1">Edit Invoice</div>
            </li>
        </ul>


        <div class="p-5 myBgColor2 myTextColor1 border-t border-gray-200 rounded-b">


                <form method="POST" action="{{ route('invoices.update', $invoice) }}" class="max-w-4xl mx-auto my-4">
                    @csrf
                    @method('patch')
                    <h1 class="font-medium text-3xl mb-5">Edit Invoice</h1>

                    <div class="mb-4">
                        <label for="transaction_id" class="block myTextColor1 text-sm font-bold mb-2">Transaction</label>
                        <select x-model="selectedTransaction" name="transaction_id" id="transaction_id" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                            <option value="{{$invoice->transaction->id}}">Transaction: {{ $invoice->transaction->title }} {{ $invoice->transaction->date }}</option>
                            @foreach($transactionsWithoutInvoice as $transaction)
                                <option value="{{ $transaction->id }}">Transaction: {{ $transaction->title }} {{ $transaction->date }}</option>
                            @endforeach
                        </select>
                        <p class="text-red-500 text-xs italic">{{$errors->first('transaction_id')}}</p>
                    </div>

                    <div class="mb-4">
                        <label for="number" class="block myTextColor1 text-sm font-bold mb-2">Invoice Number</label>
                        <input type="text" id="number" name="number" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{$invoice->number}}" required>
                        <p class="text-red-500 text-xs italic">{{$errors->first('number')}}</p>
                    </div>

                    <div class="mb-4">
                        <label for="issueDate" class="block myTextColor1 text-sm font-bold mb-2">Issue Date</label>
                        <input type="date" id="issueDate" name="issue_date" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{$invoice->issue_date}}" required>
                        <p class="text-red-500 text-xs italic">{{$errors->first('issue_date')}}</p>
                    </div>

                    <div class="mb-4">
                        <label for="dueDate" class="block myTextColor1 text-sm font-bold mb-2">Payment Date</label>
                        <input type="date" id="dueDate" name="due_date" class="shadow border rounded py-2 px-3 myTextColor10 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{$invoice->due_date}}" required>
                        <p class="text-red-500 text-xs italic">{{$errors->first('due_date')}}</p>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block myTextColor1 text-sm font-bold mb-2">Status</label>
                        <select name="status" id="status" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                            <option value="Paid" {{ (old('type', $invoice->status) == 'Paid') ? 'selected' : '' }}>Paid</option>
                            <option value="Waiting" {{ (old('type', $invoice->status) == 'Waiting') ? 'selected' : '' }}>Waiting</option>
                            <p class="text-red-500 text-xs italic">{{$errors->first('status')}}</p>
                        </select>
                    </div>

                    <!-- Przycisk Dodaj Fakturę -->
                    <div class="mt-8">
                        <button type="submit" class="myBgColor3 hover:opacity-85 active:opacity-90 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Save Invoice</button>
                    </div>

                </form>
        </div>

    </div>

</x-budget_company.layout>

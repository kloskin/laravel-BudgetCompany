<div class="p-4 ">


    <form method="POST" action="{{ route('invoices.store') }}" class="max-w-4xl mx-auto my-4">
        @csrf

        {{--@if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif--}}

        <h1 class="font-medium text-3xl mb-5">Add Invoice</h1>


        <div x-data="{ selectedTransaction: '0' }">
            <div class="mb-4">
                <label for="transaction_id" class="block myTextColor1 text-sm font-bold mb-2">Transaction (create or select)</label>
                <select x-model="selectedTransaction" name="transaction_id" id="transaction_id" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                    <option value="0">Create new Transaction</option>
                    @foreach($transactionsWithoutInvoice as $transaction)
                        <option value="{{ $transaction->id }}">Transaction: {{ $transaction->title }} {{ $transaction->date }}</option>
                    @endforeach
                    <!-- Dodaj więcej opcji -->
                </select>
            </div>

            <div x-show="selectedTransaction === '0'"  class="mt-6">
                <div class="mb-4">
                    <label for="type" class="text-sm myTextColor1 block mb-2 font-bold">Transaction Type</label>
                    <select name="type" id="type" class="shadow border  {{$errors->first('transaction_id') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                        <option value="Income">Income</option>
                        <option value="Expense">Expense</option>
                    </select>
                    <p class="text-red-500 text-xs italic">{{$errors->first('transaction_id')}}</p>
                </div>
                <div class="mb-4">
                    <label for="amount" class="block myTextColor1 text-sm font-bold mb-2">Amount</label>
                    <input type="number" id="amount" name="amount" class="shadow border {{$errors->first('amount') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter Amount" value="{{old('amount')}}" >
                    <p class="text-red-500 text-xs italic">{{$errors->first('amount')}}</p>
                </div>
                <div class="mb-4">
                    <label for="title" class="block myTextColor1 text-sm font-bold mb-2">Title</label>
                    <input type="text" id="title" name="title" class="shadow border {{$errors->first('title') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter title" value="{{old('title')}}" >
                    <p class="text-red-500 text-xs italic">{{$errors->first('title')}}</p>
                </div>
                <div class="mb-4">
                    <label for="description" class="block myTextColor1 text-sm font-bold mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" class="shadow border {{$errors->first('description') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">{{old('description')}}</textarea>
                    <p class="text-red-500 text-xs italic">{{$errors->first('description')}}</p>
                </div>

                <div class="mb-4">
                    <label for="issueDate" class="block myTextColor1 text-sm font-bold mb-2">Issue Date</label>
                    <input type="date" id="issueDate" name="issue_date" class="shadow border {{$errors->first('issue_date') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{old('issue_date')}}" >
                    <p class="text-red-500 text-xs italic">{{$errors->first('issue_date')}}</p>

                </div>

            </div>

        </div>



        <div class="mb-4">
            <label for="dueDate" class="block myTextColor1 text-sm font-bold mb-2">Payment Date</label>
            <input type="date" id="dueDate" name="due_date" class="shadow border {{$errors->first('due_date') ? 'border-red-500' : null}}  rounded py-2 px-3 myTextColor10 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{old('due_date')}}" required>
            <p class="text-red-500 text-xs italic">{{$errors->first('due_date')}}</p>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block myTextColor1 text-sm font-bold mb-2">Status</label>
            <select name="status" id="status" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                <option value="Paid">Paid</option>
                <option value="Waiting">Waiting</option>
            </select>
        </div>



        <div class="mt-8">
            <button type="submit" class="myBgColor3 hover:opacity-85 active:opacity-90 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Add Invoice</button>
        </div>

    </form>



</div>

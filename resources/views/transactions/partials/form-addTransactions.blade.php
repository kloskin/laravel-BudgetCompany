<div class="p-4 max-w-4xl mx-auto my-4">
    <h1 class="font-medium text-3xl">Add Transaction</h1>

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf
        <div class="mt-8 grid gap-4 ">
            <div>
                <label for="type" class="text-sm myTextColor1 block mb-2 font-bold">Transaction Type</label>
                <select name="type" id="type" class="shadow border rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                    <option value="Income">Income</option>
                    <option value="Expense">Expense</option>
                </select>
            </div>
            <div>
                <label for="amount" class="block myTextColor1 text-sm font-bold mb-2">Amount</label>
                <input type="number" id="amount" name="amount" class="shadow border {{$errors->first('amount') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter Amount" value="{{old('amount')}}" required>
                <p class="text-red-500 text-xs italic">{{$errors->first('amount')}}</p>
            </div>
            <div>
                <label for="title" class="block myTextColor1 text-sm font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" class="shadow border {{$errors->first('title') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter title" value="{{old('title')}}" required>
                <p class="text-red-500 text-xs italic">{{$errors->first('title')}}</p>
            </div>
            <div>
                <label for="description" class="block myTextColor1 text-sm font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="3" class="shadow border {{$errors->first('description') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">{{old('description')}}</textarea>
                <p class="text-red-500 text-xs italic">{{$errors->first('description')}}</p>
            </div>

            <div>
                <label for="date" class="block myTextColor1 text-sm mb-2 font-bold">Transaction Date</label>
                <input type="date" id="date" name="date" class="shadow border {{$errors->first('date') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{old('date')}}" required>
            </div>
            <p class="text-red-500 text-xs italic">{{$errors->first('date')}}</p>

            <div>
                <p class="block myTextColor1 text-sm font-bold mb-2">Do you want to add Invoice to this transaction?</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                    <div class="flex items-center ps-4 shadow border border-gray-600 rounded bg-white">
                        <input id="bordered-radio-1" type="radio" value="1" name="transaction" class="w-4 h-4 myTextColor1 focus:ring-blue-500 focus:ring-2  ">
                        <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium myTextColor1 ">Yes</label>
                    </div>
                    <div class="flex items-center ps-4 shadow border border-gray-600 rounded bg-white">
                        <input checked id="bordered-radio-2" type="radio" value="0" name="transaction" class="w-4 h-4 myTextColor1 focus:ring-blue-500  focus:ring-2 ">
                        <label for="bordered-radio-2" class="w-full py-4 ms-2 text-sm font-medium myTextColor1">No</label>
                    </div>
                </div>

            </div>

        </div>

        <div class="space-x-4 mt-8">
            <button type="submit" class="myBgColor3 py-2 px-4 text-white rounded hover:opacity-85 active:opacity-90 disabled:opacity-50 w-full">Save</button>
        </div>
    </form>
</div>

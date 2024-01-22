<x-budget_company.layout>

    <div class="w-full bg-white border border-gray-500 rounded-lg shadow mt-10">

            <ul class="myTextColor1  text-xs sm:text-lg font-medium text-center divide-x flex rounded-lg  rtl:divide-x-reverse"  role="tablist">
                <li class="w-full">
                    <div id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg rounded-se-lg focus:outline-none myBgColor1">Edit Transaction</div>
                </li>
            </ul>


            <div class="p-5 myBgColor2 myTextColor1 border-t border-gray-200 rounded-b">
                <div class="p-4 max-w-4xl mx-auto my-4">
                <h1 class="font-medium text-3xl">Edit Transaction</h1>

                <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                    @csrf
                    @method('patch')
                    <div class="mt-8 grid gap-4 ">
                        <div>
                            <label for="type" class="text-sm myTextColor1 block mb-1 font-medium">Transaction Type</label>
                            <select name="type" id="type" class="shadow border {{$errors->first('type') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">
                                <option value="Income" {{ (old('type', $transaction->type) == 'Income') ? 'selected' : '' }}>Income</option>
                                <option value="Expense" {{ (old('type', $transaction->type) == 'Expense') ? 'selected' : '' }}>Expense</option>
                                <p class="text-red-500 text-xs italic">{{$errors->first('type')}}</p>
                            </select>
                        </div>
                        <div>
                            <label for="amount" class="block myTextColor1 text-sm font-bold mb-2w">Amount</label>
                            <input type="number" id="amount" name="amount" class="shadow border {{$errors->first('amount') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter Amount" value="{{$transaction->amount}}" required>
                            <p class="text-red-500 text-xs italic">{{$errors->first('amount')}}</p>
                        </div>
                        <div>
                            <label for="title" class="block myTextColor1 text-sm font-bold mb-2w">Title</label>
                            <input type="text" id="title" name="title" class="shadow border {{$errors->first('title') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter title" value="{{$transaction->title}}" required>
                            <p class="text-red-500 text-xs italic">{{$errors->first('title')}}</p>
                        </div>
                        <div>
                            <label for="description" class="block myTextColor1 text-sm font-bold mb-2">Description</label>
                            <textarea id="description" name="description" rows="3" class="shadow border {{$errors->first('description') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full">{{$transaction->description}}</textarea>
                            <p class="text-red-500 text-xs italic">{{$errors->first('description')}}</p>
                        </div>

                        <div>
                            <label for="date" class="block myTextColor1 text-sm font-bold">Transaction Date</label>
                            <input type="date" id="date" name="date" class="shadow border  {{$errors->first('date') ? 'border-red-500' : null}} rounded py-2 px-3 myTextColor1 leading-tight focus:outline-none focus:shadow-outline w-full" value="{{$transaction->date}}" required>
                            <p class="text-red-500 text-xs italic">{{$errors->first('date')}}</p>
                        </div>

                    </div>

                    <div class="space-x-4 mt-8">
                        <button type="submit" class="myBgColor3 py-2 px-4 text-white rounded hover:opacity-85 active:opacity-90 disabled:opacity-50 w-full">Save Transaction</button>
                    </div>
                </form>
                </div>
            </div>

    </div>

</x-budget_company.layout>

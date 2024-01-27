<x-budget_company.layout>

    <div class="mx-auto px-4 py-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 h-auto md:min-h-96 ">
            <!-- Card 1 -->


            <a href="{{ $latestTransaction ? route('transactions.show', $latestTransaction) : route('transactions.index') }}" class="myBgColor1 myTextColor1 rounded-lg shadow-2xl overflow-hidden flex flex-col hover:opacity-85 cursor-pointer transition duration-300 ">
                <div class="p-5 flex-grow">
                    <!-- Content for card 1 -->
                    <h1 class="text-2xl font-bold mb-4">Last Transactions</h1>
                    <div class="myBgColor2 myTextColor1 rounded-lg overflow-hidden h-full">
                        <div class="p-5 ">
                            <!-- Content for card 1 -->
                            <div class=" font-medium mb-2 p-4 text-center">
                                @if($latestTransaction)

                                    <p class="font-bold text-2xl">{{ $latestTransaction->title }}</p>
                                    <p class="mb-2">{{ $latestTransaction->date }}</p>
                                    <hr>
                                    <p class="mt-7">Amount: <b>{{ number_format($latestTransaction->amount, 2) }} PLN</b></p>
                                    <p class="mt-2">Description: {{Str::limit( $latestTransaction->description,50,'...')}}</p>
                                    <p class="mt-2">Type: <b>{{ $latestTransaction->type }}</b></p>
                                    <p class="mt-2">{{ $latestTransaction->user->email }}</p>
                                    <!-- Dodatkowe informacje o fakturze -->
                                @else
                                    <p>No transactions found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Card 2 -->
            <a href="{{ $latestInvoice ? route('invoices.show', $latestInvoice) : route('invoices.index') }}" class="myBgColor1 myTextColor1 rounded-lg shadow-2xl hover:opacity-85 cursor-pointer transition duration-300 overflow-hidden flex flex-col">
                <div class="p-5 flex-grow">
                    <h2 class="text-2xl font-bold mb-4">Last Invoices</h2>
                    <div class=" myBgColor2 myTextColor1 rounded-lg overflow-hidden h-full">
                        <div class="p-5 ">
                            <!-- Content for card 1 -->
                            <div class=" font-medium mb-2 p-4 text-center">
                                @if($latestInvoice)

                                    <p class="font-bold text-lg md:text-2xl">{{ $latestInvoice->number }}</p>
                                    <p class="mb-2">{{ $latestInvoice->issue_date }} to {{ $latestInvoice->due_date }}</p>
                                    <hr>
                                    <p class="mt-7">Amount: <b>{{ number_format($latestInvoice->transaction->amount, 2) }} PLN</b></p>
                                    <p class="mt-2">{{Str::limit( $latestInvoice->description,50,'...') }}</p>

                                    <p class="mt-2">Status: <b>{{ $latestInvoice->status }}</b></p>
                                    <p class="mt-2">{{ $latestTransaction->user->email }}</p>
                                    <!-- Dodatkowe informacje o fakturze -->
                                @else
                                    <p>No invoices found.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </a>

            <!-- Card 3 -->
            <a href="{{route('transactions.budget')}}" class="myBgColor1 myTextColor1 rounded-lg shadow-2xl hover:opacity-85 cursor-pointer transition duration-300 overflow-hidden flex flex-col">
                <div class="p-5 flex-grow">
                    <!-- Content for card 3 -->
                    <h2 class="text-2xl font-bold mb-4">Budget</h2>
                    <div class="myBgColor2 myTextColor1 rounded-lg overflow-hidden h-full">
                        <div class="p-5 ">
                            <!-- Content for card 1 -->
                            <div class="my-10 text-center">
                                <canvas id="myChart" data-income="{{ $incomeSum }}"
                                        data-expense="{{ $expenseSum }}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>

</x-budget_company.layout>

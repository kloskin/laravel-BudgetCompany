<x-budget_company.layout>
    <div class="w-full bg-white border border-gray-500 rounded-lg shadow mt-10" x-data="{ tab:1 }">

        <ul class="myTextColor1  text-xs sm:text-lg font-medium text-center divide-x flex rounded-lg  rtl:divide-x-reverse"  role="tablist">
            <li class="w-full">
                <div id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg rounded-se-lg myBgColor1" >Invoice {{$invoice->number}}</div>
            </li>
        </ul>


        <div class="my-8 p-4 flex flex-col myTextColor1">
            <div class="text-center">
                <p>{{$invoice->user->email}}</p>
                <p class="">{{$invoice->issue_date}} <b>-</b> {{$invoice->due_date}}</p>

                <h1 class="mb-10 text-3xl font-bold tracking-tighter mt-5">{{$invoice->number}}</h1>
                <hr>
            </div>

            <div class="mt-6 text-center">
                <h3 class="text-lg font-medium mt-2">Amount:</h3>
                <p>
                    {{number_format($invoice->transaction->amount, 2) }} PLN
                </p>
                <h3 class="text-lg font-medium mt-2">Status:</h3>
                <p>
                    {{$invoice->status}}
                </p>

                <p class="my-6">
                    <a href="{{route('invoices.pdf', $invoice)}}" class="myBgColor3 py-2 px-4 text-white rounded hover:opacity-85 active:opacity-90 disabled:opacity-50 font-medium">
                        Download PDF
                    </a>
                </p>

                <p class="mt-4">
                    <a href="{{route('transactions.show', $invoice->transaction)}}" class="myBgColor3 py-2 px-4 text-white rounded hover:opacity-85 active:opacity-90 disabled:opacity-50 font-medium">
                        Transaction
                    </a>
                </p>
            </div>
            @if(Auth::id() == $invoice->user_id)
            <div class="text-center mt-10 flex justify-center items-center">
                <a href="{{route('invoices.edit', $invoice)}}" class="bg-blue-500 py-2 px-4 text-white rounded hover:opacity-85 active:opacity-90 disabled:opacity-50 font-medium mr-4">
                    Edit
                </a>
                <form method="POST" action="{{ route('invoices.destroy', $invoice) }}" class="inline">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Are you sure?')" title="delete" class="bg-red-500 py-2 px-4 text-white rounded hover:opacity-85 active:opacity-90 disabled:opacity-50 font-medium ml-4">
                        Delete
                    </button>
                </form>
            </div>
            @endif
        </div>

    </div>

</x-budget_company.layout>




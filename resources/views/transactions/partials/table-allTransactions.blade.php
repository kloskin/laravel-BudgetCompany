

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
            <th scope="col" class="px-6 py-3">
                Type
            </th>
            <th scope="col" class="px-6 py-3">
                <a href="{{ route('transactions.index', ['sort' => 'amount', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                    Amount
                        <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                </a>
            </th>
            <th scope="col" class="px-6 py-3">
                Title
            </th>
            <th scope="col" class="px-6 py-3">
                <a href="{{ route('transactions.index', ['sort' => 'date', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                    Transaction Date
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                </a>
            </th>
            <th scope="col" class="px-6 py-3">
                <a href="{{ route('transactions.index', ['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                    Created at
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                </a>
            </th>
            <th scope="col" class="px-6 py-3">
                Invoice
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Info</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)

            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$transaction->type}}
                </th>
                <td class="px-6 py-4">
                    {{number_format($transaction->amount, 2) }} PLN
                </td>
                <td class="px-6 py-4">
                    {{$transaction->title}}
                </td>
                <td class="px-6 py-4">
                    {{$transaction->date}}
                </td>
                <td class="px-6 py-4">
                    {{$transaction->created_at}}
                </td>
                {{--Tutaj chce zrobić że jeśli transakcja ma fakture to moge dać przycisk SHOW i przekieruje do strony ze szczegółami tej faktury--}}
                <td >
                    @if($transaction->invoice) <!-- Sprawdź, czy istnieje powiązana faktura -->
                    <a href="{{ route('invoices.show', $transaction->invoice->id) }}" class="px-3 py-2 text-3xl ">🧾</a>
                    @else
                        <p class="px-6 py-4">No</p>
                    @endif
                </td>
                <td class="px-6 py-4 ">
                    <a href="{{route('transactions.show', $transaction->id)}}" class="font-medium text-blue-600 hover:underline">Show</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-5 bg-white">
       {{$transactions->links()}}
    </div>

</div>

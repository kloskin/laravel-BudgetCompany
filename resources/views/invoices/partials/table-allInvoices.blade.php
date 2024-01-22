

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
            <th scope="col" class="px-6 py-3">
                Invoice Number
            </th>
            <th scope="col" class="px-6 py-3">
                <a href="{{ route('invoices.index', ['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                    Created at
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                </a>
            </th>
            <th scope="col" class="px-6 py-3">
                <a href="{{ route('invoices.index', ['sort' => 'issue_date', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                    Issue Date
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                </a>
            </th>
            <th scope="col" class="px-6 py-3">
                <a href="{{ route('invoices.index', ['sort' => 'due_date', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                    Issue Date
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                    </svg>
                </a>
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                PDF
            </th>
            <th scope="col" class="px-6 py-3 ">
                Transaction
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Info</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$invoice->number}}
                </th>
                <td class="px-6 py-4">
                    {{$invoice->created_at}}
                </td>
                <td class="px-6 py-4">
                    {{$invoice->issue_date}}
                </td>
                <td class="px-6 py-4">
                    {{$invoice->due_date}}
                </td>
                <td class="px-6 py-4">
                    @if($invoice->status=="Paid")
                        <p class="text-green-500">{{$invoice->status}}</p>
                    @elseif($invoice->status=="Waiting")
                        <p class="text-yellow-500">{{$invoice->status}}</p>
                    @else
                        <p class="text-red-500">{{$invoice->status}}</p>
                    @endif
                </td>
                <td>
                    <a href="{{ route('invoices.pdf', $invoice) }}" class="button">Download PDF</a>
                </td>
                <td>
                    @if($invoice->transaction_id!==0) <!-- Sprawdź, czy istnieje powiązana faktura -->
                    <a href="{{ route('transactions.show', $invoice->transaction_id) }}" class="px-4 py-2 text-3xl ">💵</a>
                    @else
                        <p class="px-6 py-4">No</p>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{route('invoices.show', $invoice->id)}}" class="font-medium text-blue-600 hover:underline">Show</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-5 bg-white">
        {{$invoices->links()}}
    </div>
</div>

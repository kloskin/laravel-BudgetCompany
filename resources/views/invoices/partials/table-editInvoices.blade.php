

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
            <th scope="col" class="px-6 py-3">
                Invoice Number
            </th>
            <th scope="col" class="px-6 py-3">
                Issue Date
            </th>
            <th scope="col" class="px-6 py-3">
                Payment Date
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Transaction
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Info</span>
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoicesEdit as $invoice)
            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$invoice->number}}
                </th>
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
                    @if($invoice->transaction_id!==0) <!-- Sprawdź, czy istnieje powiązana faktura -->
                    <a href="{{ route('transactions.show', $invoice->transaction_id) }}" class="px-4 py-2 text-3xl">💵</a>
                    @else
                        <p class="px-6 py-4">No</p>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{route('invoices.show', $invoice->id)}}" class="font-medium text-blue-600 hover:underline">Show</a>
                </td>
                <td class="px-6 py-4 text-right">
                    <form method="POST" action="{{ route('invoices.destroy', $invoice) }}" class="inline">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Are you sure?')" title="delete" class="cursor-pointer ml-4 font-medium text-red-600">
                            Delete
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{route('invoices.edit', $invoice->id)}}" class="font-medium text-green-600 hover:underline">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-5 bg-white">
        {{ $invoicesEdit->appends(['tab' => session('selectedTab', 3)])->links() }}
    </div>
</div>

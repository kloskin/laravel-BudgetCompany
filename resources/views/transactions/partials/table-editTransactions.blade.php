

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
            <th scope="col" class="px-6 py-3">
                Type
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
            <th scope="col" class="px-6 py-3">
                Title
            </th>
            <th scope="col" class="px-6 py-3">
                Date
            </th>
            <th scope="col" class="px-6 py-3">
                Invoice
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Info</span>
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Delete</span>
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactionsEdit as $transaction)

            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$transaction->type}}
                </th>
                <td class="px-6 py-4">
                    {{$transaction->amount}} PLN
                </td>
                <td class="px-6 py-4">
                    {{$transaction->title}}
                </td>
                <td class="px-6 py-4">
                    {{$transaction->date}}
                </td>

                <td >
                    @if($transaction->invoice) <!-- Sprawdź, czy istnieje powiązana faktura -->
                    <a href="{{ route('invoices.show', $transaction->invoice->id) }}" class="px-3 py-2 text-3xl ">🧾</a>
                    @else
                        <p class="px-6 py-4">No</p>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{route('transactions.show', $transaction->id)}}" class="font-medium text-blue-600 hover:underline">Show</a>
                </td>
                <td class="px-6 py-4 text-right">
                    <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="inline">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Are you sure?')" title="delete" class="cursor-pointer ml-4 font-medium text-red-600">
                            Delete
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{route('transactions.edit', $transaction->id)}}" class="font-medium text-green-600 hover:underline">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-5 bg-white">
        {{ $transactionsEdit->appends(['tab' => session('selectedTab', 3)])->links() }}
    </div>
</div>

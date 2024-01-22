<div class="mx-4 relative top-0.5 w-3/4">
    <label>
        <input wire:model.live="search"
               class="w-full pl-4 pr-10 py-2 rounded border border-r-0 border-gray-300 myTextColor1"
               placeholder="Search for transactions or invoices ..." type="text" name="search" />
    </label>
    <ul class="absolute w-full">
        @foreach($transactions as $transaction)
            <a href="{{ route('transactions.show', $transaction->id) }}">
                <li class="myTextColor1 pl-8 pr-2 border-b-2 border-l-2 border-r-2 border-gray-200 relative bg-white hover:bg-gray-200 hover:text-gray-900 rounded-b">
                    {{ $transaction->title }} - {{Str::limit( $transaction->description,30,'...')}}
                </li>
            </a>
        @endforeach
        @foreach($invoices as $invoice)
                <a href="{{ route('invoices.show', $invoice->id) }}">
                    <li class="myTextColor1 pl-8 pr-2 border-b-2 border-l-2 border-r-2 border-gray-200 relative bg-white hover:bg-gray-200 hover:text-gray-900 rounded-b">
                        {{ $invoice->number }}
                    </li>
                </a>
        @endforeach
    </ul>
</div>

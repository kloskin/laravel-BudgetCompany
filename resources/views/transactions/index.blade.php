<x-budget_company.layout>

    <div class="w-full bg-white border border-gray-500 rounded-lg shadow mt-10" x-data="{ tab: {{ session('errors') && session('errors')->any() ? 2 : session('selectedTab', 1) }} }">

    <ul class="myTextColor1  text-xs sm:text-lg font-medium text-center divide-x flex rounded-lg  rtl:divide-x-reverse"  role="tablist">
            <li class="w-full">
                <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg  hover:opacity-85 focus:outline-none myBgColor1"  @click="tab = 1; setTab(1)">Transactions List</button>
            </li>
            <li class="w-full">
                <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4  hover:opacity-85 focus:outline-none myBgColor1"  @click="tab = 2; setTab(2)">Add Transaction</button>
            </li>
            <li class="w-full">
                <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg  hover:opacity-85 focus:outline-none myBgColor1" @click="tab = 3; setTab(3)">Edit Transaction</button>
            </li>
        </ul>


        <div class="p-5 myBgColor2 myTextColor1 border-t border-gray-200 rounded-b">

            <div x-show="tab === 1">
                @include('transactions.partials.table-allTransactions')
            </div>

            <div x-show="tab === 2" >
                @include('transactions.partials.form-addTransactions')
            </div>

            <div x-show="tab === 3">
                @include('transactions.partials.table-editTransactions')
            </div>
        </div>
    </div>

</x-budget_company.layout>

<script>
    function setTab(tabNumber) {
        fetch('/set-tab', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // ważne dla zabezpieczeń
            },
            body: JSON.stringify({ tab: tabNumber })
        });
    }
</script>

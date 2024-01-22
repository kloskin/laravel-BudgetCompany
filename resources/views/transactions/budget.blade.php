<x-budget_company.layout>




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Ustawienie globalnych zmiennych
        window.chartData = @json($data);
        window.chartLabels = @json($months);
    </script>

    <div class="w-full bg-white border border-gray-500 rounded-lg shadow mt-10" x-data="{ tab:1 }">

        <ul class="myTextColor1  text-xs sm:text-lg font-medium text-center divide-x flex rounded-lg  rtl:divide-x-reverse"  role="tablist">
            <li class="w-full">
                <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg  hover:opacity-85 focus:outline-none myBgColor1" @click="tab = 1">January 2024</button>
            </li>
            <li class="w-full">
                <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg hover:opacity-85 focus:outline-none myBgColor1" @click="tab = 2">6 months</button>
            </li>
        </ul>


        <div class="p-5 myBgColor2 myTextColor1 border-t border-gray-200 rounded-b">

            <div x-show="tab === 1">
                <div class=" max-w-4xl mx-auto ">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">

                        <div class=" overflow-hidden hidden md:flex md:flex-col text-center">
                            <h3 class="text-xl font-bold">Income</h3>
                        </div>
                        <!-- Card 2 -->
                        <div class=" overflow-hidden hidden md:flex md:flex-col text-center">
                            <h3 class="text-xl font-bold">Expense</h3>
                        </div>

                        <!-- Card 3 -->
                        <div class=" overflow-hidden hidden md:flex md:flex-col text-center">
                            <h3 class="text-xl font-bold">Outcome</h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
                        <div class=" overflow-hidden  md:hidden text-center">
                            <h3 class="text-xl font-bold">Income</h3>
                        </div>
                        <div class="bg-green-500 myTextColor1 rounded-lg shadow-2xl overflow-hidden flex flex-col hover:opacity-85 transition duration-300">
                            <div class="p-5 flex-grow text-center">
                             <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                      </svg> +{{ number_format($incomeSum, 2) }} PLN</span>
                            </div>
                        </div>

                        <div class=" overflow-hidden  md:hidden text-center">
                            <h3 class="text-xl font-bold">Expense</h3>
                        </div>
                        <div class="bg-red-500 myTextColor1 rounded-lg shadow-2xl hover:opacity-85 transition duration-300 overflow-hidden md:flex md:flex-col ">
                            <div class="p-5 flex-grow text-center">
                                    <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-danger bg-danger-light rounded-lg">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
                          </svg>-{{ number_format($expenseSum, 2) }} PLN</span>
                            </div>
                        </div>

                        <div class=" overflow-hidden  md:hidden text-center">
                            <h3 class="text-xl font-bold">Outcome</h3>
                        </div>
                        <div class="bg-blue-400 myTextColor1 rounded-lg shadow-2xl hover:opacity-85 transition duration-300 overflow-hidden md:flex md:flex-col">
                            <div class="p-5 flex-grow text-center">
                                <span class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none">{{number_format($outcomeSum=$incomeSum-$expenseSum ,2)}} PLN</span>
                            </div>
                        </div>

                    </div>
                    <div class="my-10">
                        <canvas id="myChart" data-income="{{ $incomeSum }}"
                                data-expense="{{ $expenseSum }}"></canvas>
                    </div>
                </div>


            </div>

            <div x-show="tab === 2" >
                <div class="md:mx-40 my-4">
                    <h3 class="text-center text-lg md:text-3xl font-bold">Outcome from last 6 months</h3>
                    <canvas id="myChart2" data-income="{{ $incomeSum }}"
                            data-expense="{{ $expenseSum }}"></canvas>
                </div>
            </div>

        </div>
    </div>

</x-budget_company.layout>


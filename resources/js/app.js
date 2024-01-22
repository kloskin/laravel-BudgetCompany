import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const btn = document.getElementById("hamburger-icon");
const nav = document.getElementById("mobile-menu");

btn.addEventListener("click", () => {
    nav.classList.toggle("flex");
    nav.classList.toggle("hidden");
})


document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('myChart');
    const incomeSum = Number(ctx.dataset.income);
    const expenseSum = Number(ctx.dataset.expense);
    const outcomeSum = incomeSum - expenseSum;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Income', 'Expense', 'Outcome'],
            datasets: [{
                label: 'PLN',
                data: [incomeSum, -expenseSum, outcomeSum],
                borderWidth: 1,
                backgroundColor: [
                    'rgb(34,197,94)',
                    'rgb(239,68,68)',
                    'rgb(96,165,250)',
                ],
            }]

        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const ctx2 = document.getElementById('myChart2');

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: window.chartLabels,
            datasets: [{
                label: 'PLN',
                data: window.chartData,
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.5
            }]
        },
    });
});


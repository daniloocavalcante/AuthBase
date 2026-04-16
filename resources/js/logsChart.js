import Chart from 'chart.js/auto';

export default function initLogsChart() {
    const ctx = document.getElementById('logsChart');

    if (!ctx) return;

    const labels = ctx.dataset.labels ? JSON.parse(ctx.dataset.labels) : [];
    const data = ctx.dataset.data ? JSON.parse(ctx.dataset.data) : [];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Atividades',
                data: data,
                tension: 0.3,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}
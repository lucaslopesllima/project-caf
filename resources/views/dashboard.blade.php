<x-app-layout>
    <main class="flex-1 p-6 ">
        <header class="bg-blue-800 text-white p-4 shadow">
            <h1 class="text-2xl font-bold">Painel de Controle</h1>
            <p class="text-sm text-blue-200">Resumo das atividades do sistema</p>
        </header>
        <main class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="base-200 p-4 rounded shadow">
                    <p class="text-base-content">Beneficiários</p>
                    <h2 class="text-2xl font-bold text-blue-700">154</h2>
                </div>
                <div class="base-200 p-4 rounded shadow">
                    <p class="text-base-content">Voluntários</p>
                    <h2 class="text-2xl font-bold text-green-600">32</h2>
                </div>
                <div class="base-200 p-4 rounded shadow">
                    <p class="text-base-content">Projetos Ativos</p>
                    <h2 class="text-2xl font-bold text-purple-600">5</h2>
                </div>
                <div class="base-200 p-4 rounded shadow">
                    <p class="text-base-content">Questionários Respondidos</p>
                    <h2 class="text-2xl font-bold text-orange-500">211</h2>
                </div>
            </div>
            <div class="base-200 p-6 rounded shadow mb-6">
                <h3 class="text-lg font-semibold mb-4">Beneficiários Cadastrados por Mês</h3>
                <canvas id="graficoBeneficiarios" height="50"></canvas>
            </div>
            <div class="base-200 p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-2">Últimos Beneficiários Cadastrados</h3>
                <ul class="text-sm text-gray-700">
                    <li class="text-base-content border-b py-2">Maria da Silva - 15/04/2025</li>
                    <li class="text-base-content border-b py-2">João Oliveira - 14/04/2025</li>
                    <li class="text-base-content border-b py-2">Carlos Mendes - 13/04/2025</li>
                    <li class="text-base-content py-2">Ana Paula - 12/04/2025</li>
                </ul>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('graficoBeneficiarios').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                        datasets: [{
                            label: 'Beneficiários',
                            data: [8, 12, 15, 20, 18, 22, 30, 27, 25, 21, 19, 24],
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 5,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 5
                                }
                            }
                        }
                    }
                });
            });
        </script>


    </main>
</x-app-layout>
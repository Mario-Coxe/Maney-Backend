<!DOCTYPE html>
<html>

<head>
    <title>Seu Título</title>
    <style>
        /* Estilos para os cards */
        .card {
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text {
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <!-- Cards para os totais -->
        <div class="card">
            <h5 class="card-title">Clientes</h5>
            <p class="card-text">{{$totalClientes}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">Agentes</h5>
            <p class="card-text">{{$totalAgentes}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">ATMs</h5>
            <p class="card-text">{{$totalAtms}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">ATM controlados por Agentes</h5>
            <p class="card-text">{{$totalATMagentes}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">Ruas</h5>
            <p class="card-text">{{$totalRuas}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">Municipios</h5>
            <p class="card-text">{{$totalMunicipios}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">Usuários Subscritos</h5>
            <p class="card-text">{{$totalUserSubscription}}</p>
        </div>
        <div class="card">
            <h5 class="card-title">Toltal ATMs sem Agentes</h5>
            <p class="card-text">{{$totalATMsemAgente}}</p>
        </div>
    </div>

    <!-- Seu código JavaScript para criar os gráficos (mantive o código anterior) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(function() {
            var ctx = document.getElementById('chart').getContext('2d');
            var data = {
                labels: ['Usuários', 'ATMs', 'Publicidades', 'Ruas'],
                datasets: [{
                    label: 'Totais',
                    data: [{
                        {
                            $totalAgentes + $totalClientes
                        }
                    }, {
                        {
                            $totalAtms
                        }
                    }, {
                       
                    }, {
                        {
                            $totalRuas
                        }
                    }],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 10
                }]
            };
            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            var chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        });
    </script>
</body>

</html>
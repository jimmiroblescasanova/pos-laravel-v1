@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header border-0">
                    Gráfica de ventas
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="salesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><sup style="font-size: 20px">$</sup>{{ number_format($dailySales/100, 2) }}</h3>
                    <p>Ventas del día</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cash-register"></i>
                </div>
                <a href="{{ route('sales.index') }}" class="small-box-footer">Ir a ventas <i class="fas fa-arrow-circle-right ml-2"></i></a>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    Top 5 productos 
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="productChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('third_party_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const sChart = document.getElementById('salesChart');
    new Chart(sChart, {
        type: 'bar',
        data: {
            labels: {{ Js::from($historySales->keys()) }},
            datasets: [{
            label: 'Total del mes',
            data: {{ Js::from($historySales->values()) }},
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }, 
        }
    });

    const pChart = document.getElementById('productChart');
    new Chart(pChart, {
        type: 'pie',
        data: {
            labels: {{ Js::from($top5products->keys()) }},
            datasets: [{
                label: 'Ventas',
                data: {{ Js::from($top5products->values()) }},
                borderWidth: 1,
                hoverOffset: 9,
            }]
        }, 
        options: {
            plugins: {
                legend: {
                    position: "bottom",
                    align: "middle"
                }
            }
        }
    });
</script>
@endpush
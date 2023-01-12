@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header border-0">
                    Gráfica de ventas
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
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
            <div class="card card-danger card-outline">
                <div class="card-header border-0">
                    Top 5 productos
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-valign-middle">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top10products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->getFirstMediaUrl('product', 'thumb') }}" width="50px" class="image-circle mr-2">
                                    {{ $product->name }}
                                </td>
                                <td class="text-right">{{ $product->total_sales }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('third_party_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    let labels = {{ Js::from($chartLabels) }}
    let data = {{ Js::from($chartData) }}

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
            label: 'Ventas del Mes',
            data: data,
            borderWidth: 1
            }]
        },
            options: {
                scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
</script>
@endpush
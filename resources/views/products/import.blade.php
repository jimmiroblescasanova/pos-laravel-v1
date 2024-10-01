@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Carga masiva de productos</h1>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="{{ route('products.handleImport') }}" id="form" enctype="multipart/form-data" method="POST">
                        @csrf 
                        <div class="form-group">
                            <label for="file">Seleccionar archivo:</label>
                            <input type="file" name="file" id="file" class="form-control-file" accept=".csv,.xls,.xlsx" required>
                            <span class="text-xs text-muted">Extensiones permitidas: .csv | .xls | .xlsx</span>
                            <p class="text-xs text-muted"><a href="{{ asset('examples/productos.csv') }}" download>DESCARGAR</a> plantilla para carga masiva</p>
                        </div>
                        <button type="submit" id="submit" class="btn btn-sm btn-primary"><i class="fas fa-upload mr-2"></i>Cargar productos</button>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <p class="text-bold">Resultados de la carga:</p>
                    @if (session()->has('failures'))
                        <table class="table table-sm table-danger">
                            <tr>
                                <th>Fila</th>
                                <th>Campo</th>
                                <th>Errores</th>
                            </tr>
                            @foreach (session()->get('failures') as $failure)
                            <tr>
                                <td>{{ $failure->row() }}</td>
                                <td>{{ $failure->attribute() }}</td>
                                <td>
                                    <ul>
                                        @foreach ($failure->errors() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@push('third_party_scripts')
    <script>
        let form = document.getElementById('form');
        let submit = document.getElementById('submit');

        form.addEventListener('submit', () => {
            submit.disabled = true;
            submit.innerHTML = '<i class="fas fa-spinner mr-2"></i>Cargando...';
        });
    </script>
@endpush
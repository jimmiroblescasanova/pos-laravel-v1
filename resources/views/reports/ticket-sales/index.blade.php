@extends('layouts.app')

@section('content-header')
    <div class="col-12">
        <h1 class="m-0">Reporte: Ventas por Ticket en Excel</h1>
    </div>
@endsection

@section('content')
<div class="col-12 col-md-4">
    <div class="card">
        <div class="card-header">
            Parámetros del reporte
        </div>
        <form action="{{ route('reports.sales.ticket-sales.download') }}" method="POST">
            @csrf 
            <div class="card-body">
                <div class="form-group">
                    <label for="startDate">Fecha Inicial</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                    @error('startDate')
                        <span class="text-xs text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="endDate">Fecha Final</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                    @error('endDate')
                        <span class="text-xs text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Descargar reporte XLS
                </button>
            </div>
        </form>
    </div>
</div>
@stop
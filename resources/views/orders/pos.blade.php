@extends('layouts.app')

@section('content-header')
    <div class="col-12 col-sm-6">
        <h1 class="m-0">Punto de Venta</h1>
    </div>
    <div class="col-12 col-sm-6 text-right">
        <form action="{{ route('orders.delete', $order) }}" method="post" id="emptyCartForm">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-cart-arrow-down mr-2"></i>
                Vaciar Carrito
            </button>
        </form>
    </div>
@endsection

@section('content')
    @livewire('order.create-order', ['order' => $order])
@stop

@push('third_party_scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const emptyCartForm = document.getElementById('emptyCartForm');

            emptyCartForm.addEventListener('submit', (e) => {
                e.preventDefault();
                if (confirm('El folio completo será eliminado, ¿Seguro?')) {
                    emptyCartForm.submit();
                }
            });
        });
    </script>
@endpush

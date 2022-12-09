@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Inventario</h1>
@endsection

@section('content')
    @livewire('inventory.index-inventory')

    <!-- Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modificar inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('inventory.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="minimum">Cantidad min en almacen</label>
                            <input type="text" class="form-control" name="minimum" id="minimum" required>
                        </div>
                        <div class="form-group">
                            <label for="inventory">Existencia total</label>
                            <input type="text" class="form-control" name="inventory" id="inventory" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('third_party_scripts')
    <script type="module">
        const myModal = $('#edit-modal');
        let inputProduct = document.querySelector('input[name="product"]');
        let inputMinimum = document.querySelector('input[name="minimum"]');
        let inputInventory = document.querySelector('input[name="inventory"]');
        
        $('.btn-edit').on('click', function(e) {
            $.ajax({
                type: 'POST',
                url: "/api/product",
                data: {id:$(e.target).data('product')},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: (data) => {
                    console.log(data.id);
                    inputProduct.value = data.id;
                    inputMinimum.value = data.minimum;
                    inputInventory.value = data.inventory;
                }, 
                error: () => {
                    console.log('error');
                }
            });
            myModal.modal('show');
        });
    </script>
@endpush

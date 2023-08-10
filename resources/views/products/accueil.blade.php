@extends('layouts.app')

@section('title', 'Data product')

@section('contents')
    <div class="card shadow mb-4">
        <div  class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data product</h6>
        </div>
        <div class="card-body">
                @if (auth()->user()->level == 'Admin')
            <a href="{{ route('products.add') }}" class="btn btn-primary mb-3">Add product</a>
                @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>images</th>
                            <th>Code product</th>
                            <th>Name product</th>
                            <th>Category</th>
                            <th>Price</th>
                                    @if (auth()->user()->level == 'Admin')
                            <th>Action</th>
                                    @endif
                        </tr>
                    </thead>
                    <tbody>
                    @php( $no = 1)
                    @foreach ($data as $row)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <th> <img style="width:50px; height:auto;" src="{{ asset(''.$row->image) }}"/></th>
                            <td>{{ $row->item_code }}</td>
                            <td>{{ $row->productname }}</td>
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->price }}</td>
                                        @if (auth()->user()->level == 'Admin')
                            <td>
                                <a href="{{ route('products.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('products.delete', $row->id) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ route('products.show', $row->id) }}" class="btn btn-primary">Details</a>

                            </td>
                                        @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        // Écouteur d'événement pour le clic sur le bouton "Details"
        $('#dataTable').on('click', '.btn-primary', function() {
            var productId = $(this).data('id');
            window.location.href = '/products/details/' + productId; // Rediriger vers la nouvelle page
        });
    });
</script>


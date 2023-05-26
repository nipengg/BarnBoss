@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Order</h1>
        </div>

        <table id="myTable" class="table table-image table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status Order</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders != null)
                    @foreach ($orders as $p)
                        @foreach ($p as $item)
                            <tr>
                                <td>{{ $item->invoice_id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>@currency($item->total)</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#exampleModal{{ $item->invoice_id }}">Edit order status</button>

                                    <div class="modal fade" id="exampleModal{{ $item->invoice_id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('order.status.update', $item->invoice_id) }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit order
                                                            #{{ $item->invoice_id }} status</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">Status</label>
                                                            <select class="form-control" name="status" id="status">
                                                                <option value="Rejected"
                                                                    {{ $item->status == 'Rejected' ? 'selected' : '' }}>
                                                                    Rejected</option>
                                                                <option value="Pending"
                                                                    {{ $item->status == 'Pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="Packaging"
                                                                    {{ $item->status == 'Packaging' ? 'selected' : '' }}>
                                                                    Packaging</option>
                                                                <option value="Sending"
                                                                    {{ $item->status == 'Sending' ? 'selected' : '' }}>
                                                                    Sending</option>
                                                                <option value="Done"
                                                                    {{ $item->status == 'Done' ? 'selected' : '' }}>Done
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" type="button"
                                                            class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('#myTable').DataTable();
        })

        $('#exampleModal').on('show.bs.modal', function(event) {
            $('#myInput').trigger('focus')
        })
    </script>
@endsection

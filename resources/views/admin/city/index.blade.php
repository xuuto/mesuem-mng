@extends('admin.app')

@section('title') City Management @endsection
@push('styles')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Cities</h1>
            {{--            <p>{{ $subTitle }}</p>--}}
        </div>
        <a href="{{ route('cities.create') }}" class="btn btn-primary pull-right">Create new City</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable" id="sampleTable">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th> Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('cities.edit', $city->id) }}"
                                               class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('cities.destroy', $city->id) }}"
                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                        {{--                                        <form action="{{ route('cities.destroy', $city) }}" method="post">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            @method('DELETE')--}}
                                        {{--                                            <button type="submit" class="btn btn-sm btn-danger">--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    {{--    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>--}}
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var table = $('#sampleTable').DataTable({
            dom: 'lBfrtip',
            columnDefs: [
                {
                    targets: 1,
                    className: 'noVis'
                }
            ],
            buttons: [
                'excel',
                'csv',
                'pdf',
                'print'
            ],
            "order": [[ 0, 'asc' ]],
        });
        table.buttons().container()
            .appendTo( $('.dt-buttons', table.table().container() ) );
    </script>
@endpush


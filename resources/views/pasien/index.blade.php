@extends('layouts.app')

@section('title', 'Pasien')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Pasien</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('pasien.export') }}" class="btn btn-primary mr-2">Export Pasien</a>
            <a href="{{ route('pasien.create') }}" class="btn btn-primary">Add Pasien</a>
        </div>
    </div>
    <hr />
    <table class="datatable table table-hover" id="pasien-table">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>No Pasien</th>
                <th>Nama</th>
                <th>No KTP</th>
                <th>Usia</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
    <script src="{!! asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#pasien-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pasien.table') }}',
            columns: [
              {data: 'DT_RowIndex', name: 'no'},
              {data: 'no_pasien', name: 'no_pasien'},
              {data: 'name', name: 'name'},
              {data: 'no_ktp', name: 'no_ktp'},
              {data: 'age', name: 'age'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            bInfo: false
          })
        })
    </script>
@endsection

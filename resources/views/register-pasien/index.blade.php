@extends('layouts.app')

@section('title', 'Register Pasien')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Register Pasien</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('register-pasien.export') }}" class="btn btn-primary mr-2">Export Register Pasien</a>
            <a href="{{ route('register-pasien.create') }}" class="btn btn-primary">Add Register Pasien</a>
        </div>
    </div>
    <hr />
    {{-- <form action="{{ route('register-pasien.search') }}" method="POST">
        @csrf
        <input type="text" name="date_picker" id="date_picker" value="{{ date_format(now(), "Y-m-d") }}" class="form-control datepicker d-flex justify-content-end" placeholder="e.g. 2000-01-01" autocomplete="off"/>
        <button class="btn btn-primary" type="submit">Pilih</button>
    </form> --}}
    <table class="datatable table table-hover" id="register-pasien-table">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>No Pasien</th>
                <th>No Register</th>
                <th>Poli</th>
                <th>Pay Status</th>
                <th>Tanggal Registrasi</th>
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
          $('#register-pasien-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('register-pasien.table') }}',
            columns: [
              {data: 'DT_RowIndex', name: 'no'},
              {data: 'no_pasien', name: 'no_pasien'},
              {data: 'no_register', name: 'no_register'},
              {data: 'poli', name: 'poli'},
              {data: 'pay_status', name: 'pay_status'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            bInfo: false
          })

            // $('#date_picker').datepicker({
            //     "format": "yyyy-mm-dd",
            //     "keyboardNavigation": false
            // });
        })
    </script>
@endsection

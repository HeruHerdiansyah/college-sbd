@extends('layouts.app')

@section('title', 'Pasien')

@section('contents')
    <section class="content">
        <h1 class="mb-0">{{ @$data ? 'Edit' : 'Add' }} Pasien</h1>
        <hr />

        <div class="box box-primary">
            <form action="{{ (@$data) ? route('pasien.update', $data->id) : route('pasien.store') }}" method="POST" enctype="multipart/form-data" id="form-pasien">
                @csrf
                <div class="box-body">
                    @include('pasien.form')
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('pasien') }}" class="btn btn-danger btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm" id="submit-pasien">{{ (@$data) ? 'Edit' : 'Add' }}</button>
                </div>
            </form>
            <!-- /.box-footer-->
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.datepicker').datepicker({
            "format": "yyyy-mm-dd",
            "keyboardNavigation": false
        });
    </script>
@endsection
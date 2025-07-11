@extends('layouts.app')

@section('title', 'Register Pasien')

@section('contents')
    <section class="content">
        <h1 class="mb-0">Add Register Pasien</h1>
        <hr />

        <div class="box box-primary">
            <form action="{{ route('register-pasien.store') }}" method="POST" enctype="multipart/form-data" id="form-pasien">
                @csrf
                <div class="box-body">
                    @include('register-pasien.form')
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('register-pasien') }}" class="btn btn-danger btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm" id="submit-pasien">Add</button>
                </div>
            </form>
            <!-- /.box-footer-->
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#select-pasien, #select-poli').select2();
        });
    </script>
@endsection
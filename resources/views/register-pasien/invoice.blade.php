@extends('layouts.app')

@section('title', 'Register Pasien')

@section('contents')
    <section class="content">
        <h1 class="mb-0">Invoice Register Pasien</h1>
        <hr />

        <div class="box box-primary">
            <form action="{{ route('register-pasien.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="form-pasien">
                @csrf
                <div class="box-body">
                    @include('register-pasien.form-invoice')
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('register-pasien') }}" class="btn btn-danger btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-success btn-sm" id="submit-pasien">Pay</button>
                </div>
            </form>
            <!-- /.box-footer-->
        </div>
    </section>
@endsection
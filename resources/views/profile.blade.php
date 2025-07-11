@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="">
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile</h4>
                    </div>
                    <div class="row" id="res"></div>
                    <div class="row mt-2">

                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" name="name" disabled class="form-control" placeholder=""
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" name="email" disabled class="form-control"
                                value="{{ auth()->user()->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Role</label>
                            <input type="text" name="level" disabled class="form-control" placeholder=""
                                value="{{ auth()->user()->level }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

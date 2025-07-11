@if(@$data)
    <div class="form-group">
        <label>No Pasien</label>
        <input type="text" value="{{ (@$data->no_pasien) ?? '' }}" class="form-control" placeholder="No Pasien" autocomplete="off" disabled/>
    </div>
@endif
<div class="form-group {!! $errors->first('name', 'has-error') !!}">
    <label>Name</label><span class="required-field-sign"></span>
    <input type="text" name="name" value="{{ (@$data->name) ?? old('name') }}" class="form-control" placeholder="Name" autocomplete="off"/>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('email', 'has-error') !!}">
    <label>Email</label><span class="required-field-sign"></span>
    <input type="email" name="email" value="{{ (@$data->email) ?? old('email') }}" class="form-control" placeholder="Email" autocomplete="off"/>
    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('no_ktp', 'has-error') !!}">
    <label>No KTP</label><span class="required-field-sign"></span>
    <input type="text" name="no_ktp" value="{{ (@$data->no_ktp) ?? old('no_ktp') }}" class="form-control" placeholder="No KTP" autocomplete="off" {{ @$data ? 'disabled' : '' }}/>
    {!! $errors->first('no_ktp', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('address', 'has-error') !!}">
    <label>Address</label><span class="required-field-sign"></span>
    <textarea name="address" class="form-control" autocomplete="off">{{ (@$data->address) ?? old('address') }}</textarea>
    {!! $errors->first('address', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('place_of_birth', 'has-error') !!}">
    <label>Place of Birth</label><span class="required-field-sign"></span>
    <input type="text" name="place_of_birth" value="{{ (@$data->place_of_birth) ?? old('place_of_birth') }}" class="form-control" placeholder="Place of Birth" autocomplete="off"/>
    {!! $errors->first('place_of_birth', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('date_of_birth', 'has-error') !!}">
    <label>Date of Birth</label><span class="required-field-sign"></span>
    <input type="text" name="date_of_birth" value="{{ (@$data->date_of_birth) ?? old('date_of_birth') }}" class="form-control datepicker" placeholder="e.g. 2000-01-01" autocomplete="off"/>
    {!! $errors->first('date_of_birth', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('gender', 'has-error') !!}">
    <label>Gender</label><span class="required-field-sign"></span>
    <div class="form-check">
        <input class="form-check-input"
            type="radio" name="gender" id="gender-male" value="male"
            {{ (@$data->gender == 'male' || old('gender') == 'male') ? 'checked' : '' }}>
        <label class="form-check-label" for="gender-male">
            Male
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input"
            type="radio" name="gender" id="gender-female" value="female"
            {{ (@$data->gender == 'female' || old('gender') == 'female') ? 'checked' : '' }}>
        <label class="form-check-label" for="gender-female">
            Female
        </label>
    </div>
    {!! $errors->first('gender', '<p class="text-danger">:message</p>') !!}
</div>
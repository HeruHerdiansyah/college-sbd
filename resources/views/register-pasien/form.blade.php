<div class="form-group {!! $errors->first('pasien_id', 'has-error') !!}">
    <label>Pasien</label><span class="required-field-sign"></span>
    <select class="form-control" name="pasien_id" id="select-pasien">
        <option value="" disabled selected>Select pasien</option>
        @foreach (@$pasien as $p)
            <option value="{{ $p->id }}" {{ (old('pasien_id') == $p->id) ? 'selected' : '' }}>{{ $p->no_pasien }} - {{ $p->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('pasien_id', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group {!! $errors->first('poli_id', 'has-error') !!}">
    <label>Poli</label><span class="required-field-sign"></span>
    <select class="form-control" name="poli_id" id="select-poli">
        <option value="" disabled selected>Select poli</option>
        @foreach (listPoli() as $k => $po)
            <option value="{{ $k }}" {{ (old('poli_id') == $k) ? 'selected' : '' }}>{{ $po['name'] }}</option>
        @endforeach
    </select>
    {!! $errors->first('poli_id', '<p class="text-danger">:message</p>') !!}
</div>
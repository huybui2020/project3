
<div class="form-group{{ $errors->has('catalog_name') ? 'has-error' : ''}}">
    {!! Form::label('catalog_name', 'Catalog Name', ['class' => 'control-label']) !!}
    {!! Form::text('catalog_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('catalog_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('catalog_active') ? 'has-error' : ''}}">
    {!! Form::label('catalog_active', 'Catalog Active', ['class' => 'control-label']) !!}
    <div class="checkbox">
    <label>{!! Form::radio('%1$s', '1') !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('%1$s', '0', true) !!} No</label>
</div>
    {!! $errors->first('catalog_active', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

<div class="form-group{{ $errors->has('catalog_id') ? 'has-error' : ''}}">
    {!! Form::label('catalog_id', 'Catalog Name', ['class' => 'control-label']) !!}
    {!! Form::select('catalog_id', $catalogs, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('catalog_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('product_name') ? 'has-error' : ''}}">
    {!! Form::label('product_name', 'Product Name', ['class' => 'control-label']) !!}
    {!! Form::text('product_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', null, ['id' => 'summary-ckeditor1']) !!}
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::number('price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('discount') ? 'has-error' : ''}}">
    {!! Form::label('discount', 'Discount', ['class' => 'control-label']) !!}
    {!! Form::number('discount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

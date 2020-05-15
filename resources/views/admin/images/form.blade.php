<div class="form-group{{ $errors->has('product_id') ? 'has-error' : ''}}">
    {!! Form::label('product_id', 'Product Name', ['class' => 'control-label']) !!}
    {!! Form::select('product_id', $productss, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('product_image') ? 'has-error' : ''}}">
    {!! Form::label('product_image', 'Product Image', ['class' => 'control-label']) !!}
    {!! Form::file('product_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('product_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('product_image_desc') ? 'has-error' : ''}}">
    {!! Form::label('product_image_desc', 'Product Image Desc', ['class' => 'control-label']) !!}
    {!! Form::text('product_image_desc', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('product_image_desc', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

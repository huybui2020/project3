<div class="form-group{{ $errors->has('customer_id') ? 'has-error' : ''}}">
    {!! Form::label('customer_id', 'Customer Id', ['class' => 'control-label']) !!}
    {!! Form::number('customer_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('product_id') ? 'has-error' : ''}}">
    {!! Form::label('product_id', 'Product Id', ['class' => 'control-label']) !!}
    {!! Form::number('product_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('qty') ? 'has-error' : ''}}">
    {!! Form::label('qty', 'Qty', ['class' => 'control-label']) !!}
    {!! Form::number('qty', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
    {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::textarea('status', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

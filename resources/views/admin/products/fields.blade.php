<div class="form-group {{$errors->has('name') ? 'invalid' : ''}}">
    {!! Form::label('productName', 'Product Name:') !!}
    {!! Form::text('name', $product->name, ['class' => 'form-control border-input', 'placeholder' =>
    'Macbook pro' ]) !!}
    <span class="invalid-feedback">
        {{$errors->has('name') ? $errors->first('name') : ''}}
    </span>
</div>

<div class="form-group {{$errors->has('price') ? 'invalid' : ''}}">
    {!! Form::label('productPrice', 'Product Price:') !!}
    {!! Form::text('price', $product->price, ['class' => 'form-control border-input', 'placeholder' =>
    '$2500' ]) !!}
    <span class="invalid-feedback">
        {{$errors->has('price') ? $errors->first('price') : ''}}
    </span>
</div>

<div class="form-group {{$errors->has('description') ? 'invalid' : ''}}">
    {!! Form::label('productDescription', 'Product Description:') !!}
    {!! Form::textarea('description', $product->description, ['class' => 'form-control border-input', 'cols' =>
    '30', 'rows' => '10', 'placeholder' => 'Product Description']) !!}
    <span class="invalid-feedback">
        {{$errors->has('description') ? $errors->first('description') : ''}}
    </span>
</div>

<div class="form-group {{$errors->has('image') ? 'invalid' : ''}}">
    {!! Form::label('productImage', 'Product Image:') !!}
    {!! Form::file('image', ['class' => 'form-control border-input', 'id' => 'image']) !!}
    <div id="thumb-output"></div>
    <span class="invalid-feedback">
        {{$errors->has('image') ? $errors->first('image') : ''}}
    </span>
</div>

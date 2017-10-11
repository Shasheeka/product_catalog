@extends('layouts.app')

@push('pagetitle')

@section('content')
    <div class="panel panel-default col-md-12">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading " >
                        <div class="row">
                            <div class="col-lg-12 text-center section-head">
                                <h2> Edit Product </h2>
                                <hr class="star-primary">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div> <!-- end .flash-message -->
                        <form class="form-horizontal" method="POST" action="/products/save" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="col-md-8">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Product Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control" name="name" value="{{ $product->name }}" >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea  style="height:100px;"  id="description" type="text" class="form-control" name="description" >{{ $product->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Price (￥)</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" value="{{ $product->price }}"  autofocus>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">
                                    {{--<input id="category_id" type="text" class="form-control" name="category_id" value="{{ old('category_id') }}" required autofocus>--}}

                                    <select class="form-control" name="category">
                                        {{--  <option value="0">All Products</option>--}}
                                        @foreach($subCat as $key=>$item)
                                            <option {{(isset($product) && $product->category_id ==$key)? 'selected':'' }}  value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>


                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('specification') ? ' has-error' : '' }}">
                                <label for="specification" class="col-md-4 control-label">Specification</label>

                                <div class="col-md-6">
                                    <input id="specification" type="text" class="form-control" name="specification" value="{{ $product->specification  }}"  autofocus>

                                    @if ($errors->has('specification'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('specification') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('precautions') ? ' has-error' : '' }}">
                                <label for="precautions" class="col-md-4 control-label">precautions</label>

                                <div class="col-md-6">
                                    <input id="precautions" type="text" class="form-control" name="precautions" value="{{ $product->precautions  }}"  autofocus>

                                    @if ($errors->has('precautions'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('precautions') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('ingredients') ? ' has-error' : '' }}">
                                <label for="ingredients" class="col-md-4 control-label">Ingredients</label>

                                <div class="col-md-6">
                                    <textarea  style="height:100px;"  id="ingredients" type="text" class="form-control" name="ingredients" >{{ $product->ingredients }}</textarea>

                                    @if ($errors->has('ingredients'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ingredients') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('instructions') ? ' has-error' : '' }}">
                                <label for="instructions" class="col-md-4 control-label">Instructions</label>

                                <div class="col-md-6">

                                    <textarea  style="height:100px;"  id="instructions" type="text" class="form-control" name="instructions"   autofocus >{{ $product->instructions }}</textarea>

                                    @if ($errors->has('instructions'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('instructions') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input style="display: none" id="product_id" type="text" class="form-control" name="product_id" value="{{ $product->id  }}"  autofocus>



                            </div>
                            <div class="col-md-4">

                                <div><img height="260" width="260" src="{{'/images/'.$product->photo }}" />
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                        <input  id="image" accept="image/*"   type="file" name="image"  />
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
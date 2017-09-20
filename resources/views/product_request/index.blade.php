@extends('layouts.app')

@push('pagetitle')

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading " >
                        <div class="row">
                            <div class="col-lg-12 text-center section-head">
                                <h2> Product Request</h2>
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
                        <form class="form-horizontal" method="POST" action="/product-request" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                                <label for="categories" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">
                                    {{--<input id="category_id" type="text" class="form-control" name="category_id" value="{{ old('category_id') }}" required autofocus>--}}



                                    <select id="categories" name="categories" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as  $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('categories'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control" name="description" > </textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image1') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Relevant Files</label>

                                <div class="col-md-6">
                                    <input  id="image" accept="image/*"   type="file" name="image1"  />
                                    @if ($errors->has('image1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image2') ? ' has-error' : '' }}">
                                <label for="image2" class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <input  id="image2" accept="image/*"   type="file" name="image2"  />
                                    @if ($errors->has('image2'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image3') ? ' has-error' : '' }}">
                                <label for="image3" class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <input  id="image3" accept="image/*"   type="file" name="image3"  />
                                    @if ($errors->has('image3'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image3') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Request
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
@extends('layouts.app')

@push('pagetitle')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div> <!-- end .flash-message -->
            <div class="panel panel-default">
                <div class="panel-heading "   style="margin-top: 70px">
                    <div class="row">
                        <div class="col-lg-12 text-center section-head">
                            <h2> Products upload</h2>
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
                    <form class="form-horizontal" method="POST" action="/products/upload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('excelFile') ? ' has-error' : '' }}">
                            <label for="excel" class="col-md-4 control-label">Select </label>

                            <div class="col-md-6">
                                <input  id="excelFile" accept="file_extension/.csv,.xls,.xlsx"   type="file" name="excelFile"  />
                                @if ($errors->has('excelFile'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('excelFile') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
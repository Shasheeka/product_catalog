@extends('layouts.app')

@push('pagetitle')

@section('content')
    @if (count($products) > 0)
        <div class="panel panel-default">

            <div class="panel-heading " >
                <div class="row">
                    <div class="col-lg-12 text-center section-head">
                        <h2> Products</h2>
                        <hr class="star-primary">
                        <div class="col-md-12 ">

                            <form action="">
                                <div class="col-md-2">
                                    <label class="control-label">Select Sub Category</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="sub_cat">
                                      {{--  <option value="0">All Products</option>--}}
                                        @foreach($catList as $key=>$item)
                                            <option  {{($search_sub_cat ==$key)? 'selected':'' }}  value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">

                                    <input name="product" class="form-control" type="text" placeholder="product name">
                                </div>
                                <div class="col-md-2">
                                    <button  class="btn-primary form-control " >Search</button>
                                </div>
                            </form>

                            <div class="col-md-2">
                                @if(Auth::check())

                                    <a href="{{route('createSingleProduct')}}">
                                        <button class="btn form-control btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Add Product</button>
                                    </a>

                                @endif


                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <table class="table table-bordered table-invers">

                    <!-- Table Headings -->
                    <thead>
                    <th>Product Photo</th>
                    <th>Product Name <br>(Chinese/English) </th>
                    <th>Category</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Specification</th>
                    <th>Precautions</th>
                    <th>Ingredients</th>
                    <th>Instructions</th>
                    @if(Auth::check())
                        <th>Edit / Delete</th>
                    @endif
                    </thead>

                    <tbody>
                    @foreach ($products as $product)

                        <tr>
                            <td class="table-text">
                                <div><img height="260" width="260" src="{{'/images/'.$product->photo }}" />
                                </div>
                            </td>

                            <td class="table-text">
                                <div>{{ $product->name }}</div>
                                <div>{{ $product->english_name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $catList[$product->category_id]}}</div>
                            </td>

                            <td class="table-text">
                                <div> ￥{{ $product->price }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $product->description }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $product->specification }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $product->precautions }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $product->ingredients }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $product->instructions }}</div>
                            </td>
                            @if(Auth::check())
                                <td class="table-text">
                                    <div class="pull-left"><a href="{{route('editSingleProduct', $product->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
                                    <div class="pull-right"><a href="{{route('editSingleProduct', $product->id)}}"><i class="fa fa-trash-o delete" aria-hidden="true"></i></a></div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $products->links() }}
            </div>
        </div>
    @endif
@endsection
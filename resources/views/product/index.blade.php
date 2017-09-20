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
                                <div class="col-md-3">
                                    Select Sub Category
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
                                <div class="col-md-3">
                                    <button  class="button form-control" >Search</button>
                                </div>
                            </form>

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



                            <td>
                                <!-- TODO: Delete Button -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $products->links() }}
            </div>
        </div>
    @endif
@endsection
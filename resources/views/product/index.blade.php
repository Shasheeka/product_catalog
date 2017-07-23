@extends('layouts.app')

@push('pagetitle')

@section('content')
    <!-- Create Task Form... -->

    <!-- Current Tasks -->
    @if (count($products) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Products
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Product Photo</th>
                    <th>Product Name <br>(Chinese/English) </th>
                    <th>Category</th>
{{--                    <th>Product Price</th>
                    <th>For Ages</th>
                    <th>Product Description</th>
                    <th>Specification</th>
                    <th>Precautions</th>
                    <th>Ingredients</th>
                    <th>Instructions</th>--}}
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div><img height="70" width="70" src="{{  $product->photo_url }}" />
                                </div>
                            </td>

                            <td class="table-text">
                                <div>{{ $product->name }}</div>
                                <div>{{ $product->name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $product->category->name }}</div>
                            </td>
{{--
                            <td class="table-text">
                                <div>{{ $product->price }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $product->ages }}</div>
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
--}}


                            <td>
                                <!-- TODO: Delete Button -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
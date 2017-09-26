<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('product_request.index', ['categories' => $categories]);
    }

    /**
     * Get a validator for an incoming product request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     **/
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'description' => 'required|string',
            'image1' => 'string',
            'image2' => 'string',
            'image3' => 'string',
            'categories' => 'required|numeric|min:1',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'description' => 'required|string',
            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'nullable|required|numeric|',
        ]);


        $data = $request->all();

        $image1 = '';
        $image2 = '';
        $image3 = '';

        $image1 = (isset($data['image1'])) ? $data['image1']->store('images') : '';
        $image2 = (isset($data['image2'])) ? $data['image2']->store('images') : '';
        $image3 = (isset($data['image3'])) ? $data['image3']->store('images') : '';

         ProductRequest::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'description' => $data['description'],
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'category_id' => $data['categories'],
        ]);

        $request->session()->flash('alert-success', 'Product request was successful submitted!');
        return redirect()->route("product-request.create");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

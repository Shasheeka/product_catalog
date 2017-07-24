<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductRequest;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ProductController extends Controller
{
    public function ListProducts()
    {
        $products = Product::orderBy('created_at', 'asc')->get();

        return view('product.index', ['products' => $products]);
    }

    public function upload()
    {
        //echo phpinfo();
        return view('product.upload');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'excelFile' => 'required|mimes:csv,xls,xlsx',
            ]);
            $path = $request->file('excelFile')->store('excel');

            $rowSheet = null;
            Excel::load('storage/app/' . $path, function ($reader) use (&$rowSheet) {
                $rowSheet = $reader->toArray();

                return false;
            });

            $columns = Product::getRequiredColumns();

            $rows = $rowSheet[0];
            foreach ($rows as $key => $row) {
                $cat_id = null;
                $brand_id = null;

                $variable_new = str_replace('￥', '', $row['product_customer_price']);
                $num = (float)preg_replace('/[^\d]/', '', $variable_new);

                $product = Product::where('name', $row['product_name'])->first();

                if ($row['product_name'] && !$product) {

                    if ($row['product_category']) {
                        $category = Category::where('name', $row['product_category'])->first();

                        if (!$category) {
                            $newCat = Category::create([
                                'name' => $row['product_category'],
                            ]);
                            $cat_id = $newCat->id;
                        } else {
                            $cat_id = $category->id;
                        }
                    }
                    if ($row['country_brand']) {
                        $brand = Brand::where('name', $row['country_brand'])->first();

                        if (!$brand) {
                            $newBrand = Brand::create([
                                'name' => $row['country_brand'],
                                'english_name' => $row['brand_english_name'],
                            ]);
                            $brand_id = $newBrand->id;
                        } else {
                            $brand_id = $brand->id;
                        }
                    }

                    Product::create([

                        'photo' => $row['product_photo'],
                        'name' => $row['product_name'],
                        'category_id' => $cat_id,
                        'description' => $row['product_description'],
                        'price' => $num,
                        'brand_id' => $brand_id,
                        'ages' => $row['for_ages'],
                        'specification' => $row['specifications'],
                        'english_name' => $row['product_english_name'],
                        'precautions' => $row['precautions'],
                        'instructions' => $row['instructions'],
                        'ingredients' => $row['ingredients'],
                        'photo_url' => $row['product_photo_url'],
                        'page_url' => $row['pageurl'],
                    ]);

                }
            }

            $request->session()->flash('alert-success', 'Product list  successful uploaded!');
            return view('product.upload');
        } catch (Exception $e){

            $request->session()->flash('alert-danger', 'Error occured while uploading the product list!');
            return view('product.upload');
        }

        //return redirect()->route("products/upload");


    }
}

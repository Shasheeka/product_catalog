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
        $products=[];
        $deletedCat = Category::where('name','=','Delected')->first();
        if($deletedCat){
            $products = Product::where('category_id','!=',$deletedCat->id)
                ->orderBy('created_at', 'asc')->paginate(120);
        }else {
            $products = Product::
                orderBy('created_at', 'asc')->paginate(120);
        }

        return view('product.index', ['products' => $products]);
    }

    public function ListProductsByCat($id)
    {
        $products=[];
        $products = Product::where('category_id', $id)
            ->orderBy('created_at', 'asc')->paginate(120);

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
                $num = 0;

                if(isset($row['product_price']) && $row['product_price'] != ''){
                    $variable_new = str_replace('￥', '', $row['product_price']);
                    $variable_new = str_replace('$', '', $row['product_price']);
                    $num = (float)$variable_new;
                }

                $product = Product::where('name', $row['product_name'])->first();

                if ($row['product_name'] && !$product) {

                    if ($row['category']) {
                        $category = Category::where('name', $row['category'])->first();

                        if (!$category) {
                            $newCat = Category::create([
                                'name' => $row['category'],
                            ]);
                            $cat_id = $newCat->id;
                        } else {
                            $cat_id = $category->id;
                        }
                    }
                    if (isset($row['country_brand'])) {
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
                        'ages' => (isset($row['for_age'])) ? $row['for_age']: '',
                        'specification' => $row['specification'],
                        'english_name' => (isset($row['product_english_name'])) ? $row['product_english_name']: '',
                        'precautions' => $row['precautions_and_warnings'],
                        'instructions' => $row['instructions'],
                        'ingredients' => $row['ingredients'],
                        'photo_url' => $row['product_photo_1'],
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

    public function createSingleProduct(Request $request){


    }
}

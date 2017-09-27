<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\SubCategory;
use App\ProductRequest;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

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
        $search_sub_cat = request()->sub_cat;
        $search_product = request()->product;

        $products      = [];
        $catList["0"] = "All products";
        $category      = Category::find($id);
        $subCategories = SubCategory::where('category_id',$id)->get();
        $subCatIds     = $subCategories->pluck('id')->toArray();

        $catList =  $catList+  $subCategories ->pluck('name', 'id')->toArray();

        if($search_sub_cat == null && $search_product == null){

            $products      = Product::whereIN('category_id', $subCatIds)
                ->orderBy('created_at', 'asc')->paginate(120);
        }else{

            if(isset($search_sub_cat) && $search_sub_cat != '' && $search_product == '') {

                if($search_sub_cat == '0' && $search_product == ''){
                    $products      = Product::whereIN('category_id', $subCatIds)
                        ->orderBy('created_at', 'asc')->paginate(120);

                } else{
                    $products      = Product::where('category_id', (int)$search_sub_cat)
                        ->orderBy('created_at', 'asc')->paginate(120);
                }


            }

            if($search_sub_cat != '' && $search_product != '') {

                if($search_sub_cat == '0'  && $search_product != ''){
                    $products      = Product::whereIN('category_id', $subCatIds)->where('name', 'like', '%' .$search_product . '%')
                        ->orderBy('created_at', 'asc')->paginate(120);

                } else{
                    $products      = Product::where('category_id', (int)$search_sub_cat)->where('name', 'like', '%' .$search_product . '%')
                        ->orderBy('created_at', 'asc')->paginate(120);
                }


            }

        }

        return view('product.index', [  'products' => $products,
                                        'category' => $category,
                                        'catList' => $catList,
                                        'search_sub_cat' => $search_sub_cat,
                                        'search_product' => $search_product,

                                     ]
                );
    }

    public function upload()
    {
        return view('product.upload');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'excelFile' => 'required|mimes:csv,xls,xlsx',
            ]);
            $path = $request->file('excelFile')->store('excel');

            $readerSheet = null;
            Excel::load('storage/app/' . $path, function ($reader) use (&$readerSheet) {


                $readerSheet = $reader->all();

                return false;
            });


            $readerSheet->each(function($sheet) {

                if($sheet->getTitle() != 'All Products' && $sheet->getTitle() != 'Categories' && $sheet->getTitle() != 'OLD') {
                    var_dump($sheet->getTitle());


                  // Loop through all rows
                    $cat_id   = 1;
                    $category = Category::where('name', $sheet->getTitle())->first();

                    if (!$category) {
                        $newCat = Category::create([
                            'name' => $sheet->getTitle(),
                        ]);
                        $cat_id = $newCat->id;
                    } else {
                        $cat_id = $category->id;
                    }
                    $oneSheet = $sheet->toArray();

                    foreach ($oneSheet as $key => $row) {
                        $brand_id = null;
                        $num      = 0;

                        if (isset($row['product_price']) && $row['product_price'] != '') {
                            $variable_new = str_replace('￥', '', $row['product_price']);
                            $variable_new = str_replace('$', '', $row['product_price']);
                            $num          = (float)$variable_new;
                        }

                        $product = Product::where('name', $row['product_name'])->first();

                        if ($row['product_name'] && !$product) {

                            if ($row['category']) {
                                $subCategory = SubCategory::where('name', $row['category'])->first();

                                if (!$subCategory) {
                                    $newSubCat  = SubCategory::create([
                                        'name'        => $row['category'],
                                        'category_id' => $cat_id,
                                    ]);
                                    $sub_cat_id = $newSubCat->id;
                                } else {
                                    $sub_cat_id = $subCategory->id;
                                }
                            }
                            if (isset($row['country_brand'])) {
                                $brand = Brand::where('name', $row['country_brand'])->first();

                                if (!$brand) {
                                    $newBrand = Brand::create([
                                        'name'         => $row['country_brand'],
                                        'english_name' => $row['brand_english_name'],
                                    ]);
                                    $brand_id = $newBrand->id;
                                } else {
                                    $brand_id = $brand->id;
                                }
                            }

                            Product::create([

                                'photo'         => $row['product_photo'],
                                'name'          => $row['product_name'],
                                'category_id'   => $sub_cat_id,
                                'description'   => $row['product_description'],
                                'price'         => $num,
                                'brand_id'      => $brand_id,
                                'ages'          => (isset($row['for_age'])) ? $row['for_age'] : '',
                                'specification' => $row['specification'],
                                'english_name'  => (isset($row['product_english_name'])) ? $row['product_english_name'] : '',
                                'precautions'   => $row['precautions_and_warnings'],
                                'instructions'  => $row['instructions'],
                                'ingredients'   => $row['ingredients'],
                                'photo_url'     => $row['product_photo_1'],
                                'page_url'      => $row['pageurl'],
                            ]);

                        }
                    }




                }
            });

/*            $columns = Product::getRequiredColumns();
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
            }*/

            $request->session()->flash('alert-success', 'Product list  successful uploaded!');
            return view('product.upload');
        } catch (Exception $e){

            $request->session()->flash('alert-danger', 'Error occured while uploading the product list!');
            return view('product.upload');
        }

        //return redirect()->route("products/upload");


    }

    public function createSingleProduct(Request $request){

        $subCategories = SubCategory::get();
        $catList =   $subCategories ->pluck('name', 'id')->toArray();
        return view('product.create' ,['subCat'=>$catList]);
    }

    public function saveProduct(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'nullable|numeric',
        ]);
        $data = $request->all();
        $name = $data['name'];
        $price = $data['price'];
        $description = (isset($data['description'])) ? $data['description'] : '';;
        $category = (isset($data['category'])) ? $data['category'] : '';;
        $specification = (isset($data['specification'])) ? $data['specification'] : '';
        $precautions = (isset($data['precautions'])) ? $data['precautions'] : '';
        $ingredients = (isset($data['ingredients'])) ? $data['ingredients'] : '';
        $instructions = (isset($data['instructions'])) ? $data['instructions'] : '';

        $image = (isset($data['image'])) ? file($data['image']) : '';
        $hashname  = (isset($data['image'])) ? $data['image']->hashName(): '';


        if(isset($data['product_id'])){
            //edit

            $product = Product::find($data['product_id']);


             $product->name = $name;
             $product->price = $price;
             $product->description = $description;
             $product->specification = $specification;
             $product->precautions = $precautions;
             $product->ingredients = $ingredients;
             $product->instructions = $instructions;

            if($hashname != ''){
                Storage::disk('uploads')->put($hashname, $image);
                $product->photo = $hashname;
            }

             $product->category_id = $category;

            $product->save();

            $request->session()->flash('alert-success', 'Product  is successful edited');
            return redirect()->route("editSingleProduct", $product->id);

        } else{
            //new
            if($hashname != ''){
                Storage::disk('uploads')->put($hashname, $image);
            }

            Product::create([
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'specification' => $specification,
                'precautions' => $precautions,
                'ingredients' => $ingredients,
                'instructions' => $instructions,
                'photo' => $hashname,
                'category_id' => $category,


            ]);

            $request->session()->flash('alert-success', 'Product  is successful saved');
            return redirect()->action('ProductController@createSingleProduct');
        }





        //return redirect()->route("products/create");
        //return redirect()->route('products/create');

        //$subCategories = SubCategory::get();
        //$catList =   $subCategories ->pluck('name', 'id')->toArray();
       // return view('product.create' ,['subCat'=>$catList, 'category'=>$category]);
    }

    public function editProduct($id){

        $subCategories = SubCategory::get();
        $catList =   $subCategories ->pluck('name', 'id')->toArray();

        $product = Product::find($id);

        return view('product.edit' ,['subCat'=>$catList, 'product'=>$product]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        if($product){
            $product->delete();
        }
        return redirect()->back();
    }



}

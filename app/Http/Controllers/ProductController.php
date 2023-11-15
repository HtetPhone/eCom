<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10)->withQueryString();

        return view('admin.products.products_list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::latest('id')->get();
        return view('admin.products.add_products', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $formData = $request->validated();
        if($request->hasFile('img')) {
            $image = $request->file('img');  //access the value
            $imageName = time(). '.' . $image->getClientOriginalExtension(); //generate a new name
            $image->move('images', $imageName); //store in public folder
            $formData['img'] = $imageName; //to store in db | assgin value

            /** 
             * here is a shorter way
             * $imagePath = $image->file()->store('images', 'public'); public/images/.. 
             * $formData['image'] = $imagePath
             * Note:: make sure u link storage & public folder as the pics will be saved in the storage
             * run this command 'php artisan storage:link'
             * */

        }

        Product::create($formData);

        //adding categories
        if($request->categories) {
            $categories = [];
            foreach($request->categories as $cat) {
                $categories[] = $cat;
            }

            $product = Product::latest('id')->first();
            $product->categories()->sync($categories);
        }

        return redirect()->route('product.index')->with(['message' => 'Product has been added!!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.product_details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::latest('id')->get();
        return view('admin.products.edit_product', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $formData = $request->validated();
    
        if($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time(). '.' . $image->getClientOriginalExtension();
            $image->move('images', $imageName);

            $formData['img'] = $imageName;
        }

        $product->update($formData);

        //adding categories
        if($request->categories) {
            $categories = [];
            foreach($request->categories as $cat) {
                $categories[] = $cat;
            }

            $product->categories()->sync($categories);
        }

        return back()->with(['message' => 'Product has been updated!!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with(['message' => 'Product is deleted!!']);
    }
}


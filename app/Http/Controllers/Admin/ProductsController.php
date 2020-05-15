<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Catalog;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Product::Where('product_slug', 'LIKE', "%$keyword%")
                ->orWhere('product_name', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('product_views', 'LIKE', "%$keyword%")
                ->orWhere('catalog_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }
     
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $catalogs = Catalog::pluck('catalog_name', 'id');
        return view('admin.products.create', compact('catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
			'product_name' => 'required',
			'content' => 'required',
			'price' => 'required',
			'discount' => 'required',
			
        ]);
        $product = new Product();
        $product->catalog_id = $request->catalog_id;
        $product->product_name = $request->product_name;
        $product->content = $request->content;
        $product->price = $request->price;
        $product->discount = $request->discount;
        
       
        $product->product_temp_slug = Controller::to_slug($request['product_name']);
        $product->save();

        return redirect('admin/products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $catalogs = Catalog::pluck('catalog_name', 'id');

        return view('admin.products.edit', compact('product','catalogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
			'product_name' => 'required',
			'content' => 'required',
			'price' => 'required',
			'discount' => 'required',
			
        ]);
        
        $product = Product::findOrFail($id);
        $product->catalog_id = $request->catalog_id;
        $product->product_name = $request->product_name;
        $product->content = $request->content;
        $product->price = $request->price;
        $product->discount = $request->discount;  
        $product->product_temp_slug = Controller::to_slug($request['product_name']);
        $product->product_slug = null;  
        $product->save();
        

        return redirect('admin/products')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }


    public function display($slug)
    {
        $cates = Category::all()->where('cate_active',true);
        $posts = Post::with('categories')->where('post_slug', $slug)->first();    
        $catepost = Category::with('posts')->where('cate_active',true)->groupBy('id')->take(5)->get(); 
        $posts->increment('post_views');   
        return view('posts.detail', compact('posts', 'cates','catepost'));
    }

    public function postbycate($slug){
        $cates = Category::all()->where('cate_active',true);
        $categories = Category::where('cate_slug','LIKE',$slug)->firstOrFail();
        $posts = Post::with('categories')->where('cateId',$categories->id)->latest()->paginate(5);
        $catepost = Category::with('posts')->where('cate_active',true)->groupBy('id')->take(5)->get();    
        return view('posts.postsbycate', compact('cates', 'posts', 'categories','catepost'));
    }

    function uploadFile($request) {

        try {
            $photo = $request->get('photo');
            if(isset($photo))
            {
                $name = time().'.' . explode('/', explode(':', substr($photo, 0, strpos($photo, ';')))[1])[1];
                \Image::make($request->get('photo'))->save(public_path('Uploads/News/').$name);
            }
            else{
                $name = 'NoImage.png';
            }
            return $name;
        }
        catch (\Exception $ex) {
            return response()->json(['msg' => "Upload failed!"]);
        }
    }
}

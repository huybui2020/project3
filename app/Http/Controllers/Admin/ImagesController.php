<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image;
use App\Product;
use Illuminate\Http\Request;

class ImagesController extends Controller
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
            $images = Image::Where('product_image', 'LIKE', "%$keyword%")
                ->orWhere('product_image_desc', 'LIKE', "%$keyword%")
                ->orwhere('product_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $images = Image::latest()->paginate($perPage);
        }

         return view('admin.images.index', compact('images'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        $productss = Product::pluck('product_name', 'id');
        return view('admin.images.create', compact('productss'));
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
			'product_image_desc' => 'required'
        ]);
        $image = new Image();
        $image->product_id = $request->product_id;
        $image->product_image_desc = $request->product_image_desc;
        if ($request->hasFile('product_image')) {
            $images = $request->file('product_image');
            $name =  str_slug($request->product_image_desc).'.'.$images->getClientOriginalExtension();
            $destinationPath = public_path('/Uploads/Posts');
            $imagePath = $destinationPath. "/".  $name;
            $images->move($destinationPath, $name);
            $image->product_image = $name;
        }    
        $image->save();

        return redirect('admin/images')->with('flash_message', 'Image added!');
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
        $image = Image::findOrFail($id);
        $productss = Product::pluck('product_name', 'id');
        return view('admin.images.show', compact('image','productss'));
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
        $image = Image::findOrFail($id);
        $productss = Product::pluck('product_name', 'id');
        return view('admin.images.edit', compact('image','productss'));
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
			'product_image_desc' => 'required'
        ]);
        
        $image = Image::findOrFail($id);

        $image = new Image();
        $image->product_id = $request->product_id;
        $image->product_image_desc = $request->product_image_desc;   
        if ($request->hasFile('product_image')) {
            $images = $request->file('product_image');
            $name =  str_slug($request->product_image_desc).'.'.$images->getClientOriginalExtension();
            $destinationPath = public_path('/Uploads/Posts');
            $imagePath = $destinationPath. "/".  $name;
            $images->move($destinationPath, $name);

            $image->product_image = $name;
        }    
        $image->save();

        return redirect('admin/images')->with('flash_message', 'Image updated!');
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
        Image::destroy($id);

        return redirect('admin/images')->with('flash_message', 'Image deleted!');
    }
}

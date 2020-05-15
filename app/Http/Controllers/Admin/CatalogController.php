<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Catalog;
use App\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
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
            $catalog = Catalog::where('catalog_slug', 'LIKE', "%$keyword%")
                ->orWhere('catalog_name', 'LIKE', "%$keyword%")
                ->orWhere('catalog_active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $catalog = Catalog::latest()->paginate($perPage);
        }

        return view('admin.catalog.index', compact('catalog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.catalog.create');
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
			'catalog_name' => 'required'
		]);
        $requestData = $request->all();
        
        Catalog::create($requestData);

        return redirect('admin/catalog')->with('flash_message', 'Catalog added!');
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
        $catalog = Catalog::findOrFail($id);

        return view('admin.catalog.show', compact('catalog'));
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
        $catalog = Catalog::findOrFail($id);

        return view('admin.catalog.edit', compact('catalog'));
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
			'catalog_name' => 'required'
		]);
        $requestData = $request->all();
        
        $catalog = Catalog::findOrFail($id);
        $catalog->catalog_slug = null;
        $catalog->update($requestData);

        return redirect('admin/catalog')->with('flash_message', 'Catalog updated!');
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
        Catalog::destroy($id);

        return redirect('admin/catalog')->with('flash_message', 'Catalog deleted!');
    }

    public function isActive($id)
    {
        $cata = Catalog::findOrFail($id);
        
        $cata->catalog_active = $cata->catalog_active== true ? false : true;
        
        $cata->save();

        return redirect()->back()->with('success','sucess');
    }
}

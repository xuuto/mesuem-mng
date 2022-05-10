<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends BaseController
{

    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        $this->setPageTitle('Galleries Management', 'list Gallery');
        return view('admin.gallery.index', compact('galleries'));
    }


    public function create()
    {
        $cities = City::all();
        $this->setPageTitle('Gallery', 'New Gallery');
        return view('admin.gallery.create', compact('cities'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //        dd($request->all());
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city_id' => 'required|integer',
        ]);

        //create new gallery instance
        //        dd($request);
        $gallery = new Gallery();
        $gallery->name = $request->name;
        $gallery->address = $request->address;
        $gallery->city_id = $request->city_id;
        $gallery->user_id =  Auth::user()->id;
        $gallery->save();
        //        dd($gallery);
        if (!$gallery) {
            return $this->responseRedirectBack('Error occured while creating Gallery', 'error');
        }
        return $this->responseRedirect('galleries.index', 'Gallery created successfully', 'success');
    }


    public function show(Gallery $gallery)
    {
        $gallery = Gallery::with('Images', 'City')->findOrFail($gallery->id);
//        dd($gallery->images);
        return view('admin.gallery.show', compact('gallery'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery  $gallery
     * @return Application|Factory|View
     */
    public function edit(Gallery $gallery)
    {
        $this->setPageTitle('Edit Gallery', 'Edit Gallery');
        $cities = City::all();
        $city = $gallery->city;
        $city_id = $city ? $city->id : 0;
        return view('admin.gallery.edit', compact('cities', 'city_id', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Gallery  $gallery
     * @return RedirectResponse
     */
    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city_id' => 'required|integer',
        ]);

        $gallery = Gallery::findOrFail($gallery->id);
        $gallery->name = $request->name;
        $gallery->address = $request->address;
        $gallery->city_id = $request->city_id;
        $gallery->save();
        if (!$gallery) {
            return $this->responseRedirectBack('Error Occured while updating Gallery', 'error');
        }
        return $this->responseRedirect('galleries.index', 'Gallery Updated successfully', 'success');
    }



    public function destroy(Request $request, $id)
    {

        if ($request->ajax()) {
            $gallery = Gallery::findOrFail($id);
            if ($gallery) {
                $gallery->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}

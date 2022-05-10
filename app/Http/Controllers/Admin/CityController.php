<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class CityController extends BaseController
{
    public function index()
    {
        $cities = City::orderBy('created_at', 'desc')->get();
        return view('admin.city.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.city.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->save();
        if (!$city) {
            return $this->responseRedirectBack('Error occured while creating City.', 'error');
        }
        return $this->responseRedirect('cities.index', 'City added successfully', 'success');
    }

    public function edit(City $city)
    {
        return view('admin.city.edit', compact('city'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
           'name' => ['string', 'required']
        ]);

        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->save();
        if (!$city) {
            return $this->responseRedirectBack('Error Occured while updating City.', 'error');
        }
        return $this->responseRedirect('cities.index', 'City Updated successfully', 'success');
    }

    public function destroy(City $city)
    {
        $city = City::find($city->id);
        if (!$city) {
            return $this->responseRedirectBack('Error occured while creating City.', 'error');
        }
        $city->delete();
        return $this->responseRedirect('cities.index', 'City deleted successfully', 'success');

    }
}

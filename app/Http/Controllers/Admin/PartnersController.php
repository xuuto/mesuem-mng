<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PartnersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
	    $this->setPageTitle('All Partners', 'Partner Management');
	    $partners = Partner::orderBy('created_at', 'desc')->get();
	    return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->setPageTitle('Partners', 'Create New Partner');
        return \view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
        	'name' => 'required',
        ]);

        $partner = new Partner();
        $partner->name = $request->name;
        $partner->save();
	    if (!$partner) {
		    return $this->responseRedirectBack('Error occured while creating Partner.', 'error');
	    }
	    return $this->responseRedirect('partners.index', 'partner added successfully', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Partner  $partner
	 * @return Application|Factory|View
	 */
    public function edit(Partner $partner)
    {
	    $this->setPageTitle('Edit Partner', 'Parent Management');
	    return \view('admin.partners.edit', compact('partner'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  Partner  $partner
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Partner $partner)
    {
	    $request->validate([
		    'name' => 'required'
	    ]);

	    $partner = Partner::findOrFail($partner->id);
	    $partner->name= $request->name;
	    $partner->save();
	    if (!$partner) {
		    return $this->responseRedirectBack('Error Occured while updating partner', 'error');
	    }
	    return $this->responseRedirect('partners.index', 'partner Updated successfully', 'success');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function destroy(Request $request, $id)
    {
    	if ($request->ajax()) {
    		$partner = Partner::findOrFail($id);
    		if ($partner) {
    			$partner->delete();
    			return \response()->json(array('success' => true));
		    }
	    }
    }
}

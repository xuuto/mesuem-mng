<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\partner_role;
use App\Models\Role;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerRoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
	    $partnerRoles = partner_role::orderBy('created_at', 'desc')->get();
	    $this->setPageTitle('Partner-Role Management', 'list Partner-Role');
	    return view('admin.PartnerRole.index', compact('partnerRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
	    $galleries = Gallery::all();
	    $partners = Partner::all();
	    $roles = Role::where('is_partner_role', 1)->get();
	    $this->setPageTitle('Partner-Role', 'New Partner-Role');
        return \view('admin.PartnerRole.create', compact('galleries','partners', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
	    $request->validate([
		    'gallery_id' => 'required|integer',
		    'partner_id' => 'required|integer',
		    'role_id' => 'required|integer',
		    'role_start' => 'required|date|date_format:d-m-Y',
            'role_end' => 'nullable|Date|date_format:d-m-Y|after:role_start',
	    ]);

	    $partnerRole = new partner_role();
	    $partnerRole->gallery_id = $request->gallery_id;
	    $partnerRole->partner_id  = $request->partner_id;
	    $partnerRole->role_id =  $request->role_id;
        $partnerRole->role_start = $request->role_start;
	    $partnerRole->role_end   = $request->role_end;
	    $partnerRole->save();
	    if (!$partnerRole) {
		    return $this->responseRedirectBack('Error occured while updating partner-Role', 'error');
	    }
	    return $this->responseRedirect('partner-roles.index', 'Partner-Role created successfully', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param partner_role $partner_role
     * @return Application|Factory|View
     */
    public function edit(Request $request, partner_role $partner_role)
    {
        $this->setPageTitle('Edit Partner-Role', 'Edit Partner Role');
        $galleries = Gallery::all();
        $gallery = $partner_role->gallery;
        $gallery_id = $gallery ? $gallery->id : 0;
        $partners = Partner::all();
        $partner = $partner_role->partner;
        $partner_id = $partner ? $partner->id : 0;
        $roles = Role::where('is_partner_role', 1)->get();
        $role = $partner_role->role;
        $role_id = $role ? $role->id : 0;
        return \view('admin.PartnerRole.edit', compact('galleries', 'partners', 'roles', 'gallery_id', 'role_id', 'partner_role', 'partner_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param partner_role $partner_role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, partner_role $partner_role)
    {
        $request->validate([
            'gallery_id' => 'required|integer',
            'partner_id' => 'required|integer',
            'role_id' => 'required|integer',
            'role_start' => 'required|date|date_format:d-m-Y',
            'role_end'  => 'nullable|date|date_format:d-m-Y'
        ]);

        $partner_role = partner_role::findOrFail($partner_role->id);
        $partner_role->gallery_id = $request->gallery_id;
        $partner_role->partner_id = $request->partner_id;
		$partner_role->role_id = $request->role_id;
        $partner_role->role_start = $request->role_start;
		$partner_role->role_end =  $request->role_end;
		$partner_role->save();
		if (!$partner_role) {
            return $this->responseRedirectBack('Error occured while updating PartnerRole', 'error');
        }
		return $this->responseRedirect('partner-roles.index', 'Partner Role updated successfully', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $partnerRole = partner_role::findOrFail($id);
            if ($partnerRole) {
                $partnerRole->delete();
                return response()->json(array('success' => true));
            }
        }

    }
}

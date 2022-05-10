<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Role;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();
        $this->setPageTitle('Roles list', 'Roles Management');
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        // $staffs = Staff::latest()->get();
        // $galleries = Gallery::latest()->get();
        $this->setPageTitle('Roles', 'New Role');
        return \view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'role_name' => 'required',
            'staff-role' => 'in:1,0',
            'partner_role' => 'in:1,0'
        ]);

        $role = new Role();
        $role->role_name = $request->role_name;
        $role->is_staff_role = $request->has('staff-role');
        $role->is_partner_role = $request->has('partner-role');
        //        if ($request->has('staff-role')) {
        //            $role->is_staff_role = 1;
        //        }
        //        if ($request->has('partner_role')) {
        //            $role->is_partner_role = 1;
        //        }
        $role->save();
        // $role->staffs()->attach($request->role_name, ['gallery_id' => $request->gallery_id, 'role_start' => Carbon::now(), 'role_end' => Carbon::now()]);
        if (!$role) {
            return $this->responseRedirectBack('Error occured while creating role', 'error');
        }
        return $this->responseRedirect('roles.index', 'Role created successfully', 'success');
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
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->setPageTitle('Edit Roles', 'Edit Role');
        return \view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required',
            'staff-role' => 'in:1,0',
            'partner_role' => 'in:1,0'
        ]);

        $role = Role::findOrFail($id);
        $role->role_name = $request->role_name;
        $role->is_staff_role = $request->has('staff-role');
        $role->is_partner_role = $request->has('partner-role');
        $role->save();
        if (!$role) {
            return $this->responseRedirectBack('Error occurred while updated role', 'error');
        }
        return $this->responseRedirect('roles.index', 'Role updated successfully', 'success');
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
            $role = Role::findOrFail($id);
            if ($role) {
                $role->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}

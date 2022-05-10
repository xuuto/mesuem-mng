<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffRole;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffRoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $staffRoles = StaffRole::orderBy('created_at', 'desc')->get();
        $this->setPageTitle('Staff-Role Management', 'list Staff-Role');
        return view('admin.staffrole.index', compact('staffRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $galleries = Gallery::all();
        $staffs = Staff::all();
        $roles = Role::where('is_staff_role', 1)->get();
        $this->setPageTitle('Staff-Role', 'New Staff-Role');
        return \view('admin.staffrole.create', compact('staffs', 'roles', 'galleries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'gallery_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'role_id' => 'required|integer',
             'role_start' => 'required|Date|date_format:d-m-Y',
            'role_end' =>    'nullable|Date|date_format:d-m-Y|after:role_start',
        ]);

        $staffRole = new StaffRole();
        $staffRole->gallery_id = $request->gallery_id;
        $staffRole->staff_id = $request->staff_id;
        $staffRole->role_id = $request->role_id;
        $staffRole->role_start = $request->role_start;
        $staffRole->role_end = $request->role_end;
        $staffRole->save();
        if (!$staffRole) {
            return $this->responseRedirectBack('Error occured while updating staff-Role', 'error');
        }
        return $this->responseRedirect('staff-roles.index', 'Staff-Role created successfully', 'success');
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
     * @param  Request  $request
     * @param  StaffRole  $staffRole
     * @return Application|Factory|View
     */
    public function edit(Request $request, StaffRole $staffRole)
    {
        $this->setPageTitle('Edit Staff-Role', 'Edit Staff-Role');
        $galleries = Gallery::all();
        $gallery = $staffRole->gallery;
        $gallery_id = $gallery ? $gallery->id : 0;
        $staffs = Staff::all();
        $staff = $staffRole->staff;
        $staff_id = $staff ? $staff->id : 0;
        $roles = Role::where('is_staff_role', 1)->get();
        $role = $staffRole->role;
        $role_id = $role ? $role->id : 0;
        return \view(
            'admin.staffrole.edit',
            compact('galleries', 'staffs', 'roles', 'staffRole', 'staff_id', 'gallery_id', 'role_id')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  StaffRole  $staffRole
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, StaffRole $staffRole)
    {
        $request->validate([
            'gallery_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'role_id' => 'required|integer',
            'role_start' => 'required|Date|date_format:d-m-Y',
            'role_end'  => 'nullable|Date|date_format:d-m-Y|after:role_start'
        ]);

        $staffRole = StaffRole::findOrFail($staffRole->id);
        $staffRole->gallery_id = $request->gallery_id;
        $staffRole->staff_id = $request->staff_id;
        $staffRole->role_id = $request->role_id;
        $staffRole->role_start = $request->role_start;
        $staffRole->role_end = $request->role_end;
        $staffRole->save();
        if (!$staffRole) {
            return $this->responseRedirectBack('Error occured while updating staffRole', 'error');
        }
        return $this->responseRedirect('staff-roles.index', 'Staff-Role updated successfully', 'success');
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
            $staffRole = StaffRole::findOrFail($id);
            if ($staffRole) {
                $staffRole->delete();
                return \response()->json(['success' => true]);
            }
        }
    }
}

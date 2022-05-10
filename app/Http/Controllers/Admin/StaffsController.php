<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Role;
use App\Models\Staff;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffsController extends BaseController
{

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $this->setPageTitle('All staffs', 'Staff Management');
        $staffs = Staff::orderBy('created_at', 'desc')->get();
        return view('admin.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $roles = Role::where('is_staff_role', 1)->get();
        $galleries = Gallery::latest()->get();
        $this->setPageTitle('Staffs', 'Create New Staff');
        return \view('admin.staff.create', compact('roles', 'galleries'));
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
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $staff = new Staff();
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->save();
        //         $staff->roles()->attach($request->role_name, ['gallery_id' => $request->gallery_id, 'role_start' => Carbon::now(), 'role_end' => Carbon::now()]);
        // //        dd($staff);
        if (!$staff) {
            return $this->responseRedirectBack('Error occured while creating staff.', 'error');
        }
        return $this->responseRedirect('staffs.index', 'staff added successfully', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return Response()->json($staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Staff  $staff
     * @return Application|Factory|View
     */
    public function edit(Staff $staff)
    {
        $currentRoles = [];
        $roles = Role::where('is_staff_role', 1)->get();
        foreach ($staff->roles as $role) {
            $currentRoles[] = $role->id;
        }

        $currentGallery = [];

        foreach ($staff->roles as $gallery) {
            $currentGallery[] = $gallery->pivot->gallery_id;
        }

        $galleries = Gallery::all();

        $this->setPageTitle('Edit Staff', 'Staff Management');
        return \view('admin.staff.edit', compact('staff', 'currentRoles', 'roles', 'currentGallery', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Staff  $staff
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $staff = Staff::findOrFail($staff->id);
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->save();
        if (!$staff) {
            return $this->responseRedirectBack('Error Occured while updating Staff', 'error');
        }
        return $this->responseRedirect('staffs.index', 'Staff Updated successfully', 'success');
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
            $staff = Staff::findOrFail($id);
            if ($staff) {
                $staff->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}

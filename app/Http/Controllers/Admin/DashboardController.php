<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Hall;
use App\Models\Partner;
use App\Models\Staff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	$galleries = Gallery::orderBy('id', 'desc')->get();
    	$halls = Hall::all();
    	$countHalls = $halls->count();
    	$countGallery = $galleries->count();
    	$staffs = Staff::all();
    	$countStaffs = $staffs->count();
    	$partners = Partner::all();
    	$partnerCount = $partners->count();
        return view('admin.dashboard.index', compact('countGallery', 'countHalls', 'countStaffs', 'partnerCount'));
    }
}

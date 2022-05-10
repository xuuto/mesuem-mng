<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Hall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Toaster;
use Yajra\DataTables\DataTables;

class HallsController extends BaseController
{

    public function index(Request $request)
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();

//        $hall = [];
//
//        foreach($galleries as  $gallery) {
//            $hall = $gallery->halls();
//    };
        if ($request->ajax()) {
            $data = Hall::with('gallery')->latest()->get();
//            dd($data);
            return DataTables::of($data)
                ->addColumn('gallery', function (Hall $hall) {
                    return $hall->gallery->name;
                })
                ->addColumn('action', function ($data) {
                    return '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#" id="editHall" data-id="' . $data->id . '">Edit</button>
                            <button type="button" data-id="' . $data->id . '" data-toggle="modal" data-target="#" class="btn btn-danger btn-sm" data-id="' . $data->id . '" id="getDeleteId">Delete</button>';
                })
                ->editColumn('created_at', function ($data) {
                    $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-y');
                    return $formatDate;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return \view('admin.halls.index', compact('galleries'));
    }


    /**
     * @return void
     */
    public function create()
    {
//        $galleries = Gallery::all();
//        return view('admin.halls.index', compact('galleries'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'gallery_id' => 'required',
        ]);


        Hall::updateOrCreate([
            'id' => $request->hall_id
        ], [
            'name' => $request->name,
            'gallery_id' => $request->gallery_id
        ]);
//        Toaster::success('Data was added successfully :)', 'Success');
        return Response()->json(['success' => 'Hall saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id): Response
    {
        //
    }


    public function edit(Request $request, $id)
    {
        $this->setPageTitle('Hall Management', 'Edit Hall');
        if ($request->ajax()) {
            $hall = Hall::findOrFail($id);
            return response()->json($hall);
        }
        return view('admin.halls.index', compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $hall = Hall::findOrFail($id);
            if ($hall) {
                $hall->delete();
                return response()->json(array('success' => true));
            }
        }
    }
}

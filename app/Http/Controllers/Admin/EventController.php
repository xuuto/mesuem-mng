<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $events = Event::latest()->get();
        $galleries = Gallery::all();
        return view('admin.events.index', compact('events', 'galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $galleries = Gallery::all();
        return \view('admin.events.create', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->gallery_id = $request->input('gallery_id');
//        dd($event);
        $event->save();
        if (!$event) {

            return $this->responseRedirectBack('Error occured while creating Event.', 'error');
        }
        return $this->responseRedirect('events.index', 'Event added successfully', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Application|Factory|View
     */
    public function edit(Event $event)
    {
        $galleries = Gallery::all();
        $gallery = $event->gallery;
        $gallery_id = $gallery ? $gallery->id : 0;
        return \view('admin.events.edit', compact('event', 'galleries', 'gallery_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $request
     * @param Event $event
     * @return RedirectResponse
     */
    public function update(EventRequest $request, Event $event)
    {
        $event = Event::findOrFail($event->id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->gallery_id = $request->gallery_id;
        $event->save();
        if (!$event) {
            return $this->responseRedirectBack('Error occured while creating Event.', 'error');
        }
        return $this->responseRedirect('events.index', 'Event added successfully', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request,$id)
    {
        if ($request->ajax()) {
            $event = Event::findOrFail($id);
            if ($event) {
                $event->delete();
                return \response()->json(array(['success' => true]));
            }
        }
    }
}

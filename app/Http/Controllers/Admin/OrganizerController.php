<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use Inertia\Inertia; // This line is already present and correct.

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizers = Organizer::with('user')->latest('updated_at')->get();
        // return dd($organizers);
        return Inertia::render('Admin/organizers/Index', ['organizers' => $organizers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizer $organizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizer $organizer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizerRequest $request, Organizer $organizer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer)
    {
        $organizer->delete();
        session()->flash('success', 'Organizer deleted successfully.');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        $organizers = Organizer::with('user')->onlyTrashed()->latest('updated_at')->get();

        return Inertia::render('Admin/organizers/Trashed', ['organizers' => $organizers]);
    }
    /**
     * Restore the specified resource.
     */
    public function restore(Organizer $organizer)
    {
        $organizer->restore();
        session()->flash('success', 'Organizer restored successfully.');
    }
    /**
     * Delete the specified resource.
     */
    public function delete(Organizer $organizer)
    {
        $organizer->forceDelete();

        session()->flash('success', 'Organizer deleted permanently.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EventImage;
use App\Http\Requests\StoreEventImageRequest;
use App\Http\Requests\UpdateEventImageRequest;
use Illuminate\Support\Facades\Storage;

class EventImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreEventImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventImage $eventImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventImage $eventImage)
    {
        return Inertia('event_images/Edit', ['eventImage' => $eventImage]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventImageRequest $request, EventImage $eventImage)
    {
        if ($request->hasFile('image')) {
            if ($eventImage->url) {
                Storage::disk('public')->delete($eventImage->url);
            }

            $imagePath = $request->file('image')->store('event_images', 'public');
            $eventImage->update([
                'url' => $imagePath,
            ]);
        }

        session()->flash('success', 'EventImage updated successfully.');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventImage $eventImage)
    {
        //
    }
}

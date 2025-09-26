<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\EventImage;
use App\Models\Organizer;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('eventImages')->latest('updated_at')->get();
        //  echo $events->eventImages()->get()->first()->url;
        //    die;
        return Inertia('events/Index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('events/Create');
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'organizer_id' => Auth::user()->organizer->id,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
            EventImage::create([
                'event_id' => $event->id,
                'url' => $imagePath,
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event->load('eventImages');

        return Inertia('events/Edit', [
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'location' => $event->location,
                'start_date' => $event->start_date->format('Y-m-d'),
                'end_date' => $event->end_date->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->load('eventImages');
        return dd($request->file('image'));
        die();
        $event->update($request->validated());
        if ($request->hasFile('image')) {
            // Delete old image if exists
            return dd($event->eventImages()->get());
            die();
            if ($event->eventImages()->exists()) {
                Storage::disk('public')->delete($event->eventImages->first()->url);
                $event->eventImages()->delete();
            }

            $imagePath = $request->file('image')->store('event_images', 'public');
            EventImage::create([
                'event_id' => $event->id,
                'url' => $imagePath,
            ]);
        }

        session()->flash('success', 'Event updated successfully.');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}

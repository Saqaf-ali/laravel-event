<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @route '/users'
     */
    public function index()
    {
        $users = User::latest('updated_at')->get();
        return Inertia::render('Admin/users/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return dd('saqaf');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        echo 'fff';
        return dd($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User deleted successfully.');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->latest('updated_at')->get();
        return Inertia::render('Admin/users/Trashed', ['users' => $users]);
    }
    /**
     * Restore the specified resource.
     */
    public function restore(User $user)
    {
        $user->restore();
        session()->flash('success', 'User restored successfully.');
    }
    /**
     * Delete the specified resource.
     */
    public function delete(User $user)
    {
        //  return dd('saqaf'. $user);
        $user->forceDelete();

        session()->flash('success', 'User deleted permanently.');
    }
}

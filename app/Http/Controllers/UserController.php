<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequests;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $user = User::paginate(10);
        $user = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.users.index', [
            'type_menu' => '',
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create', [
            'type_menu' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $validatedData = $request->all();

        $validatedData['password'] = Hash::make($request['password']);

        $user = User::create($validatedData);
        if ($user) {
            return redirect()->route('user.index')->with('success', 'User Successfully Created');
        } else {
            return back()->withInput()->with('error', 'Some problem occurred, please try again');
        }
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', [
            'type_menu' => '',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequests $request, User $user)
    {
        $validatedData = $request->validated(); // Menggunakan validated() untuk mendapatkan data yang sudah divalidasi

        $user->update($validatedData);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User Successfully Updated');
        } else {
            return back()->withInput()->with('error', 'Some problem occurred, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('user.index')->with('success', 'User Successfully Deleted');
        } else {
            return back()->withInput()->with('error', 'Some problem occurred, please try again');
        }
    }
}


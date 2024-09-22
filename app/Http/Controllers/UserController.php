<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user beserta role mereka
        // $users = User::with('roles')->get();
        $users = User::all();
        // dd($users);
        $menuActive = 'active';

        return view('pages.user.userIndex', compact('menuActive', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuActive = 'active';

        return view('pages.user.userCreate', compact('menuActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|string|max:100|email|unique:users,email,',
                'username' => 'required|string|max:100|unique:users,username,',
                'password' => 'required|min:6|confirmed',
            ]);
            //  insert to database
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            // Assign role ke user
            if ($request->roles) {
                $user->syncRoles($request->roles);
            }

            return redirect()->back()->with([
                'success' => 'User berhasil ditambahkan',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'failed' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = User::find($id);
        $menuActive = 'active';

        return view('pages.user.userEdit', compact('menuActive', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'username' => 'required',
                // 'password' => 'required|min:6|confirmed',
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            // update user
            $user->update();

            if ($request->roles) {
                $user->syncRoles($request->roles);
            }

            return redirect()->route('user.index')->with(['success' => 'User berhasil diperbarui']);
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $user = User::find($id);

            // delete user from db
            if ($user) {
                $user->delete();

                return redirect()->back()->with(['success' => 'User berhasil dihapus']);
            } else {
                return redirect()->back()->with(['failed' => 'User not found']);
            }
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with(['failed' => $e->getMessage()]);
        }
    }

    public function getRoles(Request $request)
    {
        $data = Role::where('name', 'like', '%'.$request->searchItem.'%'); // Ambil semua role

        return $data->paginate(10, ['*'], 'page', $request->page);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NormalAdmin;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class NormalAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the normal admin
        $normal_admins = User::where('is_admin', '2')->get();
        return view('admin.normal_admin.index', compact('normal_admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.normal_admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        //update user table
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->uuid = Str::uuid();
        $user->is_admin = '2';
        $user->password = Hash::make($request->password);
        if ($request->hasFile('photo')) {
            $file = $request->photo;
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/img/users';
            $file->move($path, $fileName);
            $user->photo = $fileName;
        }

        $user->save();

        //create user_infos table
        UserInfo::create([
            'user_id' => $user->id
        ]);

        return back()->with('success', 'new admin has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NormalAdmin  $normalAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(NormalAdmin $normalAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NormalAdmin  $normalAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $normal_admin = User::where('uuid', $uuid)->first();
        return view('admin.normal_admin.edit', compact('normal_admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NormalAdmin  $normalAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NormalAdmin $normalAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NormalAdmin  $normalAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {

        try {

            $normal_admin = User::where('uuid', $uuid)->first();

            $deletd = $normal_admin->delete();

            if ($deletd) {
                return redirect('admin/normal_admin')->with('success', 'admin has been deleted successfully');
            }
        } catch (\Throwable $th) {

            return redirect('admin/normal_admin')->with('error', $th->getMessage());
        }
    }
}

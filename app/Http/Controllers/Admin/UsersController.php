<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * returns paginated list of users(without admin users)
     */
    public function paginatedList()
    {
        $per_page = request()->filled('per_page') ? request()->per_page : 10;
        $search = request()->filled('search') ? request()->search : '';

        $users = User::with('userinfo')->where('name', 'like', '%' . $search . '%')
            ->where('is_admin', '0')
            ->paginate($per_page);

        return new UsersCollection($users);
    }

    /**
     * returns view of edit user page
     */
    public function edit(User $user)
    {
        $user = new UserResource($user->load('userinfo'));

        return view('admin.users.edit', compact('user'));
    }


    /**
     * 
     *  update user information 
     * 
     */

    public function update(Request $request)
    {
        //update user table
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/img/users';
            $file->move($path, $fileName);
            $user->photo = $fileName;
        }

        $user->save();
        //update user_infos table
        $userInfos = UserInfo::find($request->id);

        $userInfos->first_name = $request->first_name;
        $userInfos->last_name = $request->last_name;
        $userInfos->phone = $request->phone;
        $userInfos->address = $request->address;

        $userInfos->save();
        return response($user, 200);
    }

    /**
     * toggles user status(suspended/active)
     */
    public function toggleStatus(User $user)
    {
        try {
            if ($user->is_suspended == 'yes') {
                $user->is_suspended = 'no';
            } else {
                $user->is_suspended = 'yes';
            }
            $user->save();
            return response()->json([
                'message' => 'Status updated successfully',
                'status' => $user->is_suspended,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong',
                'status' => $user->is_suspended,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}

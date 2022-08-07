<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteIdentityUpdateRequest;
use App\Models\WebsiteIdentity;

class WebsiteIdentityController extends Controller
{
    public function index()
    {
        $identity = WebsiteIdentity::first();

        return view('admin.website_identity.index', compact('identity'));
    }

    public function update(WebsiteIdentityUpdateRequest $request)
    {
        try {
            $request->update();

            return redirect()->back()->with('success', 'Website Identity Updated Successfully');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

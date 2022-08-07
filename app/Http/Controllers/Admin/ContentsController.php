<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentsCreateRequest;

class ContentsController extends Controller
{
    public function store(ContentsCreateRequest $request)
    {
        try {
            $request->save();

            if (request()->response_type == 'html') {
                return back()->with('success', "Content updated successfully.");
            }
            return response()->json([
                'message' => "Content updated successfully",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}

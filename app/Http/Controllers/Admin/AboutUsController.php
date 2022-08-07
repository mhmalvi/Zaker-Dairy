<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;

class AboutUsController extends Controller
{
    public function index()
    {
        $content = Content::where('key', 'about_us')->first();
        return view('admin.about_us.index', compact('content'));
    }
}

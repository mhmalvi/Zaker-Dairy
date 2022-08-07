<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\WebsiteIdentity;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $identities = WebsiteIdentity::first();
        $content = Content::where('key', 'terms_conditions')->first();
        return view('admin.terms_conditions.index', compact('content','identities'));
    }
}

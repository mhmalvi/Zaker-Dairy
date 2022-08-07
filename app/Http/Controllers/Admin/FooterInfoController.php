<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use Illuminate\Http\Request;

class FooterInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footer = FooterInfo::all();
        return view('admin.footer.index', compact('footer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.footer.create');
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
            'logo' => 'required|mimes:png,jpeg|image',
            'address' => 'required',
        ]);

        if ($request->file('logo')) {

            $image = $request->logo;
            $imageNewName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/admin/img/footer-logo';
            $image->move($path, $imageNewName);
        }

        $store = FooterInfo::create([

            'logo' => $imageNewName,
            'address' => $request->address,
        ]);

        if ($store) {
            return redirect()->route('admin.footer.info')->with('success', 'Footer logo has been created Sucessfully...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AreaAction  $areaAction
     * @return \Illuminate\Http\Response
     */
    public function show(AreaAction $areaAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaAction  $areaAction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $footer = FooterInfo::find($id);
        return view('admin.footer.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AreaAction  $areaAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $footer = FooterInfo::find($request->id);

        $footer->address = $request->address;
        if ($request->file('logo')) {
            $image = $request->logo;
            $imageNewName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'assets/admin/img/footer-logo';
            $image->move($path, $imageNewName);

            $footer->logo = $imageNewName;
        }

        $updated = $footer->save();

        if ($updated) {
            return redirect()->route('admin.footer.info')->with('success', 'Footer Info have been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaAction  $areaAction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $footer = FooterInfo::find($id);
        $deleted = $footer->delete();

        if ($deleted) {
            return redirect()->route('admin.footer.info')->with('success', 'Footer Info have been deleted successfully');
        }
    }
}

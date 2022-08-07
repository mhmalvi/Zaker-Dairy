<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Background;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backgrounds = Background::all();
        return view('admin.shop-background.index', compact('backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return  view('admin.shop-background.create');
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
            'background_type' => 'required',
            'background' => 'required|mimes:png,jpeg|image',
            'background_title' => 'required',
            'background_alt' => 'required',

        ]);
        
        $background_type = $request->background_type;
        $background = $request->background;
        $background_title = $request->background_title;
        $background_alt = $request->background_alt;
        
        //check is background image already exist
        $back_exist = Background::where('background_type', $background_type)->first();
        
        
        if($back_exist){
            return back()->with('warning', 'Background image already created, you can update. ');
        }else{
            
             if ($request->file('background')) {

            $image = $request->background;
            $imageNewName = time() . '.' . $image->getClientOriginalExtension();
            $path = ('assets/admin/img/background-image');
            $image->move($path, $imageNewName);
        }

        $store = Background::create([
            'background_type' =>  $background_type,
            'background' => $imageNewName,
            'background_title' => $background_title,
            'background_alt' => $background_alt

        ]);

        if ($store) {
            return back()->with('success', ' Background Image created Sucessfully...');
        }
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function show(Background $background)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Background $background)
    {

        $background = Background::find($id);
        return view('admin.shop-background.edit', compact('background'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Background $background)
    {
        
        $request->validate([
            'background_title' => 'required',
            'background_alt' => 'required',

        ]);

        $background = Background::find($request->id);

        $background->background_title = $request->background_title;
        $background->background_alt = $request->background_alt;

        if ($request->file('background')) {

            $image = $request->background;
            $imageNewName = time() . '.' . $image->getClientOriginalExtension();
            $path = ('assets/admin/img/background-image');
            $image->move($path, $imageNewName);
            $background->background = $imageNewName;
        }

        $updated = $background->save();
        if ($updated) {
            return redirect()->route('admin.backgrounds')->with('success', 'Shop Background Image updated Sucessfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Background  $background
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Background $background)
    {
        $background = Background::find($id);

        $deleted = $background->delete();

        if ($deleted) {

            return redirect()->route('admin.backgrounds')->with('success', 'Shop Background Image deleted Sucessfully...');
        }
    }
}

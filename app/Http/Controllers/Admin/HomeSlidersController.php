<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSlidersController extends Controller
{
    public function index()
    {
        $homeSliders = HomeSlider::all();
        return view('admin.home_sliders.index', compact('homeSliders'));
    }

    public function getAll()
    {
        try {
            return new HomeSlidersCollection(HomeSlider::all());
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function create()
    {
        return view('admin.home_sliders.create');
    }

    public function store(Request $request)
    {
        
       //validate the input 
        $request->validate([
           
           'title' => 'required',
           'subtitle' => 'required',
           'button_text' => 'required',
           'button_link' => 'required',
           'photo' => 'required|image|mimes:jpg,png,jpeg|dimensions:min_width=1200,min_height=500'
            
        ]);
        
        
        try{
            
            $homeSlider = new HomeSlider();
            
            if($request->file('photo')){
                
                $photo = $request->photo;
                $filename = time().'.'.$photo->getClientOriginalExtension();
                $path = 'assets/img/homeSlider';
                $photo->move($path, $filename);
                $homeSlider->image = $filename;
            }
            
            $homeSlider->title = $request->title;
            $homeSlider->subtitle = $request->subtitle;
            $homeSlider->button_text = $request->button_text;
            $homeSlider->button_link = $request->button_link;
            
            $stored = $homeSlider->save();
            
            if($stored){
                return back()->with('success','Home Slider created successfully');
                
            }
            
        }catch(\Throwable $th){
            
            return back()->with('error', $th->getMessage());
            
        }
            
            
            
          
        
    }

    public function edit($id)
    {
        $homeSlider = HomeSlider::find($id);
        return view('admin.home_sliders.edit', compact('homeSlider'));
    }

    public function update(Request $request)
    {
        
       //validate the input 
        $request->validate([
           'title' => 'required',
           'subtitle' => 'required',
           'button_text' => 'required',
           'button_link' => 'required',
          
            
        ]);
        
        if($request->file('photo')){
            
            $request->validate([
                
                 'photo' => 'required|image|mimes:jpg,png,jpeg|dimensions:min_width=1200,min_height=500'
            ]);
        }
        
        
        try{
            
            $homeSlider = HomeSlider::find($request->id);
            
            if($request->file('photo')){
                
                $photo = $request->photo;
                $filename = time().'.'.$photo->getClientOriginalExtension();
                $path = 'assets/img/homeSlider';
                $photo->move($path, $filename);
                $homeSlider->image = $filename;
            }
            
            $homeSlider->title = $request->title;
            $homeSlider->subtitle = $request->subtitle;
            $homeSlider->button_text = $request->button_text;
            $homeSlider->button_link = $request->button_link;
            
            $updated = $homeSlider->save();
            
            if($updated){
                return redirect('admin/home_sliders')->with('success','Home Slider updated successfully');
                
            }
            
        }catch(\Throwable $th){
            
            return redirect('admin/home_sliders')->with('error', $th->getMessage());
            
        }
            
    }

    public function destroy($id)
    {
        try {
            
          $homeSlider = HomeSlider::find($id);
          
          $deletd = $homeSlider->delete();

           if($deletd){
                return redirect('admin/home_sliders')->with('success','Home Slider deleted successfully');
                
            }
            
        }catch(\Throwable $th){
            
            return redirect('admin/home_sliders')->with('error', $th->getMessage());
            
        }
    }
}

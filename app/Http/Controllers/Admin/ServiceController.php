<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   public function index()
    {
        $services = Service::all();
        return view('admin.service.index', compact('services'));
    }



    public function store(Request $request)
    {
       
        
       //validate the input 
        $request->validate([
           
           'title' => 'required',
           'subtitle' => 'required',
           'service_icon' => 'required|image|mimes:jpg,png,jpeg'
            
        ]);
        
        
        try{
            
            $service = new Service();
            
            if($request->file('service_icon')){
                
                $photo = $request->service_icon;
                $filename = time().'.'.$photo->getClientOriginalExtension();
                $path = 'assets/img/service';
                $photo->move($path, $filename);
                $service->service_icon = $filename;
            }
            
            $service->title = $request->title;
            $service->subtitle = $request->subtitle;
          
            $stored = $service->save();
            
            if($stored){
                return back()->with('success','Service created successfully');
                
            }
            
        }catch(\Throwable $th){
            
            return back()->with('error', $th->getMessage());
            
        }
            
            
            
          
        
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request)
    {
        
       //validate the input 
        $request->validate([
           'title' => 'required',
           'subtitle' => 'required',
            
        ]);
        
        if($request->file('service_icon')){
            
            $request->validate([
                
                 'photo' => 'required|image|mimes:jpg,png,jpeg'
            ]);
        }
        
        
        try{
            
            $service = Service::find($request->id);
            
            if($request->file('service_icon')){
                
                $photo = $request->service_icon;
                $filename = time().'.'.$photo->getClientOriginalExtension();
                $path = 'assets/img/service';
                $photo->move($path, $filename);
                $service->service_icon = $filename;
            }
            
            $service->title = $request->title;
            $service->subtitle = $request->subtitle;
         
            
            $updated = $service->save();
            
            if($updated){
                return redirect('admin/service')->with('success','Service updated successfully');
                
            }
            
        }catch(\Throwable $th){
            
            return redirect('admin/service')->with('error', $th->getMessage());
            
        }
            
    }

    public function delete($id)
    {
        try {
            
           $service = Service::find($id);
          
          $deletd = $service->delete();

           if($deletd){
                return redirect('admin/service')->with('success','service deleted successfully');
                
            }
            
        }catch(\Throwable $th){
            
            return redirect('admin/service')->with('error', $th->getMessage());
            
        }
    }
}

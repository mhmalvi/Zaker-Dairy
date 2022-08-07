<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionalBannerDeleteRequest;
use App\Http\Requests\PromotionalBannerUpdateRequest;
use App\Models\PromotionalBanner;
use Illuminate\Http\Request;

class PromotionalBannersController extends Controller
{
    //get the promotional dashboard page
    public function index(){
        
        return view('admin.banner.index');
        
    }
    public function getBanners()
    {
        $banner_1 = PromotionalBanner::where('name', 'banner_1')->first();
        $path_1 = $banner_1 ? asset('storage/app/public/promotional_banners/' . $banner_1->image) : null;

        $banner_2 = PromotionalBanner::where('name', 'banner_2')->first();
        $path_2 = $banner_2 ? asset('storage/app/public/promotional_banners/' . $banner_2->image) : null;

        return response()->json([
            'path_1' => $path_1,
            'path_2' => $path_2,
        ]);
    }

    public function updateBanners(PromotionalBannerUpdateRequest $request)
    {
        try {
            $request->save();

            return response()->json([
                'message' => "Banners updated successfully",
            ], 200);
        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteBanner1(PromotionalBannerDeleteRequest $request)
    {
        try {
            $banner = PromotionalBanner::where('name', 'banner_1')->first();
            $request->delete($banner);

            return response()->json([
                'message' => "Successfully deleted the promotional banner 1",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong",
            ], 500);
        }
    }

    public function deleteBanner2(PromotionalBannerDeleteRequest $request)
    {
        try {
            $banner = PromotionalBanner::where('name', 'banner_2')->first();
            $request->delete($banner);

            return response()->json([
                'message' => "Successfully deleted the promotional banner 2",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong",
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function showBannerEdit(){
        $banners = Banner::all();

        return view('admin.layouts.banner_edit', compact('banners'));
    }

    public function showBannerRegist(BannerRequest $request) 
    {   
        DB::beginTransaction();

        try{
            if($request->hasFile('banner_update_image')){
                foreach($request->file('banner_update_image') as $id => $file){
                    $banner = Banner::findOrFail($id);
                    $old_image_path = $banner->image;

                    $file_name = $file->getClientOriginalName();
                    $file->storeAs('public/images/banner', $file_name);
                    $new_image_path = 'storage/images/banner/' . $file_name;

                    if(\Storage::exists('public/' . str_replace('storage/', '', $old_image_path))){
                        \Storage::delete('public/' . str_replace('storage/', '', $old_image_path));
                    }

                    $banner->updateBanner($id, $new_image_path);
                }
            }

            if($request->hasFile('banner_new_update')){
                foreach($request->file('banner_new_update') as $file){
                    $file_name = $file->getClientOriginalName();
                    $file->storeAs('public/images/banner', $file_name);
                    $image_path = 'storage/images/banner/' . $file_name;
                    $model = new Banner();
                    $model->registBanner($image_path);
                }
            }
            DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                \Log::error('Banner registration failed: ' . $e->getMessage());
                return back()->withErrors('バナー登録中にエラーが発生しました。');
                \Log::error('Banner update failed: ' .$e->getMessage());
                return back()->withErrors('バナー更新中にエラーが発生しました。');
            }
        return redirect(route('admin.show.banner.edit'));
    }

    public function showBannerDelete($id)
    {
        DB::beginTransaction();
        try {
            $deleteBanner = new Banner();
            $deleteBanner->deleteBanner($id);
            DB::commit();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e){
            DB::rollback();
            \Log::error('バナー削除エラー: ' . $e->getMessage());
            return response()->json([
                'success' => false,
            ]);
        }
    }
}

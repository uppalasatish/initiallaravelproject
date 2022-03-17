<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRestaurantRequest;
use App\Restaurant;
use App\RestaurantImage;
class RestaurantController
{
    
    public function index()
    {
        $restaurants = Restaurant::get();

        return view('restaurant.index',compact('restaurants'));
    }

    public function create()
    {
        return view('restaurant.create');
    }

    public function store(StoreRestaurantRequest $request)
    {

        $data = $request->except('_token','profile_picture');
        $data['created_at'] = date('Y-m-d H:i:s'); 
        
        if($data){
            $restaurant_id = Restaurant::insertGetId($data);
        }

        if($restaurant_id)
        {
            if($request->hasFile('profile_picture'))
            {
                $profile = $request->file('profile_picture');
                $extension = $profile->extension();

                $path = public_path('images/restaurant');
                if(!is_dir($path)){
                   \File::makeDirectory($path, 0777, true);
                }

               $fileName = $restaurant_id.'.'.$extension;

               $res = $profile->move($path, $fileName);

               $image['restaurant_id'] = $restaurant_id;
               $image['image'] = $fileName;

               RestaurantImage::create($image);
            }
        }
        
        return redirect()->route('admin.restaurant.index');
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        return view('restaurant.show',compact('restaurant'));
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        return view('restaurant.edit',compact('restaurant'));
    }

    public function update(StoreRestaurantRequest $request)
    {
        $restaurant = Restaurant::findOrFail($request->id);
        $restaurant->update($request->except('_token','profile_picture','_method'));
       
        if($request->hasFile('profile_picture')){
            $file_path = public_path('images/restaurant/'.$restaurant->image->image);
            unlink($file_path);
            $profile = $request->file('profile_picture');
            $extension = $profile->extension();

            $path = public_path('images/restaurant');
            if(!is_dir($path)){
               \File::makeDirectory($path, 0777, true);
            }

            $fileName = $restaurant->id.'.'.$extension;

            $res = $profile->move($path, $fileName);
            RestaurantImage::whereRestaurantId($request->id)->update(['image'=>$fileName]);
        }

        return redirect()->route('admin.restaurant.index');
    }

    public function delete(Request $request)
    {
        $response['status'] = "failed";
        if($request->item_id){
            $restaurant = Restaurant::whereId($request->item_id)->first();
            $file_path = public_path('images/restaurant/'.$restaurant->image->image);
            unlink($file_path);
            $restaurant->delete();
            RestaurantImage::whereRestaurantId($request->item_id)->delete();
            
            $response['status'] = "success";
        }
        return response()->json($response,200);
    }
}

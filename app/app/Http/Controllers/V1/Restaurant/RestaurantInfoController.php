<?php

namespace App\Http\Controllers\V1\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RestaurantInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

final class RestaurantInfoController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error','errors' => $validator->messages()],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = RestaurantInfo::create($request->all());

        return api([$data])->success('Restaurants Created Successfully');

        return response()->json(['status' => 'success', 'data' => $data],200);
    }

    public function getRestaurant($id){

        $data = RestaurantInfo::find($id);

        return api([$data])->success('data funnd');

    }

}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

final class RestaurantInfoController extends Controller
{
    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lat'  => 'required',
            'long' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = RestaurantInfo::create($request->all());

        return api([$data])->success('Restaurants Created Successfully');
    }

    public function getRestaurant($id) : JsonResponse
    {
        $data = RestaurantInfo::find($id);

        return api([$data])->success('data funnd');
    }
}

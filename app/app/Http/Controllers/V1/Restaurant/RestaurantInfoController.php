<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Restaurant;

use App\Models\RestaurantInfo;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;
use App\Services\V1\Restaurant\RestaurantService;
use App\Http\Requests\V1\Restaurant\RestaurantCreateRequest;

final class RestaurantInfoController extends Controller
{

    public function __construct(public RestaurantService $restaurantService)
    {}

    public function store(RestaurantCreateRequest $request) : JsonResponse
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'lat'  => 'required',
        //     'long' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     //return response()->json(['status' => 'error', 'errors' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        //     return api(['errors' => $validator->messages()])->fails();
        // }

        $data = $this->restaurantService->createRestaurant($request->all());

        return api([$data])->success('Restaurants Created Successfully');
    }

    public function getRestaurant($id) : JsonResponse
    {
        $data = RestaurantInfo::find($id);

        return api([$data])->success('Data found');
    }
}

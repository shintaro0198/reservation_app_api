<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $item = Restaurant::all();
        return response()->json([
            'data' => $item
        ], 200);
    }
    public function store(Request $request)
    {
        $now = Carbon::now();
        $item = new Restaurant;
        $item->name = $request->name;
        $item->location = $request->location;
        $item->genre = $request->genre;
        $item->detail = $request->detail;
        $item->img = $request->img;
        $item->created_at = $now;
        $item->updated_at = $now;
        $item->save();
        if ($item) {
            return response()->json([
                'data' => $item,
                'message' => 'Stored successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Request failed'
            ], 404);
        }
    }
    public function show(Restaurant $restaurant)
    {
        $item = Restaurant::where('id', $restaurant->id)->first();
        if ($item) {
            return response()->json([
                'data' => $item,
                'message' => 'Request is approved'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }
    public function destroy(Restaurant $restaurant)
    {
        Restaurant::where('id', $restaurant->id)->first()->delete();
        response()->json([
            'message' => 'Deleted successfully'
        ], 200);
    }
}

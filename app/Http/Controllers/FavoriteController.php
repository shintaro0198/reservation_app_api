<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Favorite $favorite)
    {
        $item = Favorite::where('user_id', $favorite->id)->first();
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $now = Carbon::now();
        $query = Favorite::query();
        $query->where('user_id', $request->user_id);
        $query->where('restaurant_id', $request->restaurant_id);
        $item = $query->first();
        if ($item) {
            $item->delete();
            return response()->json([
                'message' => 'Deleted successfully'
            ], 200);
        } else {
            $item = new Favorite;
            $item->user_id = $request->user_id;
            $item->restaurant_id = $request->restaurant_id;
            $item->created_at = $now;
            $item->updated_at = $now;
            $item->save();
            return response()->json([
                'message' => 'Posted successfuly'
            ], 200);
        }
    }

    public function show(Request $request)
    {
        $query = Favorite::query();
        $query->where('user_id', $request->user_id);
        $query->where('restaurant_id', $request->restaurant_id);
        $item = $query->first();
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 200);
        }
    }
}

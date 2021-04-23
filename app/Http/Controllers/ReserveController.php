<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index(Reservation $reservation)
    {
        $item = Reservation::where('user_id', $reservation->id)->first();
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
        $query = Reservation::query();
        $query->where('user_id', $request->user_id);
        $query->where('restaurant_id', $request->restaurant_id);
        $query->where('date', $request->date);
        $query->where('time', $request->time);
        $item = $query->first();
        if ($item) {
            return response()->json([
                'message' => 'You already have the reservation'
            ]);
        } else {
            $now = Carbon::now();
            $item = new Reservation;
            $item->user_id = $request->user_id;
            $item->restaurant_id = $request->restaurant_id;
            $item->date = $request->date;
            $item->time = $request->time;
            $item->number = $request->number;
            $item->created_at = $now;
            $item->updated_at = $now;
            $item->save();
            if ($item) {
                return response()->json([
                    'message' => 'Posted successfully',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Request failed'
                ], 404);
            }
        }
    }

    public function show(Request $request)
    {
        $query = Reservation::query();
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
            ], 404);
        }
    }

    public function update(Request $request, Reservation $reservation)
    {
        $now = Carbon::now();
        $item = Reservation::where('id', $reservation->id)->first();
        if ($item) {
            $item->user_id = $request->user_id;
            $item->restaurant_id = $request->restaurant_id;
            $item->date = $request->date;
            $item->time = $request->time;
            $item->number = $request->number;
            $item->created_at = $now;
            $item->updated_at = $now;
            $item->save();
            return response()->json([
                'message' => 'Updated successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }

    public function destroy(Reservation $reservation)
    {
        Reservation::where('id', $reservation->id)->first()->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ], 200);
    }
}

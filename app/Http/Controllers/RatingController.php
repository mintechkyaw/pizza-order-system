<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rater(Request $request)
    {
        logger($request);
        $ratingTest = Rating::where('user_id', Auth::user()->id)->where('product_id', $request->pizzaId)->get();
        if (count($ratingTest) == 0) {
            $rating = new Rating;

            $rating->user_id = Auth::user()->id;
            $rating->product_id = $request->pizzaId;
            $rating->rating_count = $request->rateCount;
            $rating->message = $request->rateMsg;
            $rating->save();

            return response()->json(['msg' => "rating success"]);
        };
    }
}

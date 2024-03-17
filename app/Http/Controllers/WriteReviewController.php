<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Specialty;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WriteReviewController extends Controller
{
    //
    public function showReview($id){
        $workshop = Workshop::find($id);
        $rating = DB::table('ratings')->where('workshop_id', $id)->avg('rate');
        $ratingDetail = Rating::select('*')->where('workshop_id', $id)->paginate(15);
        $countUlasan = DB::table('ratings')->where('workshop_id', $id)->count('rate');
        $spesialisasiRate = DB::table('ratings')->select('*',DB::raw('AVG(rate) as avgrate'))
                            ->where('workshop_id', $id)
                            ->groupBy('specialty_id')
                            ->get();
        return view('writeReview', ['workshop' => $workshop,'title' => "Bengkel", 'rate' => $rating, 'countUlasan' => $countUlasan, 'spesialisasiRate' =>  $spesialisasiRate, 'ratingDetail' => $ratingDetail]);
    }

    public function writeReview($id, Request $req){
        // return $req;
        $user_id = auth()->user()->id;
        $workshop_id = $id;
        $specialty_id = Specialty::where('name', $req->specialty)->first();
        $rate = $req->rate;
        $comment = $req->comment;


        return auth()->user()->id;
        // dd($req);
        // $workshop = Workshop::find($id);
        // $rating = DB::table('ratings')->where('workshop_id', $id)->avg('rate');
        // $ratingDetail = Rating::select('*')->where('workshop_id', $id)->paginate(15);
        // $countUlasan = DB::table('ratings')->where('workshop_id', $id)->count('rate');
        // $spesialisasiRate = DB::table('ratings')->select('*',DB::raw('AVG(rate) as avgrate'))
        //                     ->where('workshop_id', $id)
        //                     ->groupBy('specialty_id')
        //                     ->get();
        // return view('writeReview', ['workshop' => $workshop,'title' => "Bengkel", 'rate' => $rating, 'countUlasan' => $countUlasan, 'spesialisasiRate' =>  $spesialisasiRate, 'ratingDetail' => $ratingDetail]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Specialty;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //

    public function test($id){
        $workshop = Workshop::find($id);
        $rating = DB::table('ratings')->where('workshop_id', $id)->avg('rate');
        $ratingDetail = Rating::select('*')->where('workshop_id', $id)->get();
        $countUlasan = DB::table('ratings')->where('workshop_id', $id)->count('rate');
        $spesialisasiRate = DB::table('ratings')->select('*',DB::raw('AVG(rate) as avgrate'))
                            ->where('workshop_id', $id)
                            ->groupBy('specialty_id')
                            ->get();
        return view('review', ['workshop' => $workshop,'title' => "Bengkel", 'rate' => $rating, 'countUlasan' => $countUlasan, 'spesialisasiRate' =>  $spesialisasiRate, 'ratingDetail' => $ratingDetail]);
    }

    public function sort($id, $sort){
        $workshop = Workshop::find($id);
        $rating = DB::table('ratings')->where('workshop_id', $id)->avg('rate');
        $countUlasan = DB::table('ratings')->where('workshop_id', $id)->count('rate');
        $spesialisasiRate = DB::table('ratings')->select('*',DB::raw('AVG(rate) as avgrate'))
                            ->where('workshop_id', $id)
                            ->groupBy('specialty_id')
                            ->get();
       if ($sort == 'newest') {
        $ratingDetail = Rating::select('*')->where('workshop_id', $id)->orderBy('created_at', 'DESC')->get();
       }
       else if ($sort == 'lowtohigh') {
        $ratingDetail = Rating::select('*')->where('workshop_id', $id)->orderBy('rate', 'ASC')->get();
       }
       else if ($sort == 'hightolow') {
        $ratingDetail = Rating::select('*')->where('workshop_id', $id)->orderBy('rate', 'DESCf')->get();
       }
       else{
        $ratingDetail = Rating::select('*')->where('workshop_id', $id)->get();
       }
       return view('review', ['workshop' => $workshop,'title' => "Bengkel", 'rate' => $rating, 'countUlasan' => $countUlasan, 'spesialisasiRate' =>  $spesialisasiRate, 'ratingDetail' => $ratingDetail]);
    }

}


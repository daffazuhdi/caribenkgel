<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Role;
use App\Models\Origin;
use App\Models\Rating;
use App\Models\CarBrand;
use App\Models\Workshop;
use App\Models\Facility;
use App\Models\Specialty;
use App\Models\FacilityWorkshop;
use App\Models\WorkshopPrice;
use App\Models\Workhour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function test(){
        $user = Workshop::find(1);
       // $role = Role::all();

       $workshop = Workshop::select('*')
                    //    ->join('specialty_workshop', 'specialty_workshop.workshop_id', '=', 'workshops.id')
                    //    ->join('car_brand_workshop', 'car_brand_workshop.workshop_id', '=', 'workshops.id')
                    ->withAvg('ratings', 'rate')
                    // ->where('specialty_id', $req->specialty)
                    ->orderBy('ratings_avg_rate', 'desc')->paginate(4);

        $specialty = Specialty::All();

        $countWorkshop = Workshop::count('id');
        $countCustomer = Rating::groupBy('user_id')->count('id');
        $countUser = User::count('id');
        $countBrand = CarBrand::count('id');

        return view('home', ['user' => $user, 'workshop' => $workshop, 'specialty' => $specialty, 'countWorkshop' => $countWorkshop, 'countCustomer' => $countCustomer, 'countUser' => $countUser, 'countBrand' => $countBrand
        ,'title' => "Beranda"]);
    }
    
    // kalau mau pake foreach loop, define id superclass
    // public function test(){
    //     $user = User::find(1);
    //     $car = Car::find(1);
    //     return view('home', ['user' => $user, 'car' => $car, 'title' => "Beranda"]);
    // }
}

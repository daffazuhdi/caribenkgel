@section('title', $title)
@extends('layouts.profile')
@section('message')
    @if (session('message'))
        <div class="success-message alert alert-success main-content d-flex align-items-center" role="alert" style="font-weight: 600; border-radius: 0; padding: 0 94px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 0.4em" width="1.1em" height="1.1em" viewBox="0 0 24 24">
                <path fill="#0D5C63" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif
@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send/?phone=%2B14155238886&text=join+combination-yellow&type=phone_number&app_absent=0" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
@section('content')
@if (Auth::user()->role_id == 1)
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <div class="d-flex justify-content-end">
        <a href="{{ url('/tambah-bengkel') }}" class="btn btn-outline-dark px-3 mt-2 mb-3 d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 0.4em" width="1em" height="1em" viewBox="0 0 256 256">
                <path fill="052023" d="M228 128a12 12 0 0 1-12 12h-76v76a12 12 0 0 1-24 0v-76H40a12 12 0 0 1 0-24h76V40a12 12 0 0 1 24 0v76h76a12 12 0 0 1 12 12"/>
            </svg>
            Tambah Bengkel
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-4 my-2" style="padding-bottom: 2em;">
        @foreach ($workshops as $workshop)
        <div class="col mb-4">
        <a href="/bengkel/{{ $workshop->id }}" class="" style="text-decoration: none">
            <div class="card h-100">
                <div style="padding: 1em 1em 0 1em;">
                    <img src="{{ url('storage/workshop/'.$workshop->photo) }}"  style="border-radius: 8px; object-fit: cover; width: 100vh; height: 152px;" class="card-img-top img-fluid" alt="{{ $workshop->name }}">
                </div>
                <div class="card-body border-bottom mx-3 py-3 px-0">
                    <h5 class="card-title" style="font-size: 18px; font-weight: 600">{{ $workshop->name }}</h5>
                    <div class="address d-flex justify-content-left align-items-center">
                        <div class="img-fluid" style="padding-right: 4%">
                                <img src="{{ url('photos/mapsLogo.svg') }}" style="width:16px;" alt="{{ $workshop->name }}">
                        </div>
                        <div>
                                <p class="m-0" style="font-size: 14px; font-weight: 400;">{{ $workshop->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-text d-flex justify-content-between m-3" style="">
                    <div class="card-text d-flex flex-wrap gap-1">
                        @if ($workshop->is_approved == 0)
                            <small class="rounded-pill px-2 py-1" style="color: #b88f27;">Waiting for Approval</small>
                        @elseif ($workshop->is_approved == 1)
                            <small class="rounded-pill px-2 py-1" style="color: #0D5C63;">Approved</small>
                            @elseif ($workshop->is_approved == 2)
                            <small class="rounded-pill px-2 py-1" style="color: red;">Rejected</small>
                        @endif
                        {{-- <small class="rounded-pill px-2 py-1" style="color: #0D5C63; border: 1px solid #0D5C63;">{{  ($workshop->is_approved == 1 ? 'Approved': 'Waiting for Approval')}}</small> --}}
                    </div>
                    <div class="card-text">
                        <small class="d-flex align-items-center" style="font-size: 16px; font-weight: 600; color: #052023">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-1" width="1.25em" height="1.25em" viewBox="0 0 24 24">
                                <path fill="#fac45b" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
                            </svg>
                            {{ number_format($workshop->reviews_avg_rating, 1) }}
                        </small>
                    </div>
                </div>
            </div>
        </a>
        </div>
        @endforeach
    </div>

@endif
@if (Auth::user()->role_id == 2)

        <div class="d-flex justify-content-between">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="background:none;border:none">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="true">
                        Ulasan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="vehicle-tab" data-bs-toggle="tab" data-bs-target="#vehicle" type="button" role="tab" aria-controls="vehicle" aria-selected="false">
                        Kendaraan
                    </button>
                </li>
            </ul>
            <a href="{{ url('/tambah-kendaraan') }}" class="btn btn-primary px-3" style="color: white !important; font-size: 14px;">
                Tambah Kendaraan
            </a>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active px-0 py-4" id="review" role="tabpanel" aria-labelledby="review-tab" style="padding: 1%">
                @if ($count == 0)
                    <p class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">Belum ada ulasan</p>
                @else
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($ratings as $rating)
                        <div class="col mb-4">
                        <div class="card h-100">
                            <div class="d-flex justify-content-right border-bottom align-items-center p-4" style="background: #F3F9F9; border-radius: 6px 6px 0 0;">
                                <div class="" style="padding-right: 1em;">
                                    <img src="{{ url('storage/workshop/'.$rating->workshop->photo) }}"  style="border-radius: 10%; object-fit: cover; width: 101px; height: 62px;" class="card-img-top" alt="{{ $rating->workshop->name }}">
                                </div>
                                <div class="d-flex justify-content-between" style="flex-direction: column;">
                                    <h5 class="card-title" style="font-size: 16px; font-weight: 600">{{ $rating->workshop->name }}</h5>
                                    <div class="address d-flex justify-content-left align-items-center">
                                            <div class="img-fluid" style="padding-right: 4%">
                                                <img src="{{ url('photos/mapsLogo.svg') }}" style="width:14px; border-radius: 4px;" alt="{{ $rating->workshop->name }}">
                                            </div>
                                            <div style="font-size: 12px; color: #052023; font-weight: 400">
                                                    {{ $rating->workshop->address }}
                                            </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <img src="{{ Storage::url('/photos/'.$workshop->photo) }}"  style="padding: 1em 1em 0 1em;" class="card-img-top img-fluid" alt="{{ $workshop->name }}"> --}}
                            <div class="card-body p-4 d-flex justify-content-between" style="flex-direction: column;">
                                <div class="card-text">
                                    <div class="card-title d-flex justify-content-between">
                                        <h5 class="card-title m-0 align-items-center" style="font-size: 16px; font-weight: 600">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</h5>
                                        <div class="card-text">
                                            <small class="d-flex align-items-center" style="font-size: 15px; font-weight: 500; color: #052023">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-1" width="1.25em" height="1.25em" viewBox="0 0 24 24">
                                                            <path fill="#fac45b" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
                                                    </svg>
                                                    {{ number_format($rating->rating, 1) }}
                                            </small>
                                        </div>
                                    </div>
                                    <h6 class="py-2 m-0" style="font-size: 16px; font-weight: 400; color: #303030;">{{ $rating->comment }}</h6>
                                </div>
                                <div class="card-text">
                                    <h6 class="text-black-50 my-4" style="font-size: 14px;">{{ $rating->created_at->format('j F Y') }}</h6>
                                    <div class="card-text mt-3">
                                        @if ($rating->specialty_id != 0)
                                            <small class="rounded-pill px-2 py-1" style="color: #0D5C63; border: 1px solid #0D5C63;">{{ $rating->name }}</small>
                                        @else
                                            <small class="rounded-pill px-2 py-1" style="color: #0D5C63; border: 1px solid #0D5C63;">Fasilitas</small>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4 mb-3">
                        <ul class="pagination m-0">
                            <li class="page-item">
                                <a class="page-link" href="{{ $ratings->previousPageUrl() }}"><</a>
                            </li>
                            @for ($page = 1; $page <= $ratings->lastPage(); $page++)
                                @if ($page == $ratings->currentPage())
                                    <li class="page-item-active">
                                        <a class="page-link" href="{{ $ratings->url($page) }}">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $ratings->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor
                            <li class="page-item">
                                <a class="page-link" href="{{ $ratings->nextPageUrl() }}">></a>
                            </li>
                        </ul>

                    </div>
                    <p class="d-flex justify-content-center">Menampilkan {{ $begin }} sampai {{ $end }} dari {{ $count }} hasil</p>
                @endif
            </div>
            <div class="tab-pane fade px-0 py-4" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab" style="padding: 1%">
                @if (count(Auth::user()->cars) == 0)
                <p class="d-flex justify-content-center align-items-center" style="min-height: 40vh;">Belum ada kendaraan</p>
                @else
                <div class="row row-cols-1 row-cols-md-4">
                    @foreach (Auth::user()->cars as $car)
                    <div class="col">
                        <a href="/kendaraan/{{ $car->id }}" style="text-decoration: none;">
                        <div class="card p-4 h-100">
                            <div class="col-md-10 mb-4" style="font-size: 16px;">
                                <p style="font-weight: 600;">{{ $car->license_plate }}</p>
                                <p>{{ $car->car_model->car_brand->name }} {{ $car->car_model->name }}</p>
                            </div>
                            <div class="">
                                <p class="text-muted">Terakhir kali servis/ganti oli</p>
                                @if (is_null($car->car_services->max('service_date')))
                                    <p>No data</p>
                                @else
                                    <p>{{ date('j F Y', strtotime($car->car_services->max('service_date'))) }}</p>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

@endif
@if (Auth::user()->role_id == 3)
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <div class="d-flex justify-content-end">
        <a href="{{ url('/tambah-bengkel') }}" class="btn btn-outline-dark px-3 mt-2 mb-3 d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 0.4em" width="1em" height="1em" viewBox="0 0 256 256">
                <path fill="052023" d="M228 128a12 12 0 0 1-12 12h-76v76a12 12 0 0 1-24 0v-76H40a12 12 0 0 1 0-24h76V40a12 12 0 0 1 24 0v76h76a12 12 0 0 1 12 12"/>
            </svg>
            Tambah Bengkel
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-4 my-2" style="padding-bottom: 2em;">
        @foreach ($workshopsSA as $workshop)
            @if ($workshop->is_approved == 0)
                <div class="col mb-4">
                    <a href="/bengkel/{{ $workshop->id }}" class="" style="text-decoration: none">
                        <div class="card h-100">
                            <div style="padding: 1em 1em 0 1em;">
                                <img src="{{ url('storage/workshop/'.$workshop->photo) }}"  style="border-radius: 8px; object-fit: cover; width: 100vh; height: 152px;" class="card-img-top img-fluid" alt="{{ $workshop->name }}">
                            </div>
                            <div class="card-body border-bottom mx-3 py-3 px-0">
                                <h5 class="card-title" style="font-size: 18px; font-weight: 600">{{ $workshop->name }}</h5>
                                <div class="address d-flex justify-content-left align-items-center">
                                    <div class="img-fluid" style="padding-right: 4%">
                                            <img src="{{ url('photos/mapsLogo.svg') }}" style="width:16px;" alt="{{ $workshop->name }}">
                                    </div>
                                    <div>
                                            <p class="m-0" style="font-size: 14px; font-weight: 400;">{{ $workshop->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-text d-flex justify-content-between m-3" style="">
                                <div class="card-text d-flex flex-wrap gap-1">
                                    @if ($workshop->is_approved == 0)
                                        <small class="rounded-pill px-2 py-1" style="color: #b88f27;">Waiting for Approval</small>
                                    @elseif ($workshop->is_approved == 1)
                                        <small class="rounded-pill px-2 py-1" style="color: #0D5C63;">Approved</small>
                                        @elseif ($workshop->is_approved == 2)
                                        <small class="rounded-pill px-2 py-1" style="color: red;">Rejected</small>
                                    @endif
                                    {{-- <small class="rounded-pill px-2 py-1" style="color: #0D5C63; border: 1px solid #0D5C63;">{{  ($workshop->is_approved == 1 ? 'Approved': 'Waiting for Approval')}}</small> --}}
                                </div>
                                <div class="card-text">
                                    <small class="d-flex align-items-center" style="font-size: 16px; font-weight: 600; color: #052023">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-1" width="1.25em" height="1.25em" viewBox="0 0 24 24">
                                            <path fill="#fac45b" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
                                        </svg>
                                        {{ number_format($workshop->reviews_avg_rating, 1) }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
        @foreach ($workshopsSA as $workshop)
            @if ($workshop->is_approved == 1)
                <div class="col mb-4">
                    <a href="/bengkel/{{ $workshop->id }}" class="" style="text-decoration: none">
                        <div class="card h-100">
                            <div style="padding: 1em 1em 0 1em;">
                                <img src="{{ url('storage/workshop/'.$workshop->photo) }}"  style="border-radius: 8px; object-fit: cover; width: 100vh; height: 152px;" class="card-img-top img-fluid" alt="{{ $workshop->name }}">
                            </div>
                            <div class="card-body border-bottom mx-3 py-3 px-0">
                                <h5 class="card-title" style="font-size: 18px; font-weight: 600">{{ $workshop->name }}</h5>
                                <div class="address d-flex justify-content-left align-items-center">
                                    <div class="img-fluid" style="padding-right: 4%">
                                            <img src="{{ url('photos/mapsLogo.svg') }}" style="width:16px;" alt="{{ $workshop->name }}">
                                    </div>
                                    <div>
                                            <p class="m-0" style="font-size: 14px; font-weight: 400;">{{ $workshop->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-text d-flex justify-content-between m-3" style="">
                                <div class="card-text d-flex flex-wrap gap-1">
                                    @if ($workshop->is_approved == 0)
                                        <small class="rounded-pill px-2 py-1" style="color: #b88f27;">Waiting for Approval</small>
                                    @elseif ($workshop->is_approved == 1)
                                        <small class="rounded-pill px-2 py-1" style="color: #0D5C63;">Approved</small>
                                        @elseif ($workshop->is_approved == 2)
                                        <small class="rounded-pill px-2 py-1" style="color: red;">Rejected</small>
                                    @endif
                                    {{-- <small class="rounded-pill px-2 py-1" style="color: #0D5C63; border: 1px solid #0D5C63;">{{  ($workshop->is_approved == 1 ? 'Approved': 'Waiting for Approval')}}</small> --}}
                                </div>
                                <div class="card-text">
                                    <small class="d-flex align-items-center" style="font-size: 16px; font-weight: 600; color: #052023">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-1" width="1.25em" height="1.25em" viewBox="0 0 24 24">
                                            <path fill="#fac45b" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
                                        </svg>
                                        {{ number_format($workshop->reviews_avg_rating, 1) }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach

@endif
@endsection


<style>
    h4, h6, a, .placeholder {
        color: #052023;
    }
    .nav-tabs .nav-item .nav-link {
        color: #040404;
        font-size: 18px;
        border: none;
    }
    .nav-tabs .nav-item .nav-link.active {
        border:none;
        background:none;border-bottom:3px solid #0D5C63;color:#0D5C63
    }
    .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:40px;
        right:40px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        font-size:30px;
        box-shadow: 2px 2px 3px #999;
        z-index:100;
    }

    .my-float{
        margin-top:16px;
    }
</style>

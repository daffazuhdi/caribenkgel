@extends('layouts.main')
@section('title', $workshop->name)
@section('container')
  <div class="container py-4 px-0 m-auto">
    {{-- <div class="d-flex justify-content-center">
      <div class="popup" id="popup">
        <h5 style="font-weight: 600; margin: 0;">Hapus Bengkel?</h5>
        <p class="mb-5">Kamu akan secara permanen menghapus bengkel ini.</p>
        <div class="d-flex justify-content-end gap-2">
          <button class="btn btn-secondary px-3" onclick="closeForm()">Batal</button>
          <form class="m-0" action="/bengkel-detail-{{ $workshop->id }}" method="post">
            @csrf
            <button class="btn btn-primary px-3" type="submit">Hapus</button>
          </form>
        </div>
      </div>
    </div> --}}
    <div class="fotoBengkel">
      <img src="{{ url('storage/workshop/'.$workshop->photo) }}" class="img-fluid w-100 mx-auto" alt="..." style="border-radius: 4px; object-fit: cover; height: 60vh;">
    </div>
    <div class="containerInformationCard my-4" style="display: flex;justify-content:space-between">
        <div class="information w-100">
          @auth
            @if(Auth::user()->role_id == 1)
                <div class="d-flex justify-content-between">
                  <h4 style="font-weight: 600; margin: 0;">{{$workshop->name}}</h4>
                  <div class="d-flex justify-content-left gap-2">
                      <a href="/ubah-bengkel/{{ $workshop->id }}" class="btn btn-outline-dark px-3">
                        <img src="{{ url('photos/edit.svg') }}" width="16px;">
                      </a>
                      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteWorkshop" style="padding: 6px 17px;">
                        <img src="{{ url('photos/delete.svg') }}" width="14px;">
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="deleteWorkshop" tabindex="-1" aria-labelledby="deleteWorkshop" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content p-4">
                            <div class="modal-header p-0 border-0">
                              <h5 class="modal-title" style="font-weight: 600;" id="deleteWorkshop">Hapus Bengkel?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0 mt-1 mb-4">
                              <p class="m-0">Kamu akan secara permanen menghapus bengkel ini.</p>
                            </div>
                            <div class="modal-footer border-0 d-flex justify-content-end gap-2 p-0">
                              <button type="button" class="btn btn-outline-dark px-3" data-bs-dismiss="modal">Batal</button>
                              <form class="m-0" action="/bengkel-detail-{{ $workshop->id }}" method="post">
                                @csrf
                                <button class="btn btn-danger px-3" type="submit">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
            @elseif(Auth::user()->role_id == 2)
                <h4 style="font-weight: 600;">{{$workshop->name}}</h4>
            @endauth
            @else
                <h4 style="font-weight: 600;">{{$workshop->name}}</h4>
            @endif
            <div class="address d-flex justify-content-left align-items-center gap-3 mb-2 mt-3">
            <div class="img-fluid">
              <img src="{{ url('photos/mapsLogo.svg') }}" style="width:18px;" alt="...">
            </div>
            <div>
              <p class="m-0" style="font-size: 18px; font-weight: 400;">{{ $workshop->address }}</p>
            </div>
            </div>
            {{-- <div class="d-flex justify-content-left align-items-center" style="gap: 0.7rem;">
                <div class="img-fluid">
                    <img src="{{ url('photos/whatsappLogo.svg') }}" alt="..." style="width:22px;">
                </div>
                <div>
                    <p class="m-0" style="font-size: 18px; font-weight: 400;">{{ $workshop->phone_number }}</p>
                </div>
            </div> --}}
        </div>
        @auth
            @if(Auth::user()->role_id == 2)
                <div class="cardService">
                    <div class="card" style="width: 23rem;">
                        <div class="card-body">
                            <h5 class="card-title" style="padding-left:1%; font-size: 18px; font-weight: 600;">Ingin Servis?</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary" style="padding-left:1%">Lakukan penjadwalan sekarang</h6>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary" style="background-color: #0D5C63;color:white;text-decoration:none;">Jadwalkan Servis Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
            @else
            <div class="cardService">
                <div class="card" style="width: 23rem;">
                    <div class="card-body">
                    <h5 class="card-title" style="padding-left:1%; font-size: 18px; font-weight: 600;">Ingin Servis?</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary" style="padding-left:1%">Lakukan penjadwalan sekarang</h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #0D5C63;color:white;text-decoration:none;">Jadwalkan Servis Sekarang</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Masuk Akun Terlebih Dahulu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apabila kamu ingin melakukan penjadwalan bengkel, silahkan masuk akun terlebih dahulu.
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <a href="/masuk"><button type="button" class="btn btn-primary">Masuk</button></a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">

    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background:none;border:none">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="tentang-tab" data-bs-toggle="tab" data-bs-target="#tentang" type="button" role="tab" aria-controls="tentang" aria-selected="true">Tentang</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="fasilitas-tab" data-bs-toggle="tab" data-bs-target="#fasilitas" type="button" role="tab" aria-controls="fasilitas" aria-selected="false">Fasilitas</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="merekmobil-tab" data-bs-toggle="tab" data-bs-target="#merekmobil" type="button" role="tab" aria-controls="merekmobil" aria-selected="false">Merek Mobil</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="waktuoperasional-tab" data-bs-toggle="tab" data-bs-target="#waktuoperasional" type="button" role="tab" aria-controls="waktuoperasional" aria-selected="false">Waktu Operasional</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="hargalayanan-tab" data-bs-toggle="tab" data-bs-target="#hargalayanan" type="button" role="tab" aria-controls="hargalayanan" aria-selected="false">Harga Layanan</button>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="tentang" role="tabpanel" aria-labelledby="tentang-tab" style="padding: 1%">
          <h6 style="padding-top:2%;padding-bottom:2%">{{$workshop->about}}</h6>
          <div class="location">
            @if ($workshop->location != null)
                <p><iframe src="{{$workshop->location}}" width="400" height="300" style="border:0;width:100%" allowfullscreen="" loading="lazy"></iframe></p>
            @else
                <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2971198600335!2d106.64732441476916!3d-6.224498995494186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb20a9906e13%3A0xf75c5296d0a385e4!2sBINUS%20UNIVERSITY%2C%20Kampus%20Alam%20Sutera!5e0!3m2!1sen!2sid!4v1623678826710!5m2!1sen!2sid" width="400" height="300" style="border:0;width:100%" allowfullscreen="" loading="lazy"></iframe></p>
            @endif
           </div>
      </div>
      <div class="tab-pane fade" id="fasilitas" role="tabpanel" aria-labelledby="fasilitas-tab" style="padding: 1%">
          <h6 style="padding-top:2%;padding-bottom:2%">Berikut merupakan fasilitas yang disediakan oleh bengkel untuk kenyamanan para pelanggan:</h6>
          @foreach ($workshop->facilities as $w)
              <p>• {{$w->name}}</p>
          @endforeach
      </div>
      <div class="tab-pane fade" id="merekmobil" role="tabpanel" aria-labelledby="merekmobil-tab" style="padding: 1%">
          <h6 style="padding-top:2%;padding-bottom:2%">Berikut merupakan merek mobil yang dapat dikerjakan oleh bengkel ini:</h6>
          @foreach ($workshop->car_brands as $w)
              <p>• {{$w->name}}</p>
          @endforeach
      </div>
      <div class="tab-pane fade" id="waktuoperasional" role="tabpanel" aria-labelledby="waktuoperasional-tab" style="padding-top: 3%">
          <table class="table table-bordered mb-5">
              <thead>
                <tr>
                  <th scope="col">Senin</th>
                  <th scope="col">Selasa</th>
                  <th scope="col">Rabu</th>
                  <th scope="col">Kamis</th>
                  <th scope="col">Jumat</th>
                  <th scope="col">Sabtu</th>
                  <th scope="col">Minggu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach ($workshop->workhours as $wh)
                      <td>{{$wh->working_hour}}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
      </div>
      <div class="tab-pane fade" id="hargalayanan" role="tabpanel" aria-labelledby="hargalayanan-tab" style="padding-top: 3%">
          <table class="table table-bordered mb-5">
              <thead>
                <tr>
                  <th scope="col">Layanan</th>
                  <th scope="col">Harga</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($workshop->prices as $wp)
                      <tr>
                          <td>{{$wp->service->name}}</td>
                          <td>{{$wp->price}}</td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
      </div>
    </div>

    <div class="showRating d-flex mt-4 mb-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" viewBox="0 0 24 24">
              <path fill="#fac45b" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
          </svg>
          <h5 style="padding-right: 0.5%;padding-left: 0.2%">{{number_format($rate, 1)}}</h5>
          <h5 style="padding-right: 0.5%;">•</h5>
          <h5>{{$countUlasan}} Ulasan</h5>
    </div>
    <div class="containerAllRate d-flex" style="justify-content: space-between">
      <div class="row row-cols-1 row-cols-md-6 m-1">
          @foreach ($workshop->specialties as $ws)
          <div class="col p-0 m-1" style="width: 7rem;padding-right:0%">
              <div class="card d-flex m-0 p-2 h-100">
              <div class="card-body" style="padding:0.5rem">
                  <h6 class="card-title">{{$ws->name}}</h6>
                  <h7 class="card-subtitle mb-2 text-muted">
                      @foreach ($spesialisasiRate as $sr)
                          @if ($ws->id === $sr->specialty_id)
                              {{number_format($sr->avgrate,1)}}
                          @endif
                      @endforeach
                  </h7>
              </div>
              </div>
          </div>
          @endforeach
      </div>
          <div class="d-grid gap-4">
              <a href="/review/{{ $workshop->id }}" type="button" class="btn btn-primary" style="margin-top:5.5rem;margin-right:0.5rem;font-size: 14px;">Lihat Semua</a>
          </div>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4 py-4 px-2">
          @foreach ($ratingDetail as $wr)
              <div class="col">
                  <div class="card h-100">
                      <div class="card-body">
                      <div class="cardTop d-flex" style="justify-content:space-between">
                          <h6 class="card-title">{{$wr->user->first_name}} {{$wr->user->last_name}}</h6>
                          <div class="cardRating d-flex px-1">
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24" style="margin-right: 10%">
                                  <path fill="#fac45b" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z"/>
                              </svg>
                              <h6 class="card-title">{{number_format($wr->rate, 1)}}</h6>
                          </div>
                      </div>
                      <p class="card-text">{{$wr->comment}}</p>
                      <p class="card-text text-muted" style="font-size: 14px;">{{$wr->created_at->format('j F Y')}}</p>
                      <small class="rounded-pill px-2 py-1" style="color: #0D5C63; border: 1px solid #0D5C63;">{{$wr->specialty->name}}</small>
                      </div>
                  </div>
              </div>
          @endforeach
        </div>
      {{-- {{$spesialisasiRate->avgrate}} --}}

    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    function openForm() {
      document.getElementById("popup").style.display = "block";
    }
    function closeForm() {
      document.getElementById("popup").style.display = "none";
    }
  </script>
@endsection
<style>
    .nav-tabs .nav-item .nav-link {
      color: #040404;
      border: none;
      font-size: 18px;
    }
    .nav-tabs .nav-item .nav-link.active {
      border:none;
      background:none;border-bottom:3px solid black;color:#0D5C63
    }
    .popup {
      display: none;
      position: absolute;
      top: 260px;
      background-color: white;
      border-radius: 8px;
      z-index: 9;
      padding: 2%;
    }
 </style>


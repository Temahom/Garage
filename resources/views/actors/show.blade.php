@extends('layout.index')
@section('content')
    <div class="row ml-1">
        <div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
            <div class="row">

                <div class="col-md-2 col-sm-3 text-center pt-3">
                    @if ($user->role()->first()->role == "admin")
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/masculin.png" alt="logo">
                    @else
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/feminin.png" alt="logo">
                    @endif
                </div>

                <div class="col-md-9 col-sm-10">
                    <div style="font-size: 20px; color: #2EC551">{{ $user->name}}</div>
                    <div style="font-size: 14px;"><i class="fas fa-home"></i> {{ $user->email}}</div>
                    <div style="font-size: 14px;"><i class="fas fa-phone"></i> {{ $user->role()->first()->role}}</div>
                    {{-- <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{ $client->email}}</div> --}}
                </div>

            </div>
        </div>
    </div>

@endsection    
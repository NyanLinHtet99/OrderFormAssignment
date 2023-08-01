@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                    <div id="map"></div>
                    <form>
                        <div><label for="lat">Latitude</label><input type="text" name="lat" id="lat"></div>
                        <div><label for="lng">Longitude</label><input type="text" name="lng" id="lng">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

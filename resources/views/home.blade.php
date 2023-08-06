@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <?= $errors ?>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-primary d-none" role="alert" id="geoservice">
                    Geolocation service is not available. Please select your loaction.
                </div>
                <form action="/order/store" method="POST" class="row g-3 mt-4 needs-validation" novalidate>
                    @csrf
                    <div class="col-md-12 row">
                        <label for="nrc" class="form-label">NRC</label>
                        <div class="col-md-2" id="nrc">
                            <select type='text' aria-label="nrc_region" id="nrc_region" placeholder="12/"
                                name="nrc_region" required
                                @if (old('nrc_region')) data-oldValue="{{ old('nrc_region') }}" @endif>
                            </select>
                            <div class="invalid-feedback">
                                Please select a region.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select type='text' class="form-select" aria-label="nrc_township" id="nrc_township"
                                placeholder="select region first" name="nrc_township" required
                                @if (old('nrc_township')) data-oldValue="{{ old('nrc_township') }}" @endif>
                            </select>
                            <div class="invalid-feedback">
                                Please select a township.
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select type='text' class="form-select" aria-label="nrc_type" id="nrc_type"
                                placeholder="(C)" name="nrc_type" required>
                                <option value="C" {{ old('nrc_type') == 'C' ? 'selected' : '' }}>(C)
                                </option>
                                <option value="N" {{ old('nrc_type') == 'N' ? 'selected' : '' }}>(N)</option>
                                <option value="M" {{ old('nrc_type') == 'M' ? 'selected' : '' }}>(M)</option>
                                <option value="V" {{ old('nrc_type') == 'V' ? 'selected' : '' }}>(V)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text"
                                class="form-control
                                @error('nrcExists')
                                is-invalid
                            @enderror"
                                id="nrc_no" placeholder="NRC no" name="nrc_no" required minlength="6" maxlength="6"
                                value="{{ old('nrc_no') }}">
                            <div class="invalid-feedback" id="nrc_no_feedback">
                                @if ($errors->has('nrcExists'))
                                    Nrc Exists
                                @else
                                    Please provide a valid NRC
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name" name="name"
                            required value="{{ old('name') }}">
                        <div class="invalid-feedback">
                            Please provide a name
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="phone" class="form-label">Mobile Phone*</label>
                        <input type="text" class="form-control" id="phone" placeholder="+95995*******" required
                            name="phone" value="{{ old('phone') }}">
                        <div class="invalid-feedback">
                            Please provide a valid phone number either starting with +95 or 09
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="secondary-phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="secondary-phone" placeholder="+95995*******"
                            name="secondary_phone" value="{{ old('secondary_phone') }}">

                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="email" required name="email"
                            placeholder="Enter your email address" value="{{ old('email') }}">
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="col-md-12 row mt-4">
                        <div class="col-md-7">
                            <div id="map"></div>
                        </div>
                        <div class="col-md-5 row">
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address*</label>
                                <textarea class="form-control" id="address" rows="3" required name="address" placeholder="Enter your address">{{ old('address') }}</textarea>
                                <div class="invalid-feedback">
                                    Please enter an address
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="product" class="form-label">Product*</label>
                                <select type='text' class="form-select" aria-label="products" id="product"
                                    placeholder="Select a product" name="product"
                                    @if (old('product')) data-oldValue="{{ old('product') }}" @endif>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a product.
                                </div>
                                <p class="text-sm mt-3" id="price"></p>
                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <label for="lat" class="form-label">Latitude*</label>
                                    <input type="text" class="form-control" id="lat" name="lat" required
                                        readonly value="{{ old('lat') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="lng" class="form-label">Longitude*</label>
                                    <input type="text" class="form-control" id="lng" name="lng" required
                                        readonly value="{{ old('lng') }}">
                                </div>
                            </div>
                            <div class="col-md-12 mt-4 d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit" style="max-height: 40px">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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

                    </form>
                </div>
                <form class="row g-3 needs-validation mt-5" novalidate>
                    <div class="col-md-12 row">
                        <div class="col-md-3">
                            <select type='text' aria-label="nrc_region" id="nrc_region" placeholder="12/"
                                name="nrc_region" required>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select type='text' class="form-select" aria-label="nrc_township" id="nrc_township"
                                placeholder="select region first" name="nrc_township" required>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select type='text' class="form-select" aria-label="Nrc Type" id="nrc_type"
                                placeholder="(C)" name="nrc_type" required>
                                <option value="C">(C)</option>
                                <option value="N">(N)</option>
                                <option value="M">(M)</option>
                                <option value="V">(V)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="name" placeholder="NRC no" name="nrc_no"
                                required>
                            <div class="invalid-feedback">
                                Please provide your NRC no
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name" name="phone"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Mobile Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="+95995*******" required
                            name="phone">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="secondary-phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="secondary-phone" placeholder="+95995*******"
                            name="secondary_phone">

                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required name="email"
                            placeholder="Enter your email address">
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="3" required name="address" placeholder="Enter your address"></textarea>
                        <div class="invalid-feedback">
                            Please enter an address
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="product" class="form-label">Product</label>
                        <select type='text' class="form-select" aria-label="products" id="product"
                            placeholder="Select a product" name="product">
                            <option value="Product A">Product A</option>
                            <option value="Product B">Product B</option>
                            <option value="Product C">Product C</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a product.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="lat" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="lat" name="lat" required readonly
                            disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="lng" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="lng" name="lng" required readonly
                            disabled>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

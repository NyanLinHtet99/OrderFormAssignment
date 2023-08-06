@extends('layouts.table')

@section('content')
    <div class="row">
        <div class="col-md-12 w-75 mx-auto">
            <table class="table table-striped"id="orders" width="100%">
                <thead>
                    <th>Id</th>
                    <th>NRC</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Secondary Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Product</th>
                </thead>
            </table>
        </div>
    </div>
@endsection

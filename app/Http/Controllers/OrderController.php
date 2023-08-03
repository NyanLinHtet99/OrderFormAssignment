<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Database\Factories\OrderFactory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        auth()->user()->id;
        $validated = $request->validate([
            'nrc_region' => 'required|numeric',
            'nrc_township' => 'required|regex:/[A-Za-z]{6}/',
            'nrc_type' => 'required|regex:/[A-Z]/',
            'nrc_no' => 'required|regex:/[0-9]{6}/',
            'name' => 'required',
            'phone' => 'required|regex:/^[\+]?[0-9]{3}?[0-9]{8,9}$/',
            'secondary_phone' => 'nullable|regex:/^[\+]?[0-9]{3}?[0-9]{8,9}$/',
            'email' => 'required|email',
            'address' => 'required',
            'product' => 'required|exists:products,id',
            'lat' => 'required|decimal:7',
            'lng' => 'required|decimal:7',
        ]);
        $product = Product::find($validated['product']);
        $nrc = $validated['nrc_region'] . '/' . $validated['nrc_township'] . '(' . $validated['nrc_type'] . ')' . $validated['nrc_no'];
        $product->orders()->create([
            'nrc' => $nrc,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'secondary_phone' => $validated['secondary_phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
        ]);
        dd($product);
    }
}

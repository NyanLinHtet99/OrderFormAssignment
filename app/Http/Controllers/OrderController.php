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
        // auth()->user()->id;
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
        $order = $product->orders()->create([
            'nrc' => $nrc,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'secondary_phone' => $validated['secondary_phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
        ]);
        return view('orders.index');
    }
    public function index(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'nrc',
            2 => 'name',
            3 => 'phone',
            4 => 'secondary_phone',
            5 => 'email',
            6 => 'address',
            7 => 'product'
        );

        $totalData = Order::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $sort = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $orders = Order::offset($start)
                ->limit($limit)
                ->orderBy($sort, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $orders =  Order::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('product', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($sort, $dir)
                ->get();

            $totalFiltered = Order::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('product', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $nestedData['id'] = $order->id;
                $nestedData['nrc'] = $order->nrc;
                $nestedData['name'] = $order->name;
                $nestedData['phone'] = $order->phone;
                $nestedData['secondary_phone'] = is_null($order->secondary_phone) ? $order->secondary_phone : '-';
                $nestedData['email'] = $order->email;
                $nestedData['address'] = $order->address;
                $nestedData['product'] = $order->product->name;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}

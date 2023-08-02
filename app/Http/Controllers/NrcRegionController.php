<?php

namespace App\Http\Controllers;

use App\Models\NrcRegion;
use Illuminate\Http\Request;

class NrcRegionController extends Controller
{
    public function index()
    {
        $ids = NrcRegion::pluck('id');
        return json_encode($ids);
    }
}

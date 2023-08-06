<?php

namespace App\Http\Controllers;

use App\Models\NrcRegion;
use Illuminate\Http\Request;

class NrcTownshipController extends Controller
{
    public function __construct()
    {
    }
    public function show()
    {
        $region = NrcRegion::find(request('id'));
        return $region->nrcTownships()->pluck('name');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NrcRegion;
use Illuminate\Http\Request;

class NrcTownshipController extends Controller
{
    public function show()
    {
        $region = NrcRegion::find(request('id'));
        return json_encode($region->nrcTownships()->pluck('name'));
    }
}

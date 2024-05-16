<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlavorCollection;
use App\Http\Resources\FlavorResource;
use App\Models\Flavor;
use Illuminate\Http\Request;

class FlavorResourceController extends Controller
{
    /**
     * Display a listing of the Flavors.
     */
    public function index()
    {
        return new FlavorCollection(Flavor::all());

        /*
        return
            new FlavorResource(
                Flavor::orderBy('name')->first()
            );
        */
    }

}

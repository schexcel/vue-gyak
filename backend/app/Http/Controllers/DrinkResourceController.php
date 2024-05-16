<?php

namespace App\Http\Controllers;

use App\Http\Resources\DrinkCollection;
use App\Http\Resources\DrinkDetailedResource;
use App\Http\Resources\DrinkResource;
use App\Models\Drink;
use App\Http\Requests\StoreDrinkRequest;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Response;

class DrinkResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new DrinkCollection(Drink::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrinkRequest $request)
    {
        $data = $request->validated();
        try {

            $drink = Drink::create($data);

            foreach ($data["ingredients"] as $ing) {
                Ingredient::create([
                    'name' => $ing,
                    'drink_id' => $drink->id
                ]);
            }

        } catch (\Exception $e) {
            return Response::json([
                'data' => $e->getMessage(),
                'success' => false,
                'message' => "Something went wrong"
            ], 500);
        }

        return Response::json([
            'data' => new DrinkResource($drink),
            'success' => true,
            'message' => "Drink created"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Drink $drink)
    {
        return new DrinkDetailedResource($drink);
    }

}

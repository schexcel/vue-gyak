<?php

namespace App\Http\Resources;

use App\Models\Flavor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrinkDetailedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                'id' => $this->id,
                'name' => $this->name,
                'ingredients' => new IngredientCollection($this->ingredients),
                'description' => $this->description,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'discounted_price' => $this->discounted_price,
                /*'flavor' => new FlavorResource(Flavor::find($this->flavor_id))*/
                'flavor' => new FlavorResource($this->flavor)
            ],
            "success" => true,
            "message" => ""
        ];
    }
}

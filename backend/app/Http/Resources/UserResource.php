<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $latestSelection = $this->userAidSelections->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->city->name,
            'latest_selection' => $latestSelection ? [
                'aid_type' => $latestSelection->aidType->name ?? null,
                'aid_category' => $latestSelection->aidCategory->name ?? null,
                'product_category' => $latestSelection->productCategory->name ?? null,
                'products' => $latestSelection->productUserSelections->map(function($selection) {
                    return [
                        'id' => $selection->product->id,
                        'name' => $selection->product->name
                    ];
                })
            ] : null
        ];
    }
}
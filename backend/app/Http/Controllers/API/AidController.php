<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\API\BaseController;
use App\Models\AidType;
use App\Models\Product;
use App\Models\AidCategory;
use App\Models\ProductUserSelection;
use App\Models\ProductCategory;
use App\Models\UserAidSelection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\RequestBody;

class AidController extends BaseController
{
    #[OA\Post(
        path: "/api/aid",
        summary: "Store user aid selection from form after register",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                properties: [
                    new OA\Property(property: "aid_type_id", type: "integer", description: "ID of the aid type (required)", example: 1),
                    new OA\Property(property: "aid_category_id", type: "integer", description: "ID of the aid category (required)", example: 1),
                    new OA\Property(property: "product_category_id", type: "integer", nullable: true, description: "ID of the product category (optional)", example: 1),
                    new OA\Property(
                        property: "products",
                        type: "array",
                        nullable: true,
                        items: new OA\Items(type: "integer", description: "IDs of selected products (optional)")
                    )
                ]
            )
        ),
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Data successfully saved.",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Data successfully saved.")
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Validation error"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server error")
        ]
    )]
    
    /**
     * Download data from the form after registration and save it
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'aid_type_id' => 'required|exists:aid_types,id',
            'aid_category_id' => 'required|exists:aid_categories,id',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);


        $userAidSelection = UserAidSelection::create([
            'user_id' => auth()->id(), 
            'aid_type_id' => $request->aid_type_id,
            'aid_category_id' => $request->aid_category_id,
            'product_category_id' => $request->product_category_id,
        ]);


        if ($request->has('products') && count($request->products) > 0) {
            foreach ($request->products as $productId) {
                ProductUserSelection::create([
                    'user_aid_selection_id' => $userAidSelection->id,
                    'product_id' => $productId
                ]);
            }
        }

        return response()->json([
            'message' => 'Data successfully saved.',
        ]);
    }
}

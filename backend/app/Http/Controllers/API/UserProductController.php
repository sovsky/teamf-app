<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProductController extends Controller
{
     /**
     * Save the selected products for the authenticated user.
     */
    public function saveProducts(Request $request)
    {
        // Walidacja przychodzących danych
        $request->validate([
            'product_ids' => 'required|array', // Produkty muszą być tablicą
            'product_ids.*' => 'exists:products,id', // Upewniamy się, że każdy ID produktu istnieje w tabeli 'products'
        ]);

        // Pobieramy aktualnie zalogowanego użytkownika
        $user = auth()->user();

        // Pobieramy produkty na podstawie przekazanych ID
        $products = Product::find($request->product_ids);

        // Powiązanie użytkownika z wybranymi produktami
        $user->products()->sync($products); // 'sync' powiązuje produkty i automatycznie dodaje/aktualizuje rekordy w tabeli 'users_products'

        return response()->json([
            'message' => 'Produkty zostały zapisane dla użytkownika.',
            'products' => $products
        ]);
    }
}

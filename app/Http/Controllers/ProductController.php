<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            // Obter o ID do usuário logado
            $loggedInUserId = Auth::id();

            // Recuperar os produtos dos dois usuários em uma única consulta
            $products = Product::whereIn('user_id', [$loggedInUserId, 1])->paginate(10);
        } else {
            // Se o usuário não estiver autenticado, recuperar apenas os produtos do usuário com ID 1
            $products = Product::where('user_id', 1)->paginate(10);
        }

        return Response($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = $this->findProductById($id);

            if ($product->user_id !== Auth::id()) {
                return Response(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

            return Response($product);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $product = $this->findProductById($id);

            if ($product->user_id !== Auth::id()) {
                return Response(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
            ]);
            $product->update($validatedData);
            return Response($product);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = $this->findProductById($id);

            if ($product->user_id !== Auth::id()) {
                return Response(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
            $product->delete();
            return Response(['message' => 'Product deleted successfully']);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    protected function findProductById($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new Exception('Product not found', Response::HTTP_NOT_FOUND);
        }

        return $product;
    }
}

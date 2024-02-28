<?php

namespace App\Http\Controllers;

use App\Service\ExceptionService;
use App\Service\MessageService;
use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                $products = Product::whereIn('user_id', [Auth::id(), 1])->paginate(10);
            } else {
                $products = Product::where('user_id', 1)->paginate(10);
            }

            return Response($products);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request['user_id'] = Auth::id();
            return Product::create($request->all());
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = $this->findObjectById($id);
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
            $product = $this->findObjectById($id);

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
            $product = $this->findObjectById($id);
            $product->delete();
            return MessageService::destroyOk();
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    protected function findObjectById($id)
    {
        $product = Product::find($id);
        $this->objectExists($product);

        return $product;
    }

    protected function objectExists($obj)
    {
        if (!$obj) {
            ExceptionService::notFound();
        }

        if (Auth::check() && (Auth::id() != $obj->user_id)) {
            ExceptionService::unauthorized();
        }

        if (!Auth::check() && $obj->user_id != 1) {
            ExceptionService::unauthorized();
        }
    }
}

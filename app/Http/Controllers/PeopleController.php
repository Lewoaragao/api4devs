<?php

namespace App\Http\Controllers;

use App\Models\People;
use Exception;
use Illuminate\Http\Request;
use Response;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
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
            //code...
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            //code...
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //code...
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    protected function findProductById($id)
    {
        $product = People::find($id);

        if (!$product) {
            throw new Exception('People not found', Response::HTTP_NOT_FOUND);
        }

        return $product;
    }
}
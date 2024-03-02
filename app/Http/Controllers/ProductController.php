<?php

namespace App\Http\Controllers;

use App\Service\ExceptionService;
use App\Service\MessageService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Listing all resources
     *
     * @OA\Get(
     *   path="/api/product",
     *   tags={"Product"},
     *   @OA\Response(
     *     response=200,
     *     description="Response success",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Successful action!"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/Product")
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     *
     * @return array
     */
    public function index()
    {
        if (Auth::check()) {
            $products = Product::whereIn('user_id', [Auth::id(), 1])->paginate(10);
        } else {
            $products = Product::where('user_id', 1)->paginate(10);
        }

        return Response($products);
    }

    /**
     * Storing a new resource.
     *
     * @OA\Post(
     *   path="/api/product",
     *   tags={"Product"},
     *   security={{"bearerAuth": {}}},
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Product created successfully"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="object",
     *           ref="#/components/schemas/Product"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *              property="name",
     *              type="string",
     *              description="Name of Product",
     *              example="PC"
     *          ),
     *          @OA\Property(
     *              property="description",
     *              type="string",
     *              description="Description of Product",
     *              example="Personal Computer"
     *          ),
     *           @OA\Property(
     *              property="price",
     *              type="decimal",
     *              description="Price of Product",
     *              example="200.50"
     *          ),
     *          @OA\Property(
     *              property="quantity",
     *              type="integer",
     *              description="Quantity of Product",
     *              example="100"
     *          )
     *       )
     *     )
     *   )
     * )
     *
     * @return array
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        Product::create($request->all());
        return Response(['message' => 'Product created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Show a specific resource.
     *
     * @OA\Get(
     *   path="/api/product/{id}",
     *   tags={"Product"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Identification of Product",
     *     example=1,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Successful action!"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="object",
     *           ref="#/components/schemas/Product"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   )
     * )
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $product = $this->findObjectById($id);
        return Response($product);
    }

    /**
     * Updating a specific resource.
     *
     * @OA\Put(
     *   path="/api/product/{id}",
     *   tags={"Product"},
     *   security={{"bearerAuth": {}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Identification of Product",
     *     example=1,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Successful action!"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="boolean",
     *           example=true
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *              property="name",
     *              type="string",
     *              description="Name of Product",
     *              example="PC"
     *          ),
     *          @OA\Property(
     *              property="description",
     *              type="string",
     *              description="Description of Product",
     *              example="Personal Computer"
     *          ),
     *          @OA\Property(
     *              property="price",
     *              type="decimal",
     *              description="Price of Product",
     *              example="200.50"
     *          ),
     *          @OA\Property(
     *              property="quantity",
     *              type="integer",
     *              description="Quantity of Product",
     *              example="100"
     *          )
     *       )
     *     )
     *   )
     * )
     *
     * @param  int   $id
     * @param  array $data
     * @return array
     */
    public function update(Request $request, $id)
    {
        $product = $this->findObjectById($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product->update($validatedData);
        return Response($product);
    }

    /**
     * Deleting a specific resource
     *
     * @OA\Delete(
     *   path="/api/product/{id}",
     *   tags={"Product"},
     *   security={{"bearerAuth": {}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Identification of User",
     *     example=1,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Response Successful",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="message",
     *           type="string",
     *           example="Successful action!"
     *         ),
     *         @OA\Property(
     *           property="data",
     *           type="boolean",
     *           example=true
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Response Error"
     *   )
     * )
     *
     * @param  int $id
     * @return array
     */
    public function destroy($id)
    {
        $product = $this->findObjectById($id);
        $product->delete();
        return MessageService::destroyOk();
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

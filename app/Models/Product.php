<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  schema="Product",
 *  type="object",
 *  description="Schema of Model Product",
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Identification of Product",
 *      example=1
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string",
 *      description="Name of Product",
 *      example="PC"
 *  ),
 *  @OA\Property(
 *      property="description",
 *      type="string",
 *      description="Description of Product",
 *      example="Personal Computer"
 *  ),
 *   @OA\Property(
 *      property="price",
 *      type="decimal",
 *      description="Price of Product",
 *      example="200.50"
 *  ),
 *  @OA\Property(
 *      property="quantity",
 *      type="string",
 *      description="Quantity of Product",
 *      example="100"
 *  )
 * )
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

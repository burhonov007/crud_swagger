<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    /**
     * @OA\Schema(
     *     schema="Post",
     *     title="Post",
     *     description="Post object",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="ID of the post"
     *     ),
     *     @OA\Property(
     *         property="title",
     *         type="string",
     *         description="Title of the post"
     *     ),
     *     @OA\Property(
     *         property="description",
     *         type="string",
     *         description="Description of the post"
     *     ),
     *     @OA\Property(
     *         property="image",
     *         type="string",
     *         description="Image of the post"
     *     ),
     *     @OA\Property(
     *         property="likes",
     *         type="integer",
     *         description="Likes of the post",
     *         example="1"
     *     ),
     *     @OA\Property(
     *         property="created_at",
     *         type="string",
     *         format="date-time",
     *         description="Date and time when the post was created"
     *     ),
     *     @OA\Property(
     *         property="updated_at",
     *         type="string",
     *         format="date-time",
     *         description="Date and time when the post was updated"
     *     )
     * )
     */

    private $id;
    private $title;
    private $description;
    private $image;
    private $likes;
    private $created_at;
    private $updated_at;

}

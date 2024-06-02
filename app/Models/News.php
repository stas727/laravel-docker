<?php

declare(strict_types=1);

namespace App\Models;

use App\Constants\NewsStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use OpenApi\Annotations as OA;

/**
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $short_description
 * @property string $full_description
 * @property Carbon $created_at
 * @property NewsStatus $status
 *
 * @method News active()
 *
 * @OA\Schema(
 *
 * @OA\Xml(name="News"),
 *
 * @OA\Property(property="title", type="string", readOnly="true", description="News title"),
 * @OA\Property(property="url", type="string", readOnly="true", description="News url"),
 * @OA\Property(property="short_description", type="string", readOnly="true", description="Short text", example="Some short text"),
 * @OA\Property(property="full_description", type="string", readOnly="true", description="Full text",  example="Some full text"),
 * @OA\Property(property="created_at", type="string", readOnly="true", example="021-06-22T23:22:26.000000Z"),
 * @OA\Property(property="status", type="int", maxLength=1, example="1"),
 * )
 */
class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'url',
        'short_description',
        'full_description',
        'created_at',
        'status',
    ];

    protected $casts = [
        'status' => NewsStatus::class,
    ];

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive(Builder $query): void
    {
        $query->whereIn('status', [
            NewsStatus::ACTIVE
        ]);
    }
}

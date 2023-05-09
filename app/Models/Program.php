<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProgramStateEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;

class Program extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'state',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'state' => ProgramStateEnum::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function items(): HasMany | Builder
    {
        return $this->hasMany(ProgramItem::class)
            ->orderBy('order_column', 'asc');
    }
}

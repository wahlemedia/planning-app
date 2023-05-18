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
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

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
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function items(): HasMany | Builder
    {
        return $this->hasMany(ProgramItem::class)
            ->orderBy('order_column', 'asc');
    }

    public function scopeCurrent(): self
    {
        return $this->query()
            ->orderBy('start_date', 'desc')
            ->where('state', '=', ProgramStateEnum::PUBLISHED)
            ->first();
    }

    public function scopeNext(): self
    {
        return $this->query()
            ->orderBy('start_date', 'desc')
            ->where('state', '=', ProgramStateEnum::DRAFT)
            ->first();
    }

    // public function scopePrevious(): self
    // {
    //     return $this->query()
    //         ->orderBy('start_date', 'desc')
    //         ->where('state', '=', ProgramStateEnum::PUBLISHED);
    // }
}

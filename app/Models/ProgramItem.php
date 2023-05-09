<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ProgramItem extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'program_id',
        'topic_id',
        'started_at',
        'ended_at',
        'notes',
        'order_column'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];


    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'topic',
        'moderators',
    ];


    /**
     * Get the program that belongs to the program.
     */

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the topic that belongs to this item.
     */

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get all the moderators that held this topic.
     */
    public function moderators(): BelongsToMany
    {
        return $this->belongsToMany(Moderator::class);
    }

    public function getSortableOrderColumnName(): string
    {
        return 'order_column';
    }
}

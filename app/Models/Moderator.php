<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Moderator extends Model
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
        'name',
        'email',
    ];


    /**
     * Get all the topics that this moderator held.
     */
    public function topics(): Builder
    {
        return Topic::distinct()
            ->select('topics.*')
            ->join('program_items as pi', 'topics.id', '=', 'pi.topic_id')
            ->join('moderator_program_item as mpi', 'pi.id', '=', 'mpi.program_item_id')
            ->join('moderators as m', 'mpi.moderator_id', '=', 'm.id')
            ->where('m.id', '=', $this->id);
    }


    public function programItems(): BelongsToMany
    {
        return $this->belongsToMany(ProgramItem::class);
    }
}

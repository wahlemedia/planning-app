<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Collection;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model implements HasMedia
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'links'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'links' => 'array'
    ];


    /**
     * Get all the moderators that helt this topic.
     */
    public function moderators(): Collection
    {
        return $this->programItems->each->moderator
            ->map(fn ($i) => $i->moderators)
            ->flatten();
    }

    public function programItems(): HasMany
    {
        return $this->HasMany(ProgramItem::class);
    }
}

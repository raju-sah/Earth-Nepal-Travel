<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Activity extends Model
{
    use HasFactory, ModelQueryTrait, UploadFileTrait;

    protected $guarded = ['id'];

    public function parentActivity(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->select(['id', 'title', 'slug', 'parent_id']);
    }

    public function childActivities(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public static function tree()
    {
        $allActivities = self::select(['id', 'title', 'parent_id'])->where('status', 1)->get();

        $rootActivities = $allActivities->whereNull('parent_id');

        self::formatTree($rootActivities, $allActivities);

        return $rootActivities;
    }

    private static function formatTree($activities, $allActivities): void
    {
        foreach ($activities as $activity) {
            $activity->children = $allActivities->where('parent_id', $activity->id)->values();

            if ($activity->children->isNotEmpty()) {
                self::formatTree($activity->children, $allActivities);
            }
        }
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class);
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class);
    }

    public function menu(): MorphOne
    {
        return $this->morphOne(Menu::class, 'menuable');
    }

    public function inquiries(): MorphMany
    {
        return $this->morphMany(Inquiry::class, 'inquirable');
    }
}

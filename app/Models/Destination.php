<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Destination extends Model
{
    use HasFactory, UploadFileTrait, ModelQueryTrait;

    protected $guarded = ['id'];

    public function getImagePathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/destination-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function parentDestination(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->select(['id', 'title', 'slug', 'parent_id']);
    }

    public function childDestinations(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public static function tree()
    {
        $allDestinations = self::select(['id', 'title', 'parent_id'])->where('status', 1)->get();

        $rootDestinations = $allDestinations->whereNull('parent_id');

        self::formatTree($rootDestinations, $allDestinations);

        return $rootDestinations;
    }

    private static function formatTree($destinations, $allDestinations): void
    {
        foreach ($destinations as $destination) {
            $destination->children = $allDestinations->where('parent_id', $destination->id)->values();

            if ($destination->children->isNotEmpty()) {
                self::formatTree($destination->children, $allDestinations);
            }
        }
    }

    public function destinationCategory(): BelongsTo
    {
        return $this->belongsTo(DestinationCategory::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class);
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class);
    }

    // public function mapCountryName($name): string
    // {
    //     $countries = get_all_countries();
    //     return $countries[$name] ?? $name;
    // }

    public function menu(): MorphOne
    {
        return $this->morphOne(Menu::class, 'menuable');
    }

    public function inquiries(): MorphMany
    {
        return $this->morphMany(Inquiry::class, 'inquirable');
    }
}

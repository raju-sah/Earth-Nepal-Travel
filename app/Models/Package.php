<?php

namespace App\Models;

use App\Traits\ModelQueryTrait;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Package extends Model
{
    use HasFactory, UploadFileTrait, ModelQueryTrait;

    protected $guarded = [];

    public function getBannerPathAttribute(): string
    {
        return $this->image ? asset('uploaded-images/package-banner-images/' . $this->image) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function getImagePathAttribute(): string
    {
        return $this->road_map ? asset('uploaded-images/package-road-map-images/' . $this->road_map) : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }

    public function scopeWithAvgRating($query)
    {
        return $query->addSelect([
            'reviews_avg_rating' => function ($query) {
                $query->where('status', 1)->selectRaw('CEIL(COALESCE(AVG(rating), 0))')
                    ->from('package_reviews')
                    ->whereColumn('package_id', 'packages.id');
            }
        ]);
    }

    public function getPDFFileName($filename): string
    {
        return $filename . now()->format('Y-m-d') . '.pdf';
    }

    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function menu(): MorphOne
    {
        return $this->morphOne(Menu::class, 'menuable');
    }

    public function include_exclude(): HasOne
    {
        return $this->hasOne(IncludeExclude::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class);
    }

    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function common_faqs(): BelongsToMany
    {
        return $this->belongsToMany(CommonFaq::class, 'common_faq_package', 'package_id', 'common_faq_id');
    }

    public function package_faqs(): HasMany
    {
        return $this->hasMany(PackageFaq::class);
    }

    public function essential_info(): HasOne
    {
        return $this->hasOne(EssentialInfo::class);
    }

    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(Itinerary::class);
    }

    public function itinerary_details(): HasMany
    {
        return $this->hasMany(ItineraryDetail::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PackageReview::class);
    }

    public function inquiries(): MorphMany
    {
        return $this->morphMany(Inquiry::class, 'inquiriable');
    }

    public function bookings(): MorphMany
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}

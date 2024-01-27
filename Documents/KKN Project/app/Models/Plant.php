<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Plant extends Model implements Sitemapable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'benefit',
        'expiration',
        'image',
        'created_at',
        'updated_at',
    ];


    /**
     * Override he image path for the plant.
     */
    public function getPhotoAttribute(): string
    {
        $image = $this->attributes['image'];
        return $image === null ?
            'https://via.placeholder.com/720x720?text=No+Image' :
            asset('storage/plants/' . $image);
    }


    /**
     * Set the site map tag for the model.
     *
     * @return Url|string|array
     */
    public function toSitemapTag(): Url | string | array
    {
        return route('plants.show', $this);

        return Url::create(route('plants.show', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }
}

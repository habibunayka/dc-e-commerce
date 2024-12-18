<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    use SoftDeletes;

    protected $fillable = ['path'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            if ($photo->path && !$photo->isForceDeleting()) {
                Storage::disk('public')->delete($photo->path);
            }
        });

        static::forceDeleting(function ($photo) {
            if ($photo->path) {
                Storage::disk('public')->delete($photo->path);
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

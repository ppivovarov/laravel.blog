<?php

namespace App\Models;

use App\Http\Requests\StorePost;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'content', 'description', 'category_id', 'thumbnail'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * @param StorePost $request
     * @param null $image
     * @return false|string|null
     */
    public static function uploadImage(StorePost $request, $image = null)
    {
        if ($request->hasFile('thumbnail')) {
            if (!is_null($image)) {
                Storage::delete($image);
            }
            $dir = date('Y-m-d');
            return $request->file('thumbnail')->store('images/' . $dir);
        }
        return null;
    }

    public function getImage()
    {
        return is_null($this->thumbnail) ? asset('uploads/images/noimage.png') : asset('uploads/' .$this->thumbnail);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use File;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'mime'];

    /**
     * Posts in category
     */
    public function post()
    {
        return $this->hasOne(Post::class);
    }

//    public function imageable()
//    {
//        return $this->morphTo();
//    }

    public static function createImage()
    {
        $image = request()->thumbnail_id;
        $name = $image->getClientOriginalName();
        $image->storeAs(
            '', $name, 'public'
        );

        $disk = 'public';
        $url = parse_url(Storage::disk($disk)->url($name))['path'];
        $mime = File::mimeType(Storage::disk('public')->path($name));
        $data = [
            'name' => $name,
            'url' => $url,
            'mime' => $mime,
        ];
        $image = Image::create($data);
        return $image;
    }

//    public function updateEvent()
//    {
//        $data = request()->all();
//        $this->update($data);
//        $this->saveTranslations($data);
//        return $this;
//    }
}

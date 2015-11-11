<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class DinerPhoto extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'diner_photo';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];

    /**
     * Set a default file path to the photos folder.
     */
    protected $baseDir = 'img/photos';

    /**
     * Get the user with the profile picture.
     */
    public function diners()
    {
        return $this->belongsTo('Resly\Diner');
    }

    /**
     * create a new instance of the class and name it whatever the name of the file is.
     */
    public static function named($name)
    {
        return (new static)->saveAs($name);
    }

    /**
     * Set the proper values of the column in the diner_photo table.
     * Prefix the file name with the timestamp to avoid replacing existing
     * photos.
     * Create the photo and thumbnail path.
     */
    protected function saveAs($name)
    {
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf('%s/%s', $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf('%s/tn-%s', $this->baseDir, $this->name);

        return $this;
    }

    /**
     * Move the photo to its final resting place.
     */
    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }

    /**
     * Make the thumbnail.
     */
    protected function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }
}

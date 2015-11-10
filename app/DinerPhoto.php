<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DinerPhoto extends Model
{
    /**
     * The table associated with the model
     */
    protected $table = 'diner_photo';

    /**
     * The attribute that is mass assignable.
     */
    protected $fillable = ['path'];

    /**
     * Set a default file path to the photos folder
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
     * Create a photo destination path and move the uploaded file to a
     * permanent location
     *
     * Prefix the file name with the timestamp to avoid replacing existing
     * photos.
     * Create the photo path.
     * move the uploaded file to the /img/photos folder
     */
    public static function uploadedPicture(UploadedFile $file)
    {
        $photo = new static;

        $name = time() . $file->getClientOriginalName();

        $photo->path = $photo->baseDir . '/' . $name;

        $file->move($photo->baseDir, $name);

        return $photo;
    }
}

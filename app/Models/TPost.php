<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPost extends Model
{
    use HasFactory;

    protected $table = 't_post';
    protected $fillable = ["video_title", "video_path", "converted", "thumbnail", "file_name", "view_mode", "create_at"];

    public $timestamps = false;

    public function likes() {

        return $this->hasMany('App\MLike', 'post_id');
    }

}

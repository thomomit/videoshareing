<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TLike extends Model
{
    use HasFactory;

    protected $table = 't_like';
    public $timestamps = false;
    protected $fillable = ["iine", "post_id", "create_at", "edit-at",];

    public function post() {

        return $this->belongsTo('App\TPost');
    }
}

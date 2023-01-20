<?php

namespace App\Models;

use App\Http\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Socialmedia extends Model
{
    use HasFactory,Uuids;

    protected $table = 'social_media_users';

    protected $guarded = [];

    public function user()
    {
        return $this->belongs(User::class, 'user_id', 'id');
    }
}

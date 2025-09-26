<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Comment extends Model
{
	public function files(){
        return $this->morphMany(File::class, "imageable");
    }
	public function user(){
		return $this->hasOne(User::class, 'id', 'id_user');
	}
}

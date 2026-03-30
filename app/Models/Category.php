<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'color', 'icon', 'order'];

    public function links() {
        return $this->hasMany(Link::class)->orderBy('order');
    }
}

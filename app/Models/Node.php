<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    public function edges()
    {
        return $this->hasMany(Edge::class, 'from_node');
    }
}

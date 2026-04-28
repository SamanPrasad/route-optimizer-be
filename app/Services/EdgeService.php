<?php

namespace App\Services;

use App\Models\Edge;

class EdgeService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data)
    {
        $edge = new Edge();
        $edge->from_node = $data['from_node'];
        $edge->to_node = $data['to_node'];
        $edge->distance = $data['distance'];
        $edge->save();

        return $edge;
    }
}

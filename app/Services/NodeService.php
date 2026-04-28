<?php

namespace App\Services;

use App\Models\Edge;
use App\Models\Node;
use Illuminate\Support\Facades\DB;

class NodeService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all()
    {
        return Node::with('edges')->get();
    }

    public function create($data)
    {
        DB::transaction(function () use ($data) {
            $node = new Node();
            $node->name = $data['name'];
            $node->save();

            return $node->load('edges');
        });
    }

    public function shortestPath($graph, $source)
    {
        $dist = [];
        $prev = [];
        $queue = [];

        foreach ($graph as $node => $edges) {
            $dist[$node] = INF;
            $prev[$node] = null;
            $queue[$node] = INF;
        }

        $dist[$source] = 0;
        $queue[$source] = 0;

        while (!empty($queue)) {
            // Get node with smallest distance
            $u = array_keys($queue, min($queue))[0];
            unset($queue[$u]);

            foreach ($graph[$u] as $neighbor => $weight) {
                $alt = $dist[$u] + $weight;

                if ($alt < $dist[$neighbor]) {
                    $dist[$neighbor] = $alt;
                    $prev[$neighbor] = $u;
                    $queue[$neighbor] = $alt;
                }
            }
        }

        return [$dist, $prev];
    }

    public function getPath($prev, $target)
    {
        $path = [];

        while ($target !== null) {
            array_unshift($path, $target);
            $target = $prev[$target];
        }

        return $path;
    }
}

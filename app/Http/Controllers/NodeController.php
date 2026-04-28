<?php

namespace App\Http\Controllers;

use App\Http\Requests\NodeRequest;
use App\Models\Edge;
use App\Models\Node;
use App\Services\NodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NodeController extends Controller
{
    public function __construct(public NodeService $nodeService) {}

    public function create(NodeRequest $request)
    {
        return $this->nodeService->create($request->validated());
    }

    public function all()
    {
        return $this->nodeService->all();
    }

    public function shortestPath(Request $request)
    {
        $source = $request->source;
        $target = $request->target;

        // Build graph
        $graph = [];

        $nodes = Node::all();
        foreach ($nodes as $node) {
            $graph[$node->id] = [];
        }

        $edges = Edge::all();
        foreach ($edges as $edge) {
            $graph[$edge->from_node][$edge->to_node] = $edge->weight;
        }

        [$dist, $prev] = $this->nodeService->shortestPath($graph, $source);
        $path = $this->nodeService->getPath($prev, $target);

        return [
            'nodeNames' => $path,
            'distance' => $dist[$target] === INF ? null : $dist[$target]
        ];
    }

    public function pathHistory() {}
}

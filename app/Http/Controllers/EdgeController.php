<?php

namespace App\Http\Controllers;

use App\Http\Requests\EdgeRequest;
use App\Services\EdgeService;
use Illuminate\Http\Request;

class EdgeController extends Controller
{
    public function __construct(public EdgeService $edgeService) {}

    public function create(EdgeRequest $request)
    {
        return $this->edgeService->create($request->validated());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVirtualCardRequest;
use App\Models\VirtualCard;
use App\Services\VirtualCardService;
use Illuminate\Http\JsonResponse;

class VirtualCardController extends Controller
{

    public function __construct(
        protected VirtualCardService $virtualCardService
    )
    { }

    public function index(): JsonResponse
    {
        $data = $this->virtualCardService->index();

        return response()->json($data, 200);
    }

    public function store(CreateVirtualCardRequest $request)
    {
        $data = $this->virtualCardService->store($request->validated());

        return response()->json($data, 201);
    }

    public function show(string $slug)
    {
        $data = $this->virtualCardService->show($slug);

        return view('virtual-card', $data);
    }
}

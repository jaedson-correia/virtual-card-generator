<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVirtualCardRequest;
use App\Models\VirtualCard;
use Illuminate\Http\JsonResponse;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VirtualCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $cards = VirtualCard::all();

        return response()->json([
            'cards' => $cards
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateVirtualCardRequest $request)
    {
        $validated = $request->validated();

        $card = VirtualCard::create($validated);

        $qrCode = base64_encode(QrCode::generate(route('virtual-card.show', [$card->slug])));

        return response()->json([
            'card' => $card,
            'qr-code' => $qrCode
        ], 201);
    }

    public function show(string $slug)
    {
        $card = VirtualCard::findBySlug($slug);

        return view();
    }
}

<?php

namespace App\Services;

use App\Models\VirtualCard;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class VirtualCardService.
 */
class VirtualCardService
{

    public function index(): array
    {
        return [
            'cards' => VirtualCard::all()
        ];
    }

    public function store(array $validated): array
    {
        $card = VirtualCard::create($validated);

        $qrCode = base64_encode(QrCode::size(200)->generate(route('virtual-card.show', [$card->slug])));

        return [
            'card' => $card,
            'qr-code' => $qrCode
        ];
    }

    public function show(string $slug): array
    {
        return [
            'card' => VirtualCard::findBySlug($slug)
        ];
    }

}

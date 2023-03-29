<?php

namespace Tests\Unit;

use App\Models\VirtualCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexVirtualCardApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_cards_empty_array(): void
    {
        $response = $this->json('GET', '/api/cards');

        $response->assertStatus(200);
        $response->assertJson([
            'cards' => []
        ]);
    }

    /** @test */
    public function it_should_return_all_cards(): void
    {
        VirtualCard::factory()->count(2)->create();
        $response1 = $this->json('GET', '/api/cards');

        VirtualCard::factory()->count(3)->create();
        $response2 = $this->json('GET', '/api/cards');

        $response1->assertJsonCount(2, 'cards');
        $response2->assertJsonCount(5, 'cards');
    }
}

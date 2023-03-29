<?php

namespace Tests\Unit;

use App\Models\VirtualCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowVirtualCardTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_should_return_404(): void
    {
        $string = substr(md5(rand()), 0, 12);

        $response = $this->call('GET', '/'.$string);

        $response->assertStatus(404);
    }

    /** @test */
    public function it_should_return_200_with_right_card(): void
    {
        $card = VirtualCard::factory()->create();

        $response = $this->call('GET', '/'.$card->slug);

        $response->assertStatus(200);
        $response->assertViewHas('card', $card);
    }
}

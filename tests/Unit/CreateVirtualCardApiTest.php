<?php

namespace Tests\Unit;

use App\Models\VirtualCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateVirtualCardApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_fail_validation(): void
    {
        $response = $this->json('POST', '/api/generate', []);

        $response->assertStatus(422);
    }

    /** @test */
    public function it_should_create_virtual_card(): void
    {
        $string = substr(md5(rand()), 0, 12);
        $response = $this->json('POST', '/api/generate', [
            'name' => $string,
            'linkedin' => $string,
            'github' => $string
        ]);

        $card = VirtualCard::where('name', $string)->first();

        $response->assertStatus(201);
        $this->assertModelExists($card);
    }
}

<?php

namespace Tests\Unit;

use App\Models\VirtualCard;
use Tests\TestCase;
use Illuminate\Support\Str;

class CreateVirtualCardApiTest extends TestCase
{
    /** @test */
    public function it_should_fail_validation(): void
    {
        $response = $this->json('POST', '/api/generate', [
            'name' => 'test'
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function it_should_create_virtual_card(): void
    {
        $string = Str::random(12);
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

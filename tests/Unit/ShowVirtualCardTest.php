<?php

namespace Tests\Unit;

use App\Models\VirtualCard;
use Tests\TestCase;

class ShowVirtualCardTest extends TestCase
{
    /** @test */
    public function it_should_return_404(): void
    {
        $string = substr(md5(rand()), 0, 12);

        $response = $this->call('GET', '/'.$string);

        $response->assertStatus(404);
    }

    /** @test */
    public function it_should_return_200(): void
    {
        $string = substr(md5(rand()), 0, 12);

        $card = VirtualCard::create([
            'name' => $string,
            'linkedin' => $string,
            'github' => $string,
            'slug' => $string
        ]);

        $response = $this->call('GET', '/'.$card->slug);

        $response->assertStatus(200);
        $response->assertViewHas('card', $card);
    }
}

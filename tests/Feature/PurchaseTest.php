<?php

namespace Tests\Feature;

use App\Http\Middleware\HasClientToken;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    public function testPurchaseWithoutClientToken()
    {
        $this->json('POST', 'api/v1/purchase', ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "status"=> false,
                "error"=> "Unauthorized"
            ]);
    }

    public function testPurchaseWithInvalidClientToken()
    {
        $this->json('POST', 'api/v1/purchase', ['Accept' => 'application/json','client-token' => 'sdfsdfbdfgsdfszd'])
            ->assertStatus(401)
            ->assertJson([
                "status"=> false,
                "error"=> "Unauthorized"
            ]);
    }

    public function testPurchaseWithValidClientTokenButMissingRequiredParams()
    {
        $this->withoutMiddleware([HasClientToken::class]);

        $this->json('POST', 'api/v1/purchase', ['Accept' => 'application/json','Client-Token' => "123456789abcdefgh!@#"])
            ->assertStatus(422)
            ->assertJson([
                "message"=> "The given data was invalid.",
                "errors"=> [
                    "receipt"=> [
                        "The receipt field is required."
                    ]
                ]
            ]);
    }
}

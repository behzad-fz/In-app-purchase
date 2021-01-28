<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRequiredParamsForRegister()
    {
        $this->json('POST', 'api/v1/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "uid" => ["The uid field is required."],
                    "appid" => ["The appid field is required."],
                    "language" => ["The language field is required."],
                    "os" => ["The os field is required."],
                ]
            ]);
    }

    public function testRegisterSuccess()
    {
        $params = [
            "uid" => "15665ds",
            "appid" => "65165d",
            "language" => "objective-c",
            "os" => "ios"
        ];

        $this->json('POST', 'api/v1/register', $params, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJsonStructure([
            "message",
            "error",
            "code",
            "results" => [
                "uid",
                "language",
                "os",
                "updated_at",
                "created_at",
                "id",
                "clientToken"
            ]
        ]);
    }
}

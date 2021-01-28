<?php

namespace App\Services;

use App\Models\ClientToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ClientTokenService
{
    private $deviceModel;

    public function __construct(Model $deviceModel)
    {
        $this->deviceModel = $deviceModel;
    }

    public function isTokenValid($token)
    {
        return ClientToken::where('token', $token)->first() ? true : false;
    }

    public function getDevice($token)
    {
        return ClientToken::where('token', $token)->first()->device ;
    }

    public function getClientToken($token)
    {
        return ClientToken::where('token', $token)->first() ;
    }

    public function checkForValidToken()
    {

    }

    public function generateNewToken($id)
    {
        // Hash::make($request->newPassword)
        $token =  ClientToken::create([
            'device_id' => $id,
            'token' => $this->generateUniqueToken($id),
        ]);
        return $token->token;
    }

    public function revokeExistingToken()
    {

    }

    private function findById($id)
    {
        return $this->deviceModel->find($id);
    }

    private function generateUniqueToken($id)
    {
        do {
            $token = $this->getToken(6, $id);
            $code = Hash::make('EN'. $token . substr(strftime("%Y", time()),2));
            $newToken = ClientToken::where('token', $code)->get();
        } while (! $newToken->isEmpty());

        return $code;
    }

    private function getToken($length, $seed)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        mt_srand($seed);      // Call once. Good since $application_id is unique.

        for ($i=0;$i<$length;$i++) {
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }

        return $token;
    }
}

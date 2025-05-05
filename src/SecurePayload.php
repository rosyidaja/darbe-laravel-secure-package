<?php

namespace Darbe\SecurePayload;

use App\Models\Client;

class SecurePayload
{
    public static function encrypt(array $data, string $clientId): ?string
    {
        $client = Client::where('client_id', $clientId)->first();
        if (!$client) return null;

        $cipher = new SecureJsonCipher($client->secret_key);
        return $cipher->encrypt($data);
    }

    public static function decrypt(string $payload, string $clientId): ?array
    {
        $client = Client::where('client_id', $clientId)->first();
        if (!$client) return null;

        $cipher = new SecureJsonCipher($client->secret_key);
        return $cipher->decrypt($payload);
    }
}

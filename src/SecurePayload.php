<?php

namespace Darbe\SecurePayload;

class SecurePayload
{
    public static function encrypt(array $data, string $clientId, string $secretKey): ?string
    {
        $cipher = new SecureJsonCipher($secretKey, $clientId);
        return $cipher->encrypt($data);
    }

    public static function decrypt(string $payload, string $clientId, string $secretKey): ?array
    {
        $cipher = new SecureJsonCipher($client->secret_key, $clientId);
        return $cipher->decrypt($payload);
    }
}

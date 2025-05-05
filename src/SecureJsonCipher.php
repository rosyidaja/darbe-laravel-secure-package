<?php

namespace Darbe\SecurePayload;

class SecureJsonCipher
{
    const CIPHER = 'AES-256-CBC';
    const TIME_DIFF_LIMIT = 480;

    private $key;
    private $iv;

    public function __construct(string $secretKey)
    {
        $this->key = hash('sha256', $secretKey, true);
        $this->iv = substr($this->key, 0, 16);
    }

    public function encrypt(array $data): string
    {
        $payload = ['ts' => time(), 'data' => $data];
        $json = json_encode($payload);
        $encrypted = openssl_encrypt($json, self::CIPHER, $this->key, OPENSSL_RAW_DATA, $this->iv);
        return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
    }

    public function decrypt(string $encrypted): ?array
    {
        $data = base64_decode(strtr($encrypted, '-_', '+/'));
        $json = openssl_decrypt($data, self::CIPHER, $this->key, OPENSSL_RAW_DATA, $this->iv);
        if (!$json) return null;

        $payload = json_decode($json, true);
        if (!isset($payload['ts'], $payload['data'])) return null;

        if (abs(time() - $payload['ts']) > self::TIME_DIFF_LIMIT) {
            return null;
        }

        return $payload['data'];
    }
}

# Laravel Secure Payload

🔐 A Laravel package for secure encryption and decryption of data using `client_id` and `secret_key`.

## Features

- AES-256-CBC encryption
- Timestamp validation (anti-replay)
- Works with multiple clients from database
- Laravel 6+ compatible
- No middleware — manually use in controllers

## Installation

### 1. Require the package (local or private repo)

```bash
composer require darbe/laravel-secure-payload
```

If you're using a local path repository, add this to your `composer.json`:

```json
"repositories": [
  {
    "type": "path",
    "url": "packages/darbe/laravel-secure-payload"
  }
]
```

### 2. Add `client_id` and `secret_key` to your `clients` table

## Usage

### Encrypt data

```php
use SecurePayload;

$payload = ['user_id' => 1, 'role' => 'admin'];
$encrypted = SecurePayload::encrypt($payload, 'app1');
```

### Decrypt data

```php
use SecurePayload;

$decrypted = SecurePayload::decrypt($encrypted, 'app1');
```

## Compatibility

- Laravel 6.x+
- PHP >= 7.2

## License

MIT © Darbe Group

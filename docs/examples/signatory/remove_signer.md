```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Signatory\RemoveSignatoryFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $fields = new RemoveSignatoryFields('email@email.com', '{key_signer}');

    $signatory = $d4sign->signatories()->removeSignatory('uuid-document', $fields);

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`key_signer`

Código é encontrado listando os signatários de um documento.

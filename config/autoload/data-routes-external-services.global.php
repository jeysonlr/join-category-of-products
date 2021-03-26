<?php

declare(strict_types=1);

use Infrastructure\Util\Enum\ExternalServices;

return [
    'data-routes-external-services' => [
        # HOME
        'registers.get_all_categorys' => [ExternalServices::DATABASE],
    ]
];

<?php

declare(strict_types=1);

use Infrastructure\Util\Enum\ExternalServices;

return [
    'data-routes-external-services' => [

        'registers.post_categorys' => [ExternalServices::DATABASE],
        'registers.get_all_categorys' => [ExternalServices::DATABASE],
        'registers.get_by_id_categorys' => [ExternalServices::DATABASE],
        'registers.put_by_id_categorys' => [ExternalServices::DATABASE],

        'registers.post_products' => [ExternalServices::DATABASE],
        'registers.get_all_products' => [ExternalServices::DATABASE],
        'registers.get_by_id_products' => [ExternalServices::DATABASE],
        'registers.put_by_id_products' => [ExternalServices::DATABASE],
        'registers.delete_by_id_products' => [ExternalServices::DATABASE],
    ]
];

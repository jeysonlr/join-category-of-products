<?php

declare(strict_types=1);

return [
    'sentry-options' => [
        'dsn' => 'https://f5251a84446042c59490bcbfd2f83b88@sentry.gazin.com.br/27',
        'attach_stacktrace' => false,
        'capture_silenced_errors' => true,
        'context_lines' => 8,
        'environment' => 'production',
        'default_integrations' => true,
        'enable_compression' => true,
        'error_types' => 6143,
        'in_app_exclude' => [
            'api-marketplace/vendor/'
        ],
        'logger' => 'php',
        'max_breadcrumbs' => 50,
        'max_value_length' => 2048,
        'prefixes' => [
            '/local_dir/'
        ],
        'sample_rate' => 1,
        'send_attempts' => 4,
        'send_default_pii' => true,
    ]
];

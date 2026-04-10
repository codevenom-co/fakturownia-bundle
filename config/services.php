<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->bind('$baseUrl', param('codevenom_fakturownia.base_url'))
        ->bind('$apiToken', param('codevenom_fakturownia.api_token'))
        ->bind('$timeout', param('codevenom_fakturownia.timeout'));

    $services->load('Codevenom\\FakturowniaBundle\\', __DIR__.'/../src/')
        ->exclude([
            __DIR__.'/../src/DependencyInjection/',
            __DIR__.'/../src/CodevenomFakturowniaBundle.php',
        ]);
};

<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;
use Codevenom\FakturowniaBundle\Application\FakturowniaService;
use Codevenom\FakturowniaBundle\Domain\Contract\FakturowniaInterface;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Domain\Event\DomainEventDispatcherInterface;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Adapter\FakturowniaGatewayAdapter;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Event\InMemoryDomainEventDispatcher;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Http\FakturowniaClientInterface;
use Codevenom\FakturowniaBundle\Http\FakturowniaClient;

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

    $services->alias(FakturowniaInterface::class, FakturowniaService::class);
    $services->alias(FakturowniaGatewayInterface::class, FakturowniaGatewayAdapter::class);
    $services->alias(FakturowniaClientInterface::class, FakturowniaClient::class);
    $services->alias(DomainEventDispatcherInterface::class, InMemoryDomainEventDispatcher::class);
};

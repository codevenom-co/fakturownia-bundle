<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Event;

use Codevenom\FakturowniaBundle\Domain\Event\DomainEvent;
use Codevenom\FakturowniaBundle\Domain\Event\DomainEventDispatcherInterface;

final class InMemoryDomainEventDispatcher implements DomainEventDispatcherInterface
{
    private array $events = [];

    public function dispatch(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    public function events(): array
    {
        return $this->events;
    }
}

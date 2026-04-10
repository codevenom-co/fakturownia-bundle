<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Event;

interface DomainEventDispatcherInterface
{
    public function dispatch(DomainEvent $event): void;
}

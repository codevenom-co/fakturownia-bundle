<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Integration\Infrastructure\FakturowniaApi\Http;

use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Http\FakturowniaClientInterface;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[Group('integration')]
final class FakturowniaClientIntegrationTest extends KernelTestCase
{
    private ?FakturowniaClientInterface $client = null;

    protected function setUp(): void
    {
        // Skip unless the environment is configured for real API calls
        // Adjust variable names to whatever your bundle uses for config/parameters.
        if (!getenv('FAKTUROWNIA_API_TOKEN')) {
            self::markTestSkipped('Integration test skipped: missing env FAKTUROWNIA_API_TOKEN.');
        }

        self::bootKernel();

        $container = self::getContainer();
        $this->client = $container->get(FakturowniaClientInterface::class);
    }

    public function testRealApiListInvoices(): void
    {
        $result = $this->client->listInvoices(['per_page' => 1]);

        $this->assertIsArray($result);
    }
}
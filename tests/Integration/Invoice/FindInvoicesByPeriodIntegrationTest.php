<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Integration\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\InvoiceManagerInterface;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[Group('integration')]
final class FindInvoicesByPeriodIntegrationTest extends KernelTestCase
{
    private ?InvoiceManagerInterface $invoiceManager = null;

    protected function setUp(): void
    {
        if (!getenv('FAKTUROWNIA_API_TOKEN')) {
            self::markTestSkipped('Integration test skipped: missing env FAKTUROWNIA_API_TOKEN.');
        }

        self::bootKernel();

        $this->invoiceManager = self::getContainer()->get(InvoiceManagerInterface::class);
    }

    public function testItRetrievesInvoicesForProvidedPeriod(): void
    {
        $result = $this->invoiceManager->findByPeriod(
            period: InvoicePeriod::LAST_MONTH,
            page: 1,
            perPage: 5,
            income: true,
        );

        self::assertIsArray($result);

        foreach ($result as $item) {
            self::assertInstanceOf(Invoice::class, $item);
        }
    }
}

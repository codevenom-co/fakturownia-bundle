<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Integration\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\InvoiceManagerInterface;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Tests\Util\Trait\FakturowniaTestCredentialsTrait;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[Group('integration')]
final class FindInvoicesByPeriodIntegrationTest extends KernelTestCase
{

    use FakturowniaTestCredentialsTrait;

    private ?InvoiceManagerInterface $invoiceManager = null;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->verifyTestCredentials();

        self::bootKernel();

        $this->invoiceManager = self::getContainer()->get(InvoiceManagerInterface::class);
    }

    public function testItRetrievesInvoicesForProvidedPeriod(): void
    {
        $result = $this->invoiceManager->findByPeriod(
            period: InvoicePeriod::THIS_YEAR,
            page: 1,
            perPage: 5,
            income: true,
        );

        self::assertIsArray($result);

        foreach ($result as $item) {
            self::assertInstanceOf(Invoice::class, $item);
            self::assertEquals($item->getSellerName(), $this->getSellerName());
            self::assertEquals($item->getSellerTaxNo(), $this->getSellerTaxId());
        }
    }
}

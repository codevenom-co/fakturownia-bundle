<?php

namespace Codevenom\FakturowniaBundle\Tests\Integration\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoiceKind;
use Codevenom\FakturowniaBundle\Invoice\InvoiceManagerInterface;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\InvoicePosition;
use Codevenom\FakturowniaBundle\Tests\Util\Trait\FakturowniaTestCredentialsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateInvoiceIntegrationTest extends KernelTestCase
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

    public function testCreateVatInvoice(): void
    {
        $result = $this->invoiceManager->createInvoice(
            request: new CreateInvoice(
                kind: InvoiceKind::VAT->value,
                number: null,
                sellDate: (new \DateTimeImmutable('today'))->format('Y-m-d'),
                issueDate: (new \DateTimeImmutable('today'))->format('Y-m-d'),
                paymentTo: (new \DateTimeImmutable('today'))->format('Y-m-d'),
                buyerName: 'Test Buyer',
                buyerTaxNo: '5242971503',
                buyerPostCode: '12-345',
                buyerCity: 'Test City',
                buyerStreet: 'Test Street',
                positions: [
                    new InvoicePosition(
                        name: 'Test Item 1',
                        tax: 23,
                        totalPriceGross: 100.00,
                        quantity: 2,
                    ),
                    new InvoicePosition(
                        name: 'Test Item 2',
                        tax: 23,
                        totalPriceGross: 50.00,
                        quantity: 1,
                    ),
                ],
            )
        );

        self::assertNotNull($result->getNumber());
        self::assertEquals($result->getSellerName(), $this->getSellerName());
        self::assertEquals($result->getSellerTaxNo(), $this->getSellerTaxId());
    }
}
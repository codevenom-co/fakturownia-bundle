<?php

namespace Codevenom\FakturowniaBundle\Tests\Util\Trait;

trait FakturowniaTestCredentialsTrait
{
    /**
     * @return void
     * @throws \Exception
     */
    protected function verifyTestCredentials(): void
    {
        if (!getenv('FAKTUROWNIA_SELLER_NAME')) {
            throw new \Exception('Integration test skipped: missing env FAKTUROWNIA_SELLER_NAME.');
        }

        if (!getenv('FAKTUROWNIA_SELLER_TAX_ID')) {
            throw new \Exception('Integration test skipped: missing env FAKTUROWNIA_SELLER_TAX_ID.');
        }

        if (!getenv('FAKTUROWNIA_API_TOKEN')) {
            throw new \Exception('Integration test skipped: missing env FAKTUROWNIA_API_TOKEN.');
        }
    }

    protected function getSellerName(): string
    {
        return getenv('FAKTUROWNIA_SELLER_NAME');
    }

    protected function getSellerTaxId(): string
    {
        return getenv('FAKTUROWNIA_SELLER_TAX_ID');
    }

    protected function getApiToken(): string
    {
        return getenv('FAKTUROWNIA_API_TOKEN');
    }
}
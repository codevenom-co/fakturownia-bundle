<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Pricing\Mapper\PriceListPayloadMapper;
use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;
use Codevenom\FakturowniaBundle\Pricing\Model\UpdatePriceList;
use Codevenom\FakturowniaBundle\Exception\FakturowniaClientException;
use Symfony\Component\HttpFoundation\Response;

class PricingClient extends AbstractFakturowniaClient implements FakturowniaPricingClientInterface
{
    public function __construct(
        string $baseUrl,
        string $apiToken,
        int $timeout,
        private readonly PriceListPayloadMapper $priceListPayloadMapper,
    ) {
        parent::__construct(
            baseUrl: $baseUrl,
            apiToken: $apiToken,
            timeout: $timeout
        );
    }

    public function listPriceLists(array $query): array
    {
        $response = $this->get('/price_lists.json', query: $query);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to list price lists: %s',
                $response->getContent(false)
            ));
        }

        return array_map(
            fn(array $data): PriceList => $this->priceListPayloadMapper->toModel($data),
            $response->toArray()
        );
    }

    public function findById(int $id): PriceList
    {
        $response = $this->get(sprintf('/price_lists/%s.json', $id));

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to find price list with ID %d: %s',
                $id,
                $response->getContent(false)
            ));
        }

        return $this->priceListPayloadMapper->toModel($response->toArray());
    }

    public function create(PriceList $priceList): PriceList
    {
        $response = $this->post('/price_lists.json', [
            'price_list' => $this->priceListPayloadMapper->toPayload($priceList),
        ]);

        if ($response->getStatusCode() !== Response::HTTP_CREATED && $response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to create price list: %s',
                $response->getContent(false)
            ));
        }

        return $this->priceListPayloadMapper->toModel($response->toArray());
    }

    public function update(PriceList $priceList): PriceList
    {
        if (null === $priceList->getId()) {
            throw new FakturowniaClientException('Cannot update price list without ID');
        }

        $updateModel = new UpdatePriceList();
        $payload = $this->priceListPayloadMapper->toPayload($priceList);
        $this->priceListPayloadMapper->toModel($payload, $updateModel, UpdatePriceList::class);

        $response = $this->put(sprintf('/price_lists/%s.json', $priceList->getId()), [
            'price_list' => $this->priceListPayloadMapper->toPayload($updateModel),
        ]);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to update price list with ID %d: %s',
                $priceList->getId(),
                $response->getContent(false)
            ));
        }

        return $this->priceListPayloadMapper->toModel($response->toArray());
    }

    public function deletePriceList(int $id): void
    {
        $response = parent::delete(sprintf('/price_lists/%s.json', $id));

        if ($response->getStatusCode() !== Response::HTTP_OK && $response->getStatusCode() !== Response::HTTP_NO_CONTENT) {
            throw new FakturowniaClientException(sprintf(
                'Failed to delete price list with ID %d: %s',
                $id,
                $response->getContent(false)
            ));
        }
    }
}

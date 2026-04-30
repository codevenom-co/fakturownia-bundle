<?php

namespace Codevenom\FakturowniaBundle\Invoice\Dto;

final class InvoiceFilter
{
    public function __construct(
        public readonly ?string $dateFrom = null,
        public readonly ?string $dateTo = null,
        public readonly ?string $searchDateType = null,
        public readonly ?bool $includePositions = null,
        public readonly ?string $income = null,
        public readonly ?int $clientId = null,
        public readonly ?string $kind = null,
        /** @var string[]|null */
        public readonly ?array $kinds = null,
        /** @var int[]|null */
        public readonly ?array $invoiceIds = null,
        public readonly ?string $number = null,
        public readonly ?string $order = null,
    ) {
    }

    /**
     * @return array{
     *     date_from?: string,
     *     date_to?: string,
     *     search_date_type?: string,
     *     include_positions?: bool,
     *     income?: string,
     *     client_id?: int,
     *     kind?: string,
     *     kinds?: string[],
     *     invoice_ids?: int[],
     *     number?: string,
     *     order?: string,
     * }
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->dateFrom !== null) {
            $data['date_from'] = $this->dateFrom;
        }
        if ($this->dateTo !== null) {
            $data['date_to'] = $this->dateTo;
        }
        if ($this->searchDateType !== null) {
            $data['search_date_type'] = $this->searchDateType;
        }
        if ($this->includePositions !== null) {
            $data['include_positions'] = $this->includePositions;
        }
        if ($this->income !== null) {
            $data['income'] = $this->income;
        }
        if ($this->clientId !== null) {
            $data['client_id'] = $this->clientId;
        }
        if ($this->kind !== null) {
            $data['kind'] = $this->kind;
        }
        if ($this->kinds !== null) {
            $data['kinds'] = $this->kinds;
        }
        if ($this->invoiceIds !== null) {
            $data['invoice_ids'] = $this->invoiceIds;
        }
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        if ($this->order !== null) {
            $data['order'] = $this->order;
        }

        return $data;
    }
}

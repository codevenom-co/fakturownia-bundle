<?php

namespace Codevenom\FakturowniaBundle\Report\Dto;

final readonly class ReportsFilter
{
    public function __construct(
        public ?string $dateFrom = null,
        public ?string $dateTo = null,
        public ?string $searchDateType = null,
        public ?bool $includePositions = null,
        public ?string $income = null,
        public ?int $clientId = null,
        public ?string $kind = null,
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

        return $data;
    }
}

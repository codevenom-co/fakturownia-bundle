<?php

namespace Codevenom\FakturowniaBundle\Report\Model;

final class ReportOutput
{
    /**
     * @param array{
     *     report_name: string,
     *     generated_at: string,
     *     data_freshness: string,
     *     warnings: string[]
     * } $meta
     * @param array{
     *     basis: string,
     *     metric_definitions: array<string, string>,
     *     assumptions: string[]
     * } $definitions
     * @param array<int, array{
     *     name: string,
     *     value: mixed,
     *     unit: string,
     *     change_vs_compare?: mixed,
     *     explanation?: string
     * }> $kpis
     * @param array<int, array{
     *     name: string,
     *     columns: string[],
     *     rows: array<int, array<string, mixed>>
     * }> $tables
     * @param array<int, array{
     *     name: string,
     *     grain: string,
     *     points: array<int, array<string, mixed>>
     * }> $timeseries
     * @param string[] $insights
     */
    public function __construct(
        public readonly array $meta,
        public readonly array $definitions,
        public readonly array $kpis = [],
        public readonly array $tables = [],
        public readonly array $timeseries = [],
        public readonly array $insights = [],
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'meta' => $this->meta,
            'definitions' => $this->definitions,
            'kpis' => $this->kpis,
            'tables' => $this->tables,
            'timeseries' => $this->timeseries,
            'insights' => $this->insights,
        ];
    }
}

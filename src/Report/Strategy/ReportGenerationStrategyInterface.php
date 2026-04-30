<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;

interface ReportGenerationStrategyInterface
{
    public function getName(): string;

    public function supports(string $reportName): bool;

    public function generate(ReportInput $input): ReportOutput;
}

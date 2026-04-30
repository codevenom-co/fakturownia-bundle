<?php

namespace Codevenom\FakturowniaBundle\Report;

use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;

interface FakturowniaReportManagerInterface
{
    public function generateReport(ReportInput $input): ReportOutput;
}
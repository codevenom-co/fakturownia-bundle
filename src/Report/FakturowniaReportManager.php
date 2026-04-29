<?php

namespace Codevenom\FakturowniaBundle\Report;

use Codevenom\FakturowniaBundle\Report\Strategy\ReportGenerationStrategyInterface;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class FakturowniaReportManager implements FakturowniaReportManagerInterface
{
    /**
     * @param iterable<ReportGenerationStrategyInterface> $reportDefinitions
     */
    public function __construct(
        #[TaggedIterator('fakturownia.report_definition')]
        private iterable $reportDefinitions,
    )
    {
    }

    public function generateReport(ReportInput $input): ReportOutput
    {
        foreach ($this->reportDefinitions as $definition) {
            if ($definition->supports($input->reportName)) {
                return $definition->generate($input);
            }
        }

        throw new \InvalidArgumentException(sprintf('Report "%s" not found.', $input->reportName));
    }
}
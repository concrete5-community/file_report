<?php

namespace A3020\FileReport\View\Chart\Files;

use A3020\FileReport\Statistics\Files\FilesByType;
use A3020\FileReport\Statistics\Files\Result\FilesByExtensionResult;
use A3020\FileReport\Statistics\Files\Result\FilesByTypeResult;
use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class FilesByTypeChart implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $pieChunks = 5;

    public function view()
    {
        $view = new View('chart/files/files_by_type');
        $view->setPackageHandle('file_report');

        $results = $this->app->make(FilesByType::class)->get();

        $view->addScopeItems([
            'results' => $results,
            'labels' => $this->getLabels($results),
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param FilesByTypeResult[] $fileTypeResults
     *
     * @return array
     */
    private function getLabels(array $fileTypeResults)
    {
        $types = [];
        foreach (array_slice($fileTypeResults, 0, $this->pieChunks - 1) as $fileTypeResult) {
            $types[] = $fileTypeResult->getType();
        }

        if (count($fileTypeResults) > $this->pieChunks - 1) {
            $types[] = t('other');
        }

        return $types;
    }

    /**
     * @param FilesByExtensionResult[] $fileTypeResults
     *
     * @return array
     */
    private function getData(array $fileTypeResults)
    {
        $data = [];
        foreach (array_slice($fileTypeResults, 0, $this->pieChunks - 1) as $fileTypeResult) {
            $data[] = $fileTypeResult->getNumberOfFiles();
        }

        if (count($fileTypeResults) > $this->pieChunks - 1) {
            $remainingResults = array_slice($fileTypeResults, $this->pieChunks - 1);
            $files = 0;
            foreach ($remainingResults as $result) {
                $files += $result->getNumberOfFiles();
            }
            $data[] = $files;
        }

        return $data;
    }
}

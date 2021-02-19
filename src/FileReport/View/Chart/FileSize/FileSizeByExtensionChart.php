<?php

namespace A3020\FileReport\View\Chart\FileSize;

use A3020\FileReport\Statistics\FileSize\FileSizeByExtension;
use A3020\FileReport\Statistics\FileSize\Result\FileSizeByExtensionResult;
use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class FileSizeByExtensionChart implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $pieChunks = 6;

    public function view()
    {
        $view = new View('chart/file_size/file_size_by_extension');
        $view->setPackageHandle('file_report');

        $results = $this->app->make(FileSizeByExtension::class)->get();

        $view->addScopeItems([
            'results' => $results,
            'labels' => $this->getLabels($results),
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param FileSizeByExtensionResult[] $fileTypeResults
     *
     * @return array
     */
    private function getLabels(array $fileTypeResults)
    {
        $extensions = [];
        foreach (array_slice($fileTypeResults, 0, $this->pieChunks - 1) as $fileTypeResult) {
            $extensions[] = $fileTypeResult->getExtension();
        }

        if (count($fileTypeResults) > $this->pieChunks - 1) {
            $extensions[] = t('other');
        }

        return $extensions;
    }

    /**
     * @param FileSizeByExtensionResult[] $results
     *
     * @return array
     */
    private function getData(array $results)
    {
        $data = [];
        foreach (array_slice($results, 0, $this->pieChunks - 1) as $result) {
            $data[] = round($result->getFileSize() / 1024 / 1024, 2);
        }

        if (count($results) > $this->pieChunks - 1) {
            $remainingResults = array_slice($results, $this->pieChunks - 1);
            $remainingSize = 0;
            foreach ($remainingResults as $result) {
                $remainingSize += $result->getFileSize();
            }
            $data[] = round($remainingSize / 1024 / 1024, 2);
        }

        return $data;
    }
}

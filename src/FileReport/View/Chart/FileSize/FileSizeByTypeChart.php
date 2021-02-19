<?php

namespace A3020\FileReport\View\Chart\FileSize;

use A3020\FileReport\Statistics\FileSize\FileSizeByType;
use A3020\FileReport\Statistics\FileSize\Result\FileSizeByTypeResult;
use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class FileSizeByTypeChart implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $pieChunks = 5;

    public function view()
    {
        $view = new View('chart/file_size/file_size_by_type');
        $view->setPackageHandle('file_report');

        $results = $this->app->make(FileSizeByType::class)->get();

        $view->addScopeItems([
            'results' => $results,
            'labels' => $this->getLabels($results),
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param FileSizeByTypeResult[] $results
     *
     * @return array
     */
    private function getLabels(array $results)
    {
        $types = [];
        foreach (array_slice($results, 0, $this->pieChunks - 1) as $result) {
            $types[] = $result->getType();
        }

        if (count($results) > $this->pieChunks - 1) {
            $types[] = t('other');
        }

        return $types;
    }

    /**
     * @param FileSizeByTypeResult[] $results
     *
     * @return array
     */
    private function getData(array $results)
    {
        $data = [];
        foreach (array_slice($results, 0, $this->pieChunks - 1) as $fileTypeResult) {
            $data[] = round($fileTypeResult->getFileSize() / 1024 / 1024, 2);
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

<?php

namespace A3020\FileReport\View\Chart\FileSize;

use A3020\FileReport\Statistics\FileSize\FileSizeByAuthor;
use A3020\FileReport\Statistics\FileSize\Result\FileSizeByAuthorResult;
use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class FileSizeByAuthorChart implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $pieChunks = 5;

    public function view()
    {
        $view = new View('chart/file_size/file_size_by_author');
        $view->setPackageHandle('file_report');

        $results = $this->app->make(FileSizeByAuthor::class)->get();

        $view->addScopeItems([
            'results' => $results,
            'labels' => $this->getLabels($results),
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param FileSizeByAuthorResult[] $results
     *
     * @return array
     */
    private function getLabels(array $results)
    {
        $authors = [];
        foreach (array_slice($results, 0, $this->pieChunks - 1) as $result) {
            $authors[] = $result->getAuthor();
        }

        if (count($results) > $this->pieChunks - 1) {
            $authors[] = t('others');
        }

        return $authors;
    }

    /**
     * @param FileSizeByAuthorResult[] $results
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
            $data[] = round($remainingSize  / 1024 / 1024, 2);
        }

        return $data;
    }
}

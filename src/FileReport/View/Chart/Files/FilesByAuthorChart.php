<?php

namespace A3020\FileReport\View\Chart\Files;

use A3020\FileReport\Statistics\Files\FilesByAuthor;
use A3020\FileReport\Statistics\Files\Result\FilesByAuthorResult;
use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class FilesByAuthorChart implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    protected $pieChunks = 5;

    public function view()
    {
        $view = new View('chart/files/files_by_author');
        $view->setPackageHandle('file_report');

        $results = $this->app->make(FilesByAuthor::class)->get();

        $view->addScopeItems([
            'results' => $results,
            'labels' => $this->getLabels($results),
            'data' => $this->getData($results),
        ]);

        return $view->render();
    }

    /**
     * @param FilesByAuthorResult[] $results
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
     * @param FilesByAuthorResult[] $results
     *
     * @return array
     */
    private function getData(array $results)
    {
        $data = [];
        foreach (array_slice($results, 0, $this->pieChunks - 1) as $result) {
            $data[] = $result->getNumberOfFiles();
        }

        if (count($results) > $this->pieChunks - 1) {
            $remainingResults = array_slice($results, $this->pieChunks - 1);
            $files = 0;
            foreach ($remainingResults as $result) {
                $files += $result->getNumberOfFiles();
            }
            $data[] = $files;
        }

        return $data;
    }
}

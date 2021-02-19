<?php

namespace A3020\FileReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class MostDownloadedFiles implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('most_downloaded');
        $view->setPackageHandle('file_report');

        $view->addScopeItems([
            'results' => $this->getResults(),
        ]);

        return $view->render();
    }

    private function getResults()
    {
        return $this->app->make(\A3020\FileReport\Statistics\MostDownloadedFiles::class)->get();
    }
}

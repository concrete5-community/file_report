<?php

namespace A3020\FileReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class FileSetFiles implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('file_set_files');
        $view->setPackageHandle('file_report');

        $view->addScopeItems([
            'results' => $this->getResults(),
            'numberService' => $this->app->make('helper/number'),
            'urlManager' => $this->app->make('url/manager'),
        ]);

        return $view->render();
    }

    private function getResults()
    {
        return $this->app->make(\A3020\FileReport\Statistics\FileSetFiles::class)->get();
    }
}

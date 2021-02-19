<?php

namespace A3020\FileReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class BiggestFiles implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('biggest_files');
        $view->setPackageHandle('file_report');

        $view->addScopeItems([
            'numberService' => $this->app->make('helper/number'),
            'files' => $this->getFiles(),
        ]);

        return $view->render();
    }

    private function getFiles()
    {
        return $this->app->make(\A3020\FileReport\Statistics\BiggestFiles::class)->get();
    }
}

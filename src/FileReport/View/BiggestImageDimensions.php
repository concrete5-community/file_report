<?php

namespace A3020\FileReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\View\View;

class BiggestImageDimensions implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function view()
    {
        $view = new View('biggest_image_dimensions');
        $view->setPackageHandle('file_report');

        $view->addScopeItems([
            'files' => $this->getFiles(),
        ]);

        return $view->render();
    }

    private function getFiles()
    {
        return $this->app->make(\A3020\FileReport\Statistics\BiggestImageDimensions::class)->get();
    }
}

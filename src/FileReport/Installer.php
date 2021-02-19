<?php

namespace A3020\FileReport;

use Concrete\Core\Entity\Package;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single;

class Installer
{
    public function install($pkg)
    {
        $this->singlePages($pkg);
    }

    private function singlePages(Package $pkg)
    {
        $pages = [
            '/dashboard/files/file_report',
        ];

        // Using for loop because additional pages
        // may be added in the future.
        foreach ($pages as $path) {
            /** @var Page $page */
            $page = Page::getByPath($path);
            if ($page && !$page->isError()) {
                return;
            }

            $singlePage = Single::add($path, $pkg);
            $singlePage->update($pkg->getPackageName());
        }
    }
}

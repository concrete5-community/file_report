<?php

namespace Concrete\Package\FileReport;

use A3020\FileReport\Installer;
use Concrete\Core\Package\Package;
use Concrete\Core\Support\Facade\Package as PackageFacade;

/**
 * @copyright A3020
 * @see https://a3020.com
 */
class Controller extends Package
{
    protected $pkgHandle = 'file_report';
    protected $appVersionRequired = '8.0.0';
    protected $pkgVersion = '1.0.2';
    protected $pkgAutoloaderRegistries = [
        'src/FileReport' => '\A3020\FileReport',
    ];

    public function getPackageName()
    {
        return t('File Report');
    }

    public function getPackageDescription()
    {
        return t('Display file related statistics.');
    }

    public function install()
    {
        $pkg = parent::install();

        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();

        $pkg = PackageFacade::getByHandle($this->pkgHandle);

        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }
}

<?php

namespace Concrete\Package\FileReport\Controller\SinglePage\Dashboard\Files;

use A3020\FileReport\View\BiggestFiles;
use A3020\FileReport\View\BiggestImageDimensions;
use A3020\FileReport\View\Chart\Files\FilesByAuthorChart;
use A3020\FileReport\View\Chart\Files\FilesByExtensionChart;
use A3020\FileReport\View\Chart\Files\FilesByTypeChart;
use A3020\FileReport\View\Chart\FileSize\FileSizeByAuthorChart;
use A3020\FileReport\View\Chart\FileSize\FileSizeByExtensionChart;
use A3020\FileReport\View\Chart\FileSize\FileSizeByTypeChart;
use A3020\FileReport\View\FileSetFiles;
use A3020\FileReport\View\GeneralStatistics;
use A3020\FileReport\View\MostDownloadedFiles;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Page\Controller\DashboardPageController;

final class FileReport extends DashboardPageController
{
    public function view()
    {
        // Charts
        $this->set('filesByExtensionChart', $this->app->make(FilesByExtensionChart::class)->view());
        $this->set('filesByTypeChart', $this->app->make(FilesByTypeChart::class)->view());
        $this->set('filesByAuthorChart', $this->app->make(FilesByAuthorChart::class)->view());
        $this->set('fileSizeByExtensionChart', $this->app->make(FileSizeByExtensionChart::class)->view());
        $this->set('fileSizeByTypeChart', $this->app->make(FileSizeByTypeChart::class)->view());
        $this->set('fileSizeByAuthorChart', $this->app->make(FileSizeByAuthorChart::class)->view());

        // Other statistics
        $this->set('generalStatistics', $this->app->make(GeneralStatistics::class)->view());
        $this->set('biggestFiles', $this->app->make(BiggestFiles::class)->view());
        $this->set('biggestImageDimensions', $this->app->make(BiggestImageDimensions::class)->view());
        $this->set('fileSetFiles', $this->app->make(FileSetFiles::class)->view());
        $this->set('mostDownloadedFiles', $this->app->make(MostDownloadedFiles::class)->view());
    }

    public function on_before_render()
    {
        parent::on_before_render();

        $al = AssetList::getInstance();

        $al->register('javascript', 'file_report/chart', 'js/Chart.bundle.min.js', [], 'file_report');
        $al->register('javascript', 'file_report/chart_piece_label', 'js/Chart.PieceLabel.min.js', [], 'file_report');
        $al->register('javascript', 'file_report/datatables', 'js/datatables.min.js', [], 'file_report');
        $this->requireAsset('javascript', 'file_report/chart');
        $this->requireAsset('javascript', 'file_report/chart_piece_label');
        $this->requireAsset('javascript', 'file_report/datatables');

        $al->register('css', 'file_report/summary', 'css/summary.css', [], 'file_report');
        $al->register('css', 'file_report/datatables', 'css/datatables.css', [], 'file_report');
        $this->requireAsset('css', 'file_report/summary');
        $this->requireAsset('css', 'file_report/datatables');
    }
}

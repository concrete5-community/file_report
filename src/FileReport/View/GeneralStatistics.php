<?php

namespace A3020\FileReport\View;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\File\FileList;
use Concrete\Core\View\View;

class GeneralStatistics implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    /** @var Connection */
    private $db;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function view()
    {
        $view = new View('general_statistics');
        $view->setPackageHandle('file_report');

        $view->addScopeItems([
            'totalNumberOfFiles' => $this->getTotalNumberOfFiles(),
            'totalFileSize' => $this->getTotalFileSize(),
            'numberService' => $this->app->make('helper/number'),
        ]);

        return $view->render();
    }

    /**
     * Total number of files
     *
     * @return int
     */
    private function getTotalNumberOfFiles()
    {
        $pl = new FileList();
        $pl->ignorePermissions();

        return (int) $pl->getTotalResults();
    }

    /**
     * Total size of all files
     *
     * Sums up the file size of the latest version per file.
     *
     * @return int bytes
     */
    public function getTotalFileSize()
    {
        return (int) $this->db->fetchColumn('
            SELECT SUM(fv.fvSize) AS total_size FROM FileVersions fv
            INNER JOIN (
                SELECT fID, MAX(fvID) AS fvID FROM FileVersions
                GROUP BY fID
            ) AS tmp ON tmp.fvID = fv.fvID AND tmp.fID = fv.fID
        ');
    }
}

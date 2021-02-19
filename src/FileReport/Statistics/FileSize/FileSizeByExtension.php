<?php

namespace A3020\FileReport\Statistics\FileSize;

use A3020\FileReport\Statistics\FileSize\Result\FileSizeByExtensionResult;
use Concrete\Core\Database\Connection\Connection;

class FileSizeByExtension
{
    /** @var Connection */
    private $db;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function get()
    {
        $results = [];
        foreach ($this->getResults() as $result) {
            $results[] = new FileSizeByExtensionResult(
                $result['extension'],
                $result['fileSize']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT fvExtension as extension, SUM(fv.fvSize) as fileSize FROM FileVersions fv
            INNER JOIN (
               SELECT fID, MAX(fvID) AS fvID FROM FileVersions
               GROUP BY fID
            ) AS tmp ON tmp.fvID = fv.fvID AND tmp.fID = fv.fID
            WHERE fvIsApproved = 1
            GROUP BY fvExtension
            ORDER BY fileSize DESC
        ');
    }
}

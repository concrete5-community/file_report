<?php

namespace A3020\FileReport\Statistics\FileSize;

use A3020\FileReport\Statistics\FileSize\Result\FileSizeByTypeResult;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\File\Type\Type;

class FileSizeByType
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
            $results[] = new FileSizeByTypeResult(
                Type::getGenericTypeText($result['fvType']),
                $result['fileSize']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT fvType, SUM(fv.fvSize) as fileSize FROM FileVersions fv
            INNER JOIN (
               SELECT fID, MAX(fvID) AS fvID FROM FileVersions
               GROUP BY fID
            ) AS tmp ON tmp.fvID = fv.fvID AND tmp.fID = fv.fID
            WHERE fvIsApproved = 1
            GROUP BY fvType
            ORDER BY fileSize DESC
        ');
    }
}

<?php

namespace A3020\FileReport\Statistics\Files;

use A3020\FileReport\Statistics\Files\Result\FilesByExtensionResult;
use Concrete\Core\Database\Connection\Connection;

class FilesByExtension
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
            $results[] = new FilesByExtensionResult(
                $result['extension'],
                $result['numberOfFiles']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT fvExtension as extension, COUNT(1) as numberOfFiles FROM FileVersions fv
            INNER JOIN (
               SELECT fID, MAX(fvID) AS fvID FROM FileVersions
               GROUP BY fID
            ) AS tmp ON tmp.fvID = fv.fvID AND tmp.fID = fv.fID
            WHERE fvIsApproved = 1
            GROUP BY fvExtension
            ORDER BY numberOfFiles DESC
        ');
    }
}

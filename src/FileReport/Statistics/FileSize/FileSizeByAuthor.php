<?php

namespace A3020\FileReport\Statistics\FileSize;

use A3020\FileReport\Statistics\Files\Result\FilesByAuthorResult;
use A3020\FileReport\Statistics\FileSize\Result\FileSizeByAuthorResult;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\User\User;

class FileSizeByAuthor
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
            $user = User::getByUserID($result['author']);
            if (!$user) {
                continue;
            }

            $results[] = new FileSizeByAuthorResult(
                $user->getUserName(),
                $result['fileSize']
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT fvAuthorUID as author, SUM(fv.fvSize) as fileSize FROM FileVersions fv
            INNER JOIN (
               SELECT fID, MAX(fvID) AS fvID FROM FileVersions
               GROUP BY fID
            ) AS tmp ON tmp.fvID = fv.fvID AND tmp.fID = fv.fID
            WHERE fvIsApproved = 1
            GROUP BY fvAuthorUID
            ORDER BY fileSize DESC
        ');
    }
}

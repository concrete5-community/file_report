<?php

namespace A3020\FileReport\Statistics;

use A3020\FileReport\Result\FileSetFilesResult;
use Concrete\Core\Database\Connection\Connection;

class FileSetFiles
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

    /**
     * Get a list of file sets, the number of files, and their total size
     *
     * @return FileSetFilesResult[]
     */
    public function get()
    {
        $results = [];
        foreach ($this->getResults() as $result) {
            $results[] = new FileSetFilesResult(
                $result['fsID'],
                $result['name'],
                $result['numberOfFiles'],
                $this->getFileSetSize($result['fsID'])
            );
        }

        return $results;
    }

    private function getResults()
    {
        return $this->db->fetchAll('
            SELECT tmp.fsID, tmp.fsName as name, COUNT(tmp.fID) AS numberOfFiles FROM (
                SELECT fs.fsID, fs.fsName, fsf.fID FROM FileSetFiles AS fsf
                INNER JOIN FileSets AS fs ON fs.fsID = fsf.fsID
            ) AS tmp
            GROUP BY tmp.fsID
            ORDER BY numberOfFiles DESC, fsName DESC
        ');
    }

    private function getFileSetSize($fvId)
    {
        return (int) $this->db->fetchColumn('
            SELECT SUM(fvSize) as totalSize FROM FileSetFiles fsf
            INNER JOIN FileVersions AS fv ON fv.fID = fsf.fID
            WHERE fsID = ?;
        ', [
            $fvId,
        ]);
    }
}

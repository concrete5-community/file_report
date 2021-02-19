<?php

namespace A3020\FileReport\Statistics;

use A3020\FileReport\Result\FileDownloadResult;
use Concrete\Core\Database\Connection\Connection;

class MostDownloadedFiles
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
     * Get a list of the most downloaded files
     *
     * @param int $limit
     *
     * @return FileDownloadResult[]
     */
    public function get($limit = 200)
    {
        $results = [];
        foreach ($this->getResults($limit) as $result) {
            $results[] = new FileDownloadResult(
                $result['fileId'],
                $result['numberOfDownloads']
            );
        }

        return $results;
    }

    private function getResults($limit)
    {
        return $this->db->fetchAll('
            SELECT ds.fID as fileId, count(ds.fvID) AS numberOfDownloads FROM DownloadStatistics AS ds
            INNER JOIN FileVersions AS fv ON fv.fID = ds.fID
            GROUP BY ds.fID
            ORDER BY numberOfDownloads DESC
            LIMIT 0, '.(int) $limit
        );
    }
}

<?php

namespace A3020\FileReport\Statistics;

use A3020\FileReport\Result\BigFile;
use Concrete\Core\File\File;
use Concrete\Core\File\FileList;

class BiggestFiles
{
    /**
     * Get a list of the biggest files
     *
     * @param int $limit
     *
     * @return \Concrete\Core\Entity\File\File[]
     */
    public function get($limit = 200)
    {
        $fl = new FileList();
        $fl->sortBy('fvSize', 'desc');
        $fl->getQueryObject()->setMaxResults($limit);

        $results = [];
        foreach ($fl->executeGetResults() as $row) {
            /** @var \Concrete\Core\Entity\File\File $file */
            $file = File::getByID($row['fID']);
            if (!is_object($file)) {
                continue;
            }

            $results[] = new BigFile(
                $file->getFileID(),
                $file->getVersion()->getFullSize(),
                $file->getVersion()->getFileName()
            );
        }

        return $results;
    }
}

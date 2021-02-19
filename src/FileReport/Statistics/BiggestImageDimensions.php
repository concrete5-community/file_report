<?php

namespace A3020\FileReport\Statistics;

use A3020\FileReport\Result\BigImage;
use Concrete\Core\File\File;
use Concrete\Core\File\FileList;

class BiggestImageDimensions
{
    /**
     * Get a list of the biggest images (in dimensions)
     *
     * @param int $limit
     *
     * @return \A3020\FileReport\Result\BigImage[]
     */
    public function get($limit = 200)
    {
        $fl = new FileList();
        $fl->sortBy('ak_width', 'desc');
        $fl->filterByAttribute('width', 0, '>');
        $fl->getQueryObject()->setMaxResults($limit);

        $results = [];
        foreach ($fl->executeGetResults() as $result) {
            /** @var \Concrete\Core\Entity\File\File $file */
            $file = File::getByID($result['fID']);
            if (!is_object($file)) {
                continue;
            }

            $results[] = new BigImage(
                $file->getFileID(),
                $file->getVersion()->getAttribute('width'),
                $file->getVersion()->getAttribute('height'),
                $file->getVersion()->getFileName(),
                $file->getVersion()->getUrl()
            );
        }

        return $results;
    }
}

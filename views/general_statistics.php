<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var int $totalNumberOfFiles */
/** @var int $totalFileSize */
/** @var \Concrete\Core\Utility\Service\Number $numberService */
?>

<p>
    <?php
    echo t2('You have %s file taking up %s of disk space.', 'You have %s files taking up %s of disk space.',
        $totalNumberOfFiles,
        $numberService->formatSize($totalFileSize)
    );
    ?>
</p>

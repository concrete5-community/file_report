<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\FileReport\Result\FileSetFilesResult[] $results */
/** @var \Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface $urlManager */
/** @var \Concrete\Core\Utility\Service\Number $numberService */
?>

<table class="table" id="tbl-file-set-files">
    <thead>
        <tr>
            <th style="width: 140px;"># <?php echo t('Files') ?></th>
            <th style="width: 140px;"><?php echo t('File Size') ?></th>
            <th><?php echo t('File Set Name') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($results)) {
            foreach ($results as $result) {
                ?>
                <tr>
                    <td><?php echo $result->getNumberOfFiles(); ?></td>
                    <td><?php echo $numberService->formatSize($result->getSize()); ?></td>
                    <td>
                        <a href="<?php echo $urlManager->resolve(['/dashboard/files/sets/view_detail/'.$result->getId()]); ?>">
                            <?php echo e($result->getName()); ?>
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="3"><?php echo t('There are no file sets.'); ?></td></tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tbl-file-set-files').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        <?php echo count($results) > 10 ? '' : 'paging: false,'; ?>
        dom: 'rtp'
    });
})
</script>

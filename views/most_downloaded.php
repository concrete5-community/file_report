<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var A3020\FileReport\Result\FileDownloadResult[] $results */
?>

<table class="table" id="tbl-most-downloaded">
    <thead>
        <tr>
            <th style="width: 140px;"># <?php echo t('Downloads') ?></th>
            <th><?php echo t('File Name') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($results)) {
            foreach ($results as $result) {
                ?>
                <tr>
                    <td><?php echo $result->getNumberOfFiles(); ?></td>
                    <td>
                        <span class="help" title="<?php echo t('File ID: %d', $result->getFile()->getFileID()); ?>">
                            <?php echo e($result->getFile()->getVersion()->getFileName()); ?>
                        </span>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="3"><?php echo t('No files have been downloaded yet'); ?></td></tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tbl-most-downloaded').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        order: [],
        <?php echo count($results) > 10 ? '' : 'paging: false,'; ?>
        dom: 'rtp'
    });
})
</script>

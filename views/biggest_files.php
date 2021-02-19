<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \Concrete\Core\Utility\Service\Number $numberService */
/** @var \A3020\FileReport\Result\BigFile[] $files */
?>

<table class="table" id="tbl-biggest-files">
    <thead>
        <tr>
            <th style="width: 140px;"><?php echo t('File Size') ?></th>
            <th><?php echo t('File Name') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($files)) {
            foreach ($files as $file) {
                ?>
                <tr>
                    <td data-order="<?php echo $file->getSize() ?>"><?php echo $numberService->formatSize($file->getSize()); ?></td>
                    <td>
                        <span class="help" title="<?php echo t('File ID: %d', $file->getId()); ?>">
                            <?php echo e($file->getName()); ?>
                        </span>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="3"><?php echo t('There are no files present.'); ?></td></tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tbl-biggest-files').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        order: [[ 0, "desc" ]],
        dom: 'rtp'
    });
})
</script>

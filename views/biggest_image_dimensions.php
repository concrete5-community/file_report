<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\FileReport\Result\BigImage[] $files */
?>

<table class="table" id="tbl-biggest-image-dimensions">
    <thead>
        <tr>
            <th style="width: 140px;"><?php echo t('Width') ?></th>
            <th style="width: 140px;"><?php echo t('Height') ?></th>
            <th><?php echo t('File Name') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($files)) {
            foreach ($files as $file) {
                ?>
                <tr>
                    <td><?php echo $file->getWidth(); ?></td>
                    <td><?php echo $file->getHeight(); ?></td>
                    <td>
                        <a class="help" title="<?php echo t('File ID: %d', $file->getId()); ?>" href="<?php echo $file->getUrl(); ?>" target="_blank">
                            <?php echo e($file->getName()); ?>
                        </a>
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
    $('#tbl-biggest-image-dimensions').DataTable({
        searching: false,
        lengthChange: false,
        info: false,
        order: [[ 0, "desc" ]],
        <?php echo count($files) > 10 ? '' : 'paging: false,'; ?>
        dom: 'rtp'
    });
})
</script>

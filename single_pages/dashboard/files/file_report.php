<?php

defined('C5_EXECUTE') or die('Access Denied.');

// Charts
/** @var string $filesByExtensionChart */
/** @var string $filesByTypeChart */
/** @var string $filesByAuthorChart */
/** @var string $fileSizeByExtensionChart */
/** @var string $fileSizeByTypeChart */
/** @var string $fileSizeByAuthorChart */

// Other statistics
/** @var string $generalStatistics */
/** @var string $biggestFiles */
/** @var string $biggestImageDimensions */
/** @var string $fileSetFiles */
/** @var string $mostDownloadedFiles */
?>

<div class="ccm-dashboard-content-inner">
    <?php
    echo $generalStatistics;
    ?>

    <div class="charts-container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $filesByExtensionChart; ?>

                <header>
                    <?php
                    echo t('Number of files by extension');
                    ?>
                </header>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $filesByTypeChart; ?>

                <header>
                    <?php
                    echo t('Number of files by type');
                    ?>
                </header>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $filesByAuthorChart; ?>

                <header>
                    <?php
                    echo t('Number of files by author');
                    ?>
                </header>
            </div>
        </div>
    </div>

    <div class="charts-container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $fileSizeByExtensionChart; ?>

                <header>
                    <?php
                    echo t('Total file size by extension');
                    ?>
                </header>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $fileSizeByTypeChart; ?>

                <header>
                    <?php
                    echo t('Total file size by type');
                    ?>
                </header>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?php echo $fileSizeByAuthorChart; ?>

                <header>
                    <?php
                    echo t('Total file size by author');
                    ?>
                </header>
            </div>
        </div>
    </div>

    <div class="row table-container">
        <div class="col-sm-12 col-lg-6">
            <?php echo $biggestFiles; ?>
        </div>
        <div class="col-sm-12 col-lg-6">
            <?php echo $biggestImageDimensions; ?>
        </div>
    </div>

    <hr>

    <div class="row table-container">
        <div class="col-sm-12 col-lg-6">
            <?php echo $fileSetFiles; ?>
        </div>
        <div class="col-sm-12 col-lg-6">
            <?php echo $mostDownloadedFiles; ?>
        </div>
    </div>
</div>

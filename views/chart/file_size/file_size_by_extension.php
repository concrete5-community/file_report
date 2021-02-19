<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $labels */
/** @var array $data */
?>

<div class="chart-container">
    <canvas id="fileSizeByExtensionChart"></canvas>
</div>

<script>
    $(document).ready(function() {
        var ctx = $('#fileSizeByExtensionChart').get(0).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(0, 0, 170, .7)',
                        'rgba(30, 0, 170, .7)',
                        'rgba(60, 0, 170, .7)',
                        'rgba(90, 0, 170, .7)',
                        'rgba(120, 0, 190, .7)',
                        'rgba(150, 0, 190, .7)'
                    ]
                }]
            },
            options: {
                pieceLabel: {
                    render: 'label',
                    fontColor: '#fff'
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[0].data[tooltipItem.index] || '';

                            return data.labels[tooltipItem.index] + ' <?php echo t('file size') ?>: ' + label + ' MB';
                        }
                    }
                }
            }
        });
    });
</script>

<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $labels */
/** @var array $data */
?>

<div class="chart-container">
    <canvas id="filesByTypeChart"></canvas>
</div>

<script>
    $(document).ready(function() {
        var ctx = $('#filesByTypeChart').get(0).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(0, 100, 100, .7)',
                        'rgba(0, 100, 130, .7)',
                        'rgba(0, 100, 160, .7)',
                        'rgba(0, 100, 190, .7)',
                        'rgba(0, 100, 220, .7)'
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

                            return data.labels[tooltipItem.index] + ' <?php echo t('files') ?>: ' + label;
                        }
                    }
                }
            }
        });
    });
</script>

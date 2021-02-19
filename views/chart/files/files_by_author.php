<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $labels */
/** @var array $data */
?>

<div class="chart-container">
    <canvas id="filesByAuthorChart"></canvas>
</div>

<script>
    $(document).ready(function() {
        var ctx = $('#filesByAuthorChart').get(0).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(100, 0, 100, .7)',
                        'rgba(140, 0, 100, .7)',
                        'rgba(180, 0, 100, .7)',
                        'rgba(220, 0, 100, .7)',
                        'rgba(260, 0, 100, .7)'
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

                            return '<?php echo t('Files owned by') ?> ' + data.labels[tooltipItem.index] + ': ' + label;
                        }
                    }
                }
            }
        });
    });
</script>

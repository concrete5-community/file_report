<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $labels */
/** @var array $data */
?>

<div class="chart-container">
    <canvas id="fileSizeByAuthorChart"></canvas>
</div>

<script>
    $(document).ready(function() {
        var ctx = $('#fileSizeByAuthorChart').get(0).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(140, 0, 100, .7)',
                        'rgba(180, 0, 120, .7)',
                        'rgba(220, 0, 120, .7)',
                        'rgba(255 0, 120, .7)',
                        'rgba(255, 0, 150, .7)'
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

                            return '<?php echo t('File size owned by') ?> ' + data.labels[tooltipItem.index] + ': ' + label + ' MB';
                        }
                    }
                }
            }
        });
    });
</script>

<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../models/Donor.php';
require_once __DIR__ . '/../models/Donation.php';
require_once __DIR__ . '/../models/Member.php';
require_once __DIR__ . '/../models/Blog.php';

$database = new Database();
$db = $database->getConnection();

$counts = [];
$counts['projects'] = $db->query('SELECT COUNT(*) as c FROM projects')->fetch()['c'] ?? 0;
$counts['donors'] = $db->query('SELECT COUNT(*) as c FROM donors')->fetch()['c'] ?? 0;
$counts['donations'] = $db->query('SELECT COUNT(*) as c FROM donations')->fetch()['c'] ?? 0;
$counts['members'] = $db->query('SELECT COUNT(*) as c FROM members')->fetch()['c'] ?? 0;
$counts['blogs'] = $db->query('SELECT COUNT(*) as c FROM blogs')->fetch()['c'] ?? 0;

// Prepare monthly donations chart data (last 12 months)
$months = [];
$amounts = [];
for ($i = 11; $i >= 0; $i--) {
    $date = new DateTime("first day of -$i months");
    $months[] = $date->format('M Y');
}

$stmt = $db->query("
    SELECT 
        DATE_FORMAT(created_at, '%Y-%m') as ym, 
        SUM(amount) as total 
    FROM donations 
    GROUP BY ym 
    ORDER BY ym
");
$donationsByMonth = [];
foreach ($stmt->fetchAll() as $row) {
    $donationsByMonth[$row['ym']] = (float)$row['total'];
}

foreach ($months as $month) {
    $ym = DateTime::createFromFormat('M Y', $month)->format('Y-m');
    $amounts[] = $donationsByMonth[$ym] ?? 0;
}
?>

<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-600">Projects</h3>
        <div class="text-2xl font-bold"><?php echo e($counts['projects']); ?></div>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-600">Donors</h3>
        <div class="text-2xl font-bold"><?php echo e($counts['donors']); ?></div>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-600">Donations</h3>
        <div class="text-2xl font-bold"><?php echo e($counts['donations']); ?></div>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-600">Members</h3>
        <div class="text-2xl font-bold"><?php echo e($counts['members']); ?></div>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-600">Blog Posts</h3>
        <div class="text-2xl font-bold"><?php echo e($counts['blogs']); ?></div>
    </div>
</section>

<section class="mt-6 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-800"><i class="bi bi-graph-up"></i> Monthly Donation Trend (Last 12 Months)</h2>
    <div style="position: relative; height: 400px; margin-bottom: 20px;">
        <canvas id="donationsChart"></canvas>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-green-50 p-4 rounded border border-green-200">
            <p class="text-sm text-gray-600">Total Revenue</p>
            <p class="text-2xl font-bold text-green-700">$<?php echo number_format(array_sum($amounts), 2); ?></p>
        </div>
        <div class="bg-blue-50 p-4 rounded border border-blue-200">
            <p class="text-sm text-gray-600">Average Monthly</p>
            <p class="text-2xl font-bold text-blue-700">$<?php echo number_format(array_sum($amounts) / max(1, count(array_filter($amounts))), 2); ?></p>
        </div>
        <div class="bg-purple-50 p-4 rounded border border-purple-200">
            <p class="text-sm text-gray-600">Peak Month</p>
            <p class="text-2xl font-bold text-purple-700">$<?php echo number_format(max($amounts), 2); ?></p>
        </div>
    </div>
</section>

<script>
    (function(){
        var ctx = document.getElementById('donationsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Monthly Donations ($)',
                    data: <?php echo json_encode($amounts); ?>,
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: 'rgb(34, 197, 94)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 14 },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 },
                        callbacks: {
                            label: function(context) {
                                return '$' + context.parsed.y.toLocaleString('en-US', { minimumFractionDigits: 2 });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString('en-US');
                            },
                            font: { size: 12 }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: { size: 12 }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    })();
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
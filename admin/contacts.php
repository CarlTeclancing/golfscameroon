<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/../config/database.php';

$database = new Database();
$db = $database->getConnection();

$messages = [];
try {
    $messages = $db->query("SELECT id, name, email, message, created_at FROM messages ORDER BY created_at DESC")->fetchAll();
} catch (Exception $e) {
    $messages = [];
}
?>

<section class="bg-white p-6 rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800"><i class="bi bi-envelope"></i> Contact Submissions</h2>
        <div class="text-sm text-gray-500">Total: <?php echo e(count($messages)); ?></div>
    </div>

    <?php if (empty($messages)): ?>
        <p class="text-gray-500">No contact submissions yet.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-600 border-b">
                        <th class="py-2 pr-4">Name</th>
                        <th class="py-2 pr-4">Email</th>
                        <th class="py-2 pr-4">Message</th>
                        <th class="py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr class="border-b border-gray-100 align-top">
                            <td class="py-3 pr-4 font-medium text-gray-800"><?php echo e($msg['name']); ?></td>
                            <td class="py-3 pr-4 text-gray-700"><?php echo e($msg['email']); ?></td>
                            <td class="py-3 pr-4 text-gray-700">
                                <div class="max-w-2xl whitespace-pre-line break-words"><?php echo e($msg['message']); ?></div>
                            </td>
                            <td class="py-3 text-gray-600 whitespace-nowrap">
                                <?php echo e(date('M d, Y H:i', strtotime($msg['created_at']))); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

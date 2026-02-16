<?php
require_once __DIR__ . '/../models/Message.php';
require_once __DIR__ . '/../config/helpers.php';

$page_title = 'Contact';
$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['_csrf'] ?? '')) {
        $error = 'Invalid CSRF token';
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $message === '') {
            $error = 'Please fill in all required fields.';
        } else {
            $model = new Message();
            if ($model->create(['name' => $name, 'email' => $email, 'message' => $message])) {
                $msg = 'Thanks for reaching out. We will get back to you soon.';
                $_POST = [];
            } else {
                $error = 'Failed to send message. Please try again.';
            }
        }
    }
}

include __DIR__ . '/header.php';
?>
  <header class="bg-white border-b border-gray-200 p-6">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-3xl font-bold text-green-700">Contact Us</h1>
      <p class="mt-2 text-gray-700">We'd love to hear from you. Send us a message and we will respond.</p>
    </div>
  </header>

  <main class="max-w-4xl mx-auto p-6">
    <?php if (!empty($msg)): ?>
      <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded mb-6 text-center"><?php echo e($msg); ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
      <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded mb-6 text-center"><?php echo e($error); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow p-6">
      <form method="post" class="space-y-4">
        <input type="hidden" name="_csrf" value="<?php echo csrf_token(); ?>">

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
          <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" value="<?php echo e($_POST['name'] ?? ''); ?>" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
          <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" value="<?php echo e($_POST['email'] ?? ''); ?>" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
          <textarea name="message" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required><?php echo e($_POST['message'] ?? ''); ?></textarea>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">Send Message</button>
      </form>
    </div>

    <div class="mt-8 text-center text-gray-600">
      <p><?php echo e(get_setting('contact_email', 'info@golfs-cameroon.org')); ?></p>
      <p><?php echo e(get_setting('contact_phone', '')); ?></p>
      <p><?php echo e(get_setting('address', '')); ?></p>
    </div>
  </main>
<?php include __DIR__ . '/footer.php'; ?>

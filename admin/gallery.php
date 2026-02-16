<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/../models/Gallery.php';

$model = new Gallery();
$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'upload') {
    if (!verify_csrf($_POST['_csrf'] ?? '')) {
        $error = 'Invalid CSRF token';
    } else {
        $title = trim($_POST['title'] ?? '');
        $upload = upload_image($_FILES['image'] ?? null, __DIR__ . '/../uploads/gallery');
        if ($upload['success']) {
            $model->create([
                'title' => $title,
                'image' => $upload['filename'],
            ]);
            $msg = 'Gallery image uploaded successfully!';
        } else {
            $error = 'Upload failed: ' . $upload['error'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'delete') {
    if (!verify_csrf($_POST['_csrf'] ?? '')) {
        $error = 'Invalid CSRF token';
    } else {
        $id = (int)($_POST['id'] ?? 0);
        if ($model->delete($id)) {
            $msg = 'Image deleted successfully.';
        } else {
            $error = 'Delete failed.';
        }
    }
}

$items = $model->all();
?>

<div class="flex items-center justify-between mb-4">
  <h2 class="text-xl font-semibold text-gray-800">Gallery Manager</h2>
</div>

<?php if (!empty($msg)): ?>
  <div class="bg-green-100 text-green-800 p-2 rounded mb-4"><?php echo e($msg); ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
  <div class="bg-red-100 text-red-800 p-2 rounded mb-4"><?php echo e($error); ?></div>
<?php endif; ?>

<div class="bg-white rounded shadow p-6 mb-6">
  <h3 class="text-lg font-semibold mb-3">Upload New Image</h3>
  <form method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <input type="hidden" name="_csrf" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="_action" value="upload">

    <div class="md:col-span-1">
      <label class="block text-sm font-medium text-gray-700 mb-2">Title (optional)</label>
      <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
    </div>

    <div class="md:col-span-1">
      <label class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
      <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
    </div>

    <div class="md:col-span-1 flex items-end">
      <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
        <i class="bi bi-upload"></i> Upload
      </button>
    </div>
  </form>
</div>

<div class="bg-white rounded shadow p-6">
  <h3 class="text-lg font-semibold mb-4">Gallery Images (<?php echo count($items); ?>)</h3>
  <?php if (empty($items)): ?>
    <p class="text-gray-600">No images uploaded yet.</p>
  <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($items as $g): ?>
        <?php
          $thumb = 'uploads/gallery/thumbs/' . pathinfo($g['image'], PATHINFO_FILENAME) . '.webp';
          $thumbPath = __DIR__ . '/../' . $thumb;
          $imgSrc = file_exists($thumbPath) ? $thumb : ('uploads/gallery/' . $g['image']);
        ?>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
          <img src="<?php echo base_url($imgSrc); ?>" alt="<?php echo e($g['title'] ?? 'Gallery image'); ?>" class="w-full h-48 object-cover">
          <div class="p-3 flex items-center justify-between">
            <div class="text-sm font-medium text-gray-700 truncate pr-2"><?php echo e($g['title'] ?? ''); ?></div>
            <form method="post" onsubmit="return confirm('Delete this image?')">
              <input type="hidden" name="_csrf" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="_action" value="delete">
              <input type="hidden" name="id" value="<?php echo e($g['id']); ?>">
              <button class="text-red-600 hover:text-red-800"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>

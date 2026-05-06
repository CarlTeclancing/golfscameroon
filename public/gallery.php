<?php
require_once __DIR__ . '/../models/Gallery.php';

$page_title = 'Gallery';
$model = new Gallery();
$items = $model->all();

include __DIR__ . '/header.php';
?>

<style>
/* ✅ Masonry layout */
.masonry {
    column-width: 260px;
    column-gap: 20px;
}

.masonry-item {
    break-inside: avoid;
    margin-bottom: 20px;
}

.masonry-item img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 6px;
}
</style>

<header class="bg-white border-b border-gray-200 p-6"
        style="background-image: linear-gradient(rgba(64, 74, 63, 0.7), rgba(0,0,0,0.6)), url('uploads/hands_smile.jpg')">
  <div class="max-w-6xl mx-auto text-center">
    <h1 class="text-3xl font-bold text-green-700">Gallery</h1>
    <p class="mt-2 text-white">
      Moments from our community programs, workshops, and events.
    </p>
  </div>
</header>

<main class="max-w-6xl mx-auto p-6">

  <?php if (empty($items)): ?>
    <div class="text-center text-gray-600">No gallery images yet.</div>

  <?php else: ?>

    <!-- ✅ Masonry container -->
    <div class="masonry">

      <?php foreach ($items as $g): ?>
        <?php
          $imgSrc = 'uploads/gallery/' . $g['image'];
          $imgPath = __DIR__ . '/../' . $imgSrc;
          $version = file_exists($imgPath) ? (string)filemtime($imgPath) : '';
          $imgUrl = base_url($imgSrc) . ($version !== '' ? '?v=' . urlencode($version) : '');
        ?>

        <!-- ✅ Masonry item -->
        <div class="masonry-item bg-white rounded shadow overflow-hidden">

          <a href="<?php echo e($imgUrl); ?>" target="_blank" rel="noopener noreferrer">
            <img 
              src="<?php echo e($imgUrl); ?>" 
              alt="<?php echo e($g['title'] ?? 'Gallery image'); ?>"
              decoding="async"
            >
          </a>

          <?php if (!empty($g['title'])): ?>
            <div class="p-3 text-center text-sm font-medium text-gray-700">
              <?php echo e($g['title']); ?>
            </div>
          <?php endif; ?>

        </div>

      <?php endforeach; ?>

    </div>

  <?php endif; ?>

</main>

<?php include __DIR__ . '/footer.php'; ?>
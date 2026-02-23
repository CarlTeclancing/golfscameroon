<?php
require_once __DIR__ . '/../models/Member.php';
$page_title = 'Members';
$memberModel = new Member();
$members = $memberModel->all();
include __DIR__ . '/header.php';
?>
<style>
  .members-hero {
    background-image: linear-gradient(rgba(64, 74, 63, 0.7), rgba(72, 138, 81, 0.6)), url('uploads/hands_smile.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }
</style>
  <header class="bg-white border-b border-gray-200 p-6 members-hero py-16">
     <div class="max-w-6xl mx-auto text-center">
      <h1 class="text-5xl font-bold text-white ">Our Members</h1>
    <div class="max-w-6xl mx-auto text-center">
      <h1 class="text-xl font-bold text-white ">Our Members</h1>
    </div>
  </header>
  <main class="max-w-6xl mx-auto p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php foreach ($members as $m): ?>
        <div class="bg-white rounded shadow text-center">
          <div class="h-40 bg-gray-100 rounded mb-4 flex items-center justify-center overflow-hidden h-2/3 ">
              <?php if (!empty($m['image'])): ?>
              <img src="<?php echo base_url('uploads/' . $m['image']); ?>" alt="<?php echo e($m['name']); ?>" class="object-cover bg-cover bg-center h-full w-full object-contain">
            <?php else: ?>
              <span class="text-gray-400">No image</span>
            <?php endif; ?>
          </div>
          <h3 class="font-bold text-xl capitalize"><?php echo e($m['name']); ?></h3>
          <p class="text-md text-gray-700 capitalize "><?php echo e($m['role']); ?></p>
          <p class="text-sm text-gray-700 capitalize mb-2"><?php echo e(substr($m['bio'],0,120)); ?>...</p>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
<?php include __DIR__ . '/footer.php'; ?>
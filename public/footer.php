  <footer class="bg-white border-t border-gray-200 text-gray-700 p-6 mt-12">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 text-center md:text-left">
      <div>
        <h4 class="font-semibold text-green-700"><?php echo e(get_setting('site_name', 'Golfs Cameroon')); ?></h4>
        <p class="text-sm text-gray-600 mt-2"><?php echo e(get_setting('site_description', 'Empowering youth through education and community support.')); ?></p>
      </div>
      <div>
        <h4 class="font-semibold text-green-700">Contact</h4>
        <p class="text-sm text-gray-600 mt-2">
          <?php $email = get_setting('contact_email', 'info@golfs-cameroon.org'); ?>
          <?php $address = get_setting('address', 'Yaounde, Cameroon'); ?>
          <?php echo e($email); ?><br/><?php echo e($address); ?>
        </p>
      </div>
      <div>
        <h4 class="font-semibold text-green-700">Follow</h4>
        <div class="flex justify-center md:justify-start gap-2 mt-2 text-sm">
          <?php $twitter = get_setting('social_twitter', ''); ?>
          <?php if (!empty($twitter)): ?>
            <a href="<?php echo e($twitter); ?>" class="text-green-700 hover:text-red-600">Twitter</a>
          <?php endif; ?>
          <?php $facebook = get_setting('social_facebook', ''); ?>
          <?php if (!empty($facebook)): ?>
            <a href="<?php echo e($facebook); ?>" class="text-green-700 hover:text-red-600">Facebook</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>

<?php
$page_title = 'Services';
require_once __DIR__ . '/../config/components.php';
require_once __DIR__ . '/../config/data.php';
include __DIR__ . '/header.php';
?>
<style>
  .services-hero {
    background-image: linear-gradient(rgba(32, 34, 33, 0.9), rgba(22, 78, 58, 0.8)), url('uploads/hands_smile.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }
  .focus-card {
    transition: all 0.4s ease;
  }
  .focus-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
  }
  .feature-box {
    transition: all 0.3s ease;
  }
  .feature-box:hover {
    background: linear-gradient(135deg, rgba(22, 78, 58, 0.08) 0%, rgba(34, 197, 94, 0.08) 100%);
    transform: translateY(-5px);
  }
</style>

  <!-- Hero Section -->
  <header class="services-hero py-24 md:py-36">
    <div class="max-w-5xl mx-auto px-6 text-center" data-reveal>
      <span class="inline-block bg-white bg-opacity-20 text-green-100 px-4 py-2 rounded-full text-sm font-semibold mb-4">What We Offer</span>
      <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Our Services</h1>
      <p class="text-lg md:text-xl text-green-100 max-w-3xl mx-auto mb-8">Empowering youth through education, leadership development, and community projects across Cameroon.</p>
      <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 inline-block">
        <p class="text-2xl md:text-3xl font-semibold text-white italic">"The Power of Positive Thinking"</p>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-16">
    
    <!-- Intro Section -->
    <section class="text-center mb-20" data-reveal>
      <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Our Focus Areas</span>
      <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2 mb-6">Guided by Purpose, Driven by Impact</h2>
      <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">Guided by our motto, <strong class="text-green-700">"The Power of Positive Thinking"</strong>, The Golfs Cameroon designs programs that empower young people, strengthen communities, and build meaningful partnerships across borders. Each focus area reflects our commitment to leadership, education, inclusion, and sustainable development.</p>
    </section>

    <!-- Focus Areas -->
    <?php
    $focus_areas = get_focus_areas();
    foreach ($focus_areas as $index => $area):
        $image_on_left = ($index % 2 == 0);
    ?>
        <?php render_focus_area($area, $image_on_left); ?>
    <?php endforeach; ?>

    <!-- Service Features -->
    <section class="mt-20" data-reveal>
      <div class="text-center mb-12">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">What We Provide</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Our Services & Features</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach (get_service_features() as $feature): ?>
          <div class="feature-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
            <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
              <i class="bi bi-check-circle-fill text-3xl text-green-600"></i>
            </div>
            <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300"><?php echo e($feature['title']); ?></h4>
            <p class="text-gray-600"><?php echo e($feature['description']); ?></p>
            <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="mt-20 bg-gradient-to-r from-green-700 to-green-600 text-white rounded-3xl p-8 md:p-16 text-center" data-reveal>
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Make a Difference?</h2>
      <p class="text-green-100 text-lg max-w-2xl mx-auto mb-8">Join us in empowering youth and building stronger communities across Cameroon.</p>
      <div class="flex flex-wrap gap-4 justify-center">
        <a href="<?php echo base_url('members'); ?>" class="bg-white text-green-700 px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition duration-300 transform hover:scale-105 shadow-lg">
          <i class="bi bi-person-plus"></i> Become a Member
        </a>
        <a href="<?php echo base_url('contact'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-700 transition duration-300 shadow-lg">
          <i class="bi bi-chat-dots"></i> Contact Us
        </a>
      </div>
    </section>

  </main>
<?php include __DIR__ . '/footer.php'; ?>

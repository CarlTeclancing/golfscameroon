<?php
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../models/Member.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/components.php';
require_once __DIR__ . '/../config/data.php';

$dbProjects = (new Project())->all();
$members = (new Member())->all();

// compute simple progress for projects using donations table if present
$database = new Database();
$db = $database->getConnection();
function project_progress($db, $project_id, $target) {
    try {
        $stmt = $db->prepare('SELECT SUM(amount) as s FROM donations WHERE project_id = :id');
        $stmt->execute([':id'=>$project_id]);
        $row = $stmt->fetch();
        $sum = $row['s'] ?? 0;
        $pct = $target > 0 ? min(100, round(($sum / $target) * 100)) : 0;
        return [$sum, $pct];
    } catch (Exception $e) { return [0,0]; }
}

$page_title = 'Home';
include __DIR__ . '/header.php';
?>
<style>
  .hero-section {
    background: linear-gradient(135deg, rgba(22, 78, 58, 0.95) 0%, rgba(13, 101, 45, 0.85) 100%);
    position: relative;
    overflow: hidden;
  }
  .hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .hero-card {
    transform: rotate(4deg);
    transition: transform 0.5s ease;
  }
  .hero-card:hover {
    transform: rotate(0deg) scale(1.02);
  }
  .involvement-card {
    transition: all 0.3s ease;
  }
  .involvement-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
  }
  .faq-card {
    transition: all 0.3s ease;
  }
  .faq-card:hover {
    background: linear-gradient(135deg, rgba(22, 78, 58, 0.05) 0%, rgba(34, 197, 94, 0.05) 100%);
  }
</style>

    <!-- Hero Section -->
    <header class="hero-section py-20 md:py-32">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1 text-center md:text-left" data-reveal>
                <span class="inline-block bg-green-800 bg-opacity-50 text-green-100 px-4 py-2 rounded-full text-sm font-semibold mb-4">Welcome to Golfs Cameroon</span>
                <h1 class="text-4xl md:text-6xl font-bold leading-tight text-white mb-6">Empowering Cameroon&apos;s Youth through Education & Opportunity</h1>
                <p class="text-lg md:text-xl text-green-100 mb-8 leading-relaxed">We create mentorship, skill-building, and scholarship programs to unlock potential and build resilient communities aligned with the UN SDGs.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <button onclick="openDonateModal(0, 'General Donation')" class="bg-white text-green-700 px-8 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 font-semibold">
                        <i class="bi bi-heart-fill mr-2"></i> Donate Now
                    </button>
                    <a href="<?php echo base_url('members'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white hover:text-green-700 transition duration-300 font-semibold">
                        <i class="bi bi-people-fill mr-2"></i> Join Us
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center" data-reveal>
                <div class="hero-card bg-white rounded-2xl overflow-hidden shadow-2xl  p-3">
                    <img src="<?php echo asset_url('uploads/heroImage.png'); ?>" alt="Youth program" class="rounded-xl w-full h-auto">
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <!-- Section: The Future Begins With Our Youth -->
        <section id="services" class="py-12 mb-16" data-reveal>
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">The Future Begins With Our Youth</h1>
            </div>
            <?php render_info_cards(get_info_cards()); ?>
        </section>
         <section id="initiative" class="py-8 bg-brand text-white grid md:grid-cols-2 gap-6 mb-12 py-8 " data-reveal>
            
            <div class="bg-white w-[710px] h-[544px] shadow-lg p-4" data-reveal>
                <img src="<?php echo asset_url('uploads/initiative.jpg'); ?>" alt="initiative" class="w-full object-cover ">
            </div>
            
            <article class="text-left">
                <h2 class="text-2xl md:text-3xl font-semibold text-green-700 mb-4">Cameroon Youth Leadership Initiative</h2>
                <p class="mt-4 text-lg text-gray-700  max-w-2xl mx-auto mb-2">Young people across Cameroon need opportunities to grow as future leaders, entrepreneurs, and changemakers.
               Through mentorship programs, school awards, and community workshops, we equip youth with the skills, confidence, and guidance to drive positive change in their communities.</p>
            <button><a href="<?php echo base_url('members'); ?>" class="inline-block bg-red-700 text-white px-4 py-2 mt-4 transition font-medium">
             Join the Movement!
            </a></button>
           </article>
            
        </section>

        <!-- Section: Statistics -->
        <section class="py-12 mb-16" data-reveal>
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">We're Not Stopping Here</h1>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach (get_statistics() as $stat): ?>
                    <?php render_stat_card($stat); ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Section: Our Work -->
        <section id="top-projects" class="py-12 mb-16 bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 md:p-12" data-reveal>
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Our Work</h1>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach (get_service_cards() as $service): ?>
                    <?php render_service_card($service); ?>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- Section: Get Involved -->
        <section id="get-involved" data-reveal class="py-16 mb-16">
            <div class="text-center mb-12">
                <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Take Action</span>
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mt-2 capitalize">Ways to Get Involved</h1>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="involvement-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
                    <img src="<?php echo asset_url('uploads/become_volunteer.jpg'); ?>" alt="volunteer" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-green-700 mb-3">Become a Volunteer</h3>
                        <p class="text-gray-600 mb-4">Mentorship, coaching, and youth leadership engagement programs designed to raise confident and purpose-driven changemakers.</p>
                        <a href="<?php echo base_url('members'); ?>" class="inline-block bg-red-700 text-white px-5 py-2 rounded-lg transition font-medium hover:bg-red-800">
                            Join Us
                        </a>
                    </div>
                </div>
                <div class="involvement-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
                    <img src="<?php echo asset_url('uploads/global_patnership.jpg'); ?>" alt="partnership" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-green-700 mb-3">Partner With Us</h3>
                        <p class="text-gray-600 mb-4">Collaborate with us as an organization, institution, or corporate body. Together, we can expand opportunities for youth across borders.</p>
                        <a href="<?php echo base_url('members'); ?>" class="inline-block bg-red-700 text-white px-5 py-2 rounded-lg transition font-medium hover:bg-red-800">
                            Partner Now
                        </a>
                    </div>
                </div>
                <div class="involvement-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
                    <img src="<?php echo asset_url('uploads/leadership.jpg'); ?>" alt="support" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-green-700 mb-3">Support the Mission</h3>
                        <p class="text-gray-600 mb-4">Contribute resources that help us run leadership programs and community outreach initiatives. Every contribution helps shape future changemakers.</p>
                        <a href="<?php echo base_url('members'); ?>" class="inline-block bg-red-700 text-white px-5 py-2 rounded-lg transition font-medium hover:bg-red-800">
                            Support Now
                        </a>
                    </div>
                </div>
                <div class="involvement-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
                    <img src="<?php echo asset_url('uploads/join_youth.jpg'); ?>" alt="network" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-green-700 mb-3">Join the Youth Network</h3>
                        <p class="text-gray-600 mb-4">Are you a young leader or aspiring professional? Connect with a growing network of purpose-driven youth.</p>
                        <a href="<?php echo base_url('members'); ?>" class="inline-block bg-red-700 text-white px-5 py-2 rounded-lg transition font-medium hover:bg-red-800">
                            Join the Network
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="bg-gradient-to-r from-green-800 to-green-700 text-white rounded-xl p-8 md:p-16 mb-16" data-reveal>
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <i class="bi bi-quote text-6xl text-green-400 mb-6 block"></i>
                    <h2 class="text-3xl md:text-4xl font-bold leading-relaxed">"Our youths are not the problem, they are the promise."</h2>
                </div>
                <div class="flex justify-center">
                    <div class="hero-card bg-white p-2 shadow-2xl overflow-hidden transform translate-y-4 hover:translate-y-0 transition duration-500">
                        <img src="<?php echo asset_url('uploads/person_smile.jpg'); ?>" alt="initiative" class="w-full h-72 object-cover">
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Banner -->
        <section class="bg-gradient-to-br from-[#639E82] to-green-600 text-white rounded-3xl py-16 mb-16" data-reveal>
            <div class="text-center">
                <h2 class="font-bold text-3xl md:text-4xl mb-4 uppercase">
                    We Have the Youth, the Talent, the Drive
                </h2>
                <p class="text-xl text-green-100 mb-8">All we need is the opportunity</p>
                <a href="<?php echo base_url('donations'); ?>" class="inline-block bg-white text-green-700 px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition duration-300 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-heart-fill mr-2"></i>Donate Today
                </a>
            </div>
        </section>
        <!-- FAQ Section -->
        <section id="faq" class="py-16 mb-16 bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 md:p-12" data-reveal>
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Frequently Asked Questions</h1>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="faq-card bg-white p-8 rounded-2xl shadow-md" data-reveal>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="bi bi-question-circle text-2xl text-green-600"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4 text-green-700">What about boys?</h3>
                    <p class="text-gray-600 leading-relaxed">Whether you choose to sponsor a girl or a boy, you'll help projects focused on equal opportunities for all children. We know girls are the most vulnerable and we ensure that boys play an important role in building secure communities that value girls.</p>
                </div>
                <div class="faq-card bg-white p-8 rounded-2xl shadow-md" data-reveal>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="bi bi-chat-heart text-2xl text-red-600"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4 text-green-700">Is sponsorship like adoption?</h3>
                    <p class="text-gray-600 leading-relaxed">No, it's not. The girl you sponsor will have a family of her own, but your words of encouragement play an important role for her and her community. Letter writing also helps girls learn about other cultures and improve their literacy skills.</p>
                </div>
                <div class="faq-card bg-white p-8 rounded-2xl shadow-md" data-reveal>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="bi bi-telephone text-2xl text-green-600"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4 text-green-700">How can I get more information?</h3>
                    <p class="text-gray-600 leading-relaxed">Our Supporter Engagement team are happy to answer any questions about sponsorship and our work. You can reach them on 0300 777 9779 or supporterquestions@plan-uk.org.</p>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="<?php echo base_url('faq'); ?>" class="inline-flex items-center text-lg text-green-700 font-bold hover:text-green-800 transition">
                    More FAQs <i class="bi bi-chevron-right mx-2"></i>
                </a>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section id="why-choose-golfs" class="py-16 mb-16" data-reveal>
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mb-6 uppercase">Why Choose The Golfs Cameroon?</h1>
                <p class="text-lg text-gray-600 leading-relaxed">We are a youth-focused organization striving to empower the next generation of leaders and changemakers. For years, we've worked alongside young people and their communities to ensure every youth can reach their full potential and every young person has access to guidance, mentorship, and opportunities. We bring people together to nurture talent, build skills, and create pathways to leadership, even in underserved areas.</p>
            </div>
        </section>
        <!-- <section id="members" data-reveal>
            <h2 class="text-2xl font-semibold mb-4 text-center">Our Members</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach (array_slice($members,0,8) as $m): ?>
                    <div class="bg-white p-4 rounded shadow text-center">
                        <div class="h-36 w-36 mx-auto mb-3 bg-gray-100 rounded-full overflow-hidden">
                            <?php if (!empty($m['image'])): ?>
                                <img src="<?php echo base_url('uploads/' . $m['image']); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full text-gray-400">No image</div>
                            <?php endif; ?>
                        </div>
                        <h4 class="font-semibold"><?php echo e($m['name']); ?></h4>
                        <p class="text-sm text-gray-600"><?php echo e($m['role']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section> -->
    
    </main>

  <!-- Donation Modal -->
  <!-- <div id="donateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
    <div class="bg-green-700 text-white p-6 flex justify-between items-center">
        <h2 class="text-xl font-bold">Make a Donation</h2>
        <button onclick="closeDonateModal()" class="text-white hover:text-gray-200 text-2xl">&times;</button>
      </div>
      
      <form id="donateForm" method="post" action="<?php echo base_url('api/process_donation.php'); ?>" class="p-6 space-y-4">
        <input type="hidden" name="_csrf" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="project_id" id="modal_project_id" value="">
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
          <p id="modal_project_name" class="font-semibold text-gray-900"></p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
          <input type="text" name="full_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
          <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="tel" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" name="location" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Amount (USD) *</label>
          <input type="number" name="amount" step="0.01" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
        </div>

                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
          Continue to Payment
        </button>
      </form>
    </div>
  </div> -->

<?php include __DIR__ . '/footer.php'; ?>
    <script>
        function openDonateModal(projectId, projectName) {
          document.getElementById('modal_project_id').value = projectId;
          document.getElementById('modal_project_name').textContent = projectName;
          document.getElementById('donateModal').classList.remove('hidden');
          document.body.style.overflow = 'hidden';
        }

        function closeDonateModal() {
          document.getElementById('donateModal').classList.add('hidden');
          document.body.style.overflow = 'auto';
          document.getElementById('donateForm').reset();
        }

        // Close modal when clicking outside
        document.getElementById('donateModal').addEventListener('click', function(e) {
          if (e.target === this) {
            closeDonateModal();
          }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            closeDonateModal();
          }
        });

        // initialize mobile nav and scroll reveal
        document.addEventListener('DOMContentLoaded', function(){
            initMobileMenu('#mobile-menu-btn', '#mobile-nav');
            initScrollReveal();
        });
    </script>

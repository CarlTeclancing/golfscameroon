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
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600&display=swap');
 
  :root {
    --green-dark: #14532d;
    --green-mid:  #166534;
    --gold:       #d9f9e9;
    --slide-dur:  800ms;
    --text-dur:   600ms;
  }
 
  .hero-carousel { position:relative; width:100%; min-height:100vh; overflow:hidden; font-family:'DM Sans',sans-serif; }
 
  .hc-slide { position:absolute; inset:0; display:flex; align-items:center; opacity:0; pointer-events:none; transition:opacity var(--slide-dur) ease; }
  .hc-slide.active { opacity:1; pointer-events:auto; }
 
  .hc-bg-img { position:absolute; inset:0; background-size:cover; background-position:center; z-index:0; }
 
  .hc-overlay { position:absolute; inset:0; z-index:1; }
  .hc-slide:nth-child(odd)  .hc-overlay { background:linear-gradient(105deg, rgba(20,83,45,.97) 0%, rgba(22,101,52,.4) 40%, rgba(22,101,52,.3) 65%, transparent 100%); }
  .hc-slide:nth-child(even) .hc-overlay { background:linear-gradient(255deg, rgba(20,83,45,.97) 0%, rgba(22,101,52,.4) 40%, rgba(22,101,52,.3) 65%, transparent 100%); }
 
  .hc-inner { position:relative; z-index:2; max-width:1000px;  width:100%; display:flex; align-items:center; gap:3rem; min-height:50vh; }
  /* .hc-slide:nth-child(even) .hc-inner { flex-direction:row-reverse; } */
 
  .hc-text { flex:1; max-width:580px; }
  /* .hc-slide:nth-child(even) .hc-text { text-align:right; } */
 
  .hc-tag, .hc-title, .hc-desc, .hc-actions { opacity:0; transform:translateY(28px); transition:opacity var(--text-dur) ease, transform var(--text-dur) ease; }
  .hc-slide.active .hc-tag     { opacity:1; transform:none; transition-delay:120ms; }
  .hc-slide.active .hc-title   { opacity:1; transform:none; transition-delay:260ms; }
  .hc-slide.active .hc-desc    { opacity:1; transform:none; transition-delay:400ms; }
  .hc-slide.active .hc-actions { opacity:1; transform:none; transition-delay:530ms; }
 
  .hc-tag { display:inline-block; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.25); color:#bbf7d0; padding:.35rem 1rem; border-radius:999px; font-size:.8rem; font-weight:600; letter-spacing:.06em; text-transform:uppercase; margin-bottom:1.1rem; backdrop-filter:blur(6px); }
  .hc-title { font-family: "Poppins", sans-serif; font-size:clamp(2rem,5vw,3.5rem); font-weight:900; line-height:1.12; color:#fff; margin-bottom:1.25rem; }
  .hc-title span { color:var(--gold);     font-family: "Agbalumo", system-ui; font-weight:500; }
  .hc-desc { font-size:1.05rem; line-height:1.75; color:#d1fae5; margin-bottom:2rem; }
 
  .hc-actions { display:flex; flex-wrap:wrap; gap:.85rem; }
  .hc-slide:nth-child(even) .hc-actions { justify-content:flex-end; }
 
  .btn-primary   { display:inline-flex; align-items:center; gap:.45rem; background:#fff; color:var(--green-dark); padding:.85rem 1.75rem; border-radius:.6rem; font-weight:700; font-size:.95rem; border:none; cursor:pointer; box-shadow:0 8px 24px rgba(0,0,0,.2); transition:transform .2s,box-shadow .2s; text-decoration:none; }
  .btn-primary:hover { transform:translateY(-2px); box-shadow:0 14px 32px rgba(0,0,0,.28); }
  .btn-secondary { display:inline-flex; align-items:center; gap:.45rem; border:2px solid rgba(255,255,255,.7); color:#fff; padding:.85rem 1.75rem; border-radius:.6rem; font-weight:600; font-size:.95rem; background:transparent; cursor:pointer; transition:background .2s,color .2s; text-decoration:none; }
  .btn-secondary:hover { background:#fff; color:var(--green-dark); }
 
  .hc-img-wrap { flex:0 0 auto; width:min(420px,40vw); display:flex; justify-content:center; }
  @media(max-width:767px){ .hc-img-wrap { display:none; } }
  .hc-card { background:rgba(255,255,255,.10); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,.22); border-radius:1.25rem; padding:.75rem; box-shadow:0 20px 60px rgba(0,0,0,.35); opacity:0; transform:scale(.93) translateY(18px); transition:opacity var(--text-dur) ease .35s, transform var(--text-dur) ease .35s; }
  /* .hc-slide.active .hc-card { opacity:1; transform:scale(1) translateY(0); } */
  /* .hc-card img { border-radius:.85rem; width:100%; height:320px; object-fit:cover; display:block; } */
 
  .hc-progress-wrap { position:absolute; bottom:0; left:0; right:0; height:3px; background:rgba(255,255,255,.15); z-index:10; }
  .hc-progress-bar { height:100%; background:var(--gold); width:0%; transition:none; }
  .hc-progress-bar.running { transition:width 6000ms linear; width:100%; }
 
  .hc-dots { position:absolute; bottom:1.8rem; left:50%; transform:translateX(-50%); display:flex; gap:.55rem; z-index:10; }
  .hc-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,.35); border:none; cursor:pointer; transition:background .3s,transform .3s; padding:0; }
  .hc-dot.active { background:#fff; transform:scale(1.4); }

  .hc-inner { max-width:1280px; margin:0 auto; padding:6rem 1.5rem 4rem; width:100%; display:flex; align-items:center; gap:3rem; min-height:100vh; }
  .hc-text {font-family: "Poppins", sans-serif; flex:1; max-width:580px; }
  .hc-title { font-family: "Poppins", sans-serif; font-size:clamp(2.5rem,5vw,3.5rem); font-weight:700; line-height:1.12; color:#fff; margin-bottom:1.25rem; }
  .hc-desc { font-size:1.05rem; line-height:1.75; color:#d1fae5; margin-bottom:2rem; }

  @media (max-width: 1024px) {
    .hc-inner { padding:4rem 1.25rem 3rem; gap:2rem; }
    .hc-title { font-size:clamp(2rem,5.5vw,3rem); }
    .hc-desc { font-size:clamp(1rem,2.4vw,1.05rem); }
    .hc-card { max-width:360px; }
  }

  @media (max-width: 767px) {
    .hc-inner { flex-direction:column; align-items:flex-start; padding:3rem 1rem 2rem; min-height:auto; }
    .hc-slide:nth-child(even) .hc-inner { flex-direction:column; }
    .hc-text { width:100%; max-width:100%; }
    .hc-title {font-family: "Poppins", sans-serif; font-size:clamp(1.75rem,8vw,2.5rem); line-height:1.15; }
    .hc-desc { font-size:clamp(0.95rem,3vw,1rem); margin-bottom:1.5rem; }
    .hc-actions { flex-wrap:wrap; gap:.75rem; }
    .hc-img-wrap { width:100%; display:block; }
    .hc-card { width:100%; max-width:100%; }
    .hc-progress-wrap { height:2px; }
    .hc-dots { bottom:1.1rem; }
    .hc-counter { right:1rem; left:auto; font-size:.75rem; }
    .hc-arrow { width:40px; height:40px; }
  }
  .hc-counter span { color:#fff; }
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
    min-height: 380px;
  }
  .faq-card:hover, .faq-card.active-reveal {
    background: #ffffff !important;
    color: #14532d !important;
  }
   .faq-card:hover .default-view, .faq-card.active-reveal .default-view {
    opacity: 0;
    transform: scale(0.9);
  }
   .faq-card:hover .hover-view, .faq-card.active-reveal .hover-view {
    opacity: 1;
  }
</style>

    <!-- Hero Section -->
 <?php $heroSlides = get_hero_slides(); ?>
<header class="hero-carousel" id="heroCarousel">
 
  <?php foreach ($heroSlides as $slide): render_hero_slide($slide); endforeach; ?>
 
  <!-- Controls -->
  <button class="hc-arrow prev" onclick="heroMove(-1)" aria-label="Previous slide">
    <i class="bi bi-chevron-left"></i>
  </button>
  <button class="hc-arrow next" onclick="heroMove(1)" aria-label="Next slide">
    <i class="bi bi-chevron-right"></i>
  </button>
 
  <div class="hc-dots" id="heroDots"></div>
  <div class="hc-counter"><span id="heroCurrent">1</span> / <span id="heroTotal"></span></div>
 
  <div class="hc-progress-wrap">
    <div class="hc-progress-bar" id="heroProgressBar"></div>
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
            
            <div class="bg-white w-full max-w-lg mx-auto md:mx-0 shadow-lg p-4" data-reveal>
                <img src="<?php echo asset_url('uploads/trads.jpeg'); ?>" alt="initiative" class="w-full h-64 md:h-96 object-cover rounded-lg">
            </div>
            
            <article class="text-left px-4 md:px-0">
                <h2 class="text-2xl md:text-3xl font-semibold text-green-700 mb-4">Cameroon Youth Leadership Initiative</h2>
                <p class="mt-4 text-lg text-gray-700 max-w-2xl mx-auto mb-2 leading-relaxed">Young people across Cameroon need opportunities to grow as future leaders, entrepreneurs, and changemakers.
               Through mentorship programs, school awards, and community workshops, we equip youth with the skills, confidence, and guidance to drive positive change in their communities.</p>
            <button><a href="<?php echo base_url('members'); ?>" class="inline-block bg-red-700 text-white px-6 py-3 mt-4 rounded-lg font-medium hover:bg-red-800 transition">
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
            <div class="grid md:grid-cols-2  gap-6">
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
            <div class="grid gap-8">
                <?php foreach (get_involvement_options() as $index => $card): ?>
                    <?php $image_on_left = ($index % 2 == 0); ?>
                    <?php render_involvement_card($card, $image_on_left); ?>
                <?php endforeach; ?>
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
                    <div class="hero-card bg-white p-2 shadow-2xl overflow-hidden transform translate-y-4 hover:translate-y-0 transition duration-500 w-full ">
                        <img src="<?php echo asset_url('uploads/kids.jpg'); ?>" alt="initiative" class="w-full h-96 object-center">
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
                <div class="flex justify-center items-center faq-card relative bg-green-600 text-white p-8 rounded-2xl shadow-md overflow-hidden group transition-all duration-300 hover:bg-white hover:text-green-700" data-faq-card="0">

                  <!-- DEFAULT VIEW -->
                  <div class="default-view flex flex-col items-center justify-center text-center transition-all duration-300">
                      <i class="bi bi-question-octagon text-9xl mb-4"></i>
                      <h3 class="font-bold text-xl">What does Golfs Cameroon actually do?</h3>
                  </div>

                  <!-- HOVER VIEW -->
                  <div class="hover-view absolute inset-0 flex flex-col items-center justify-center text-center p-6 opacity-0 transition-all duration-300">
                      <i class="bi bi-question-octagon text-5xl mb-4"></i>
                      <h3 class="font-bold text-lg mb-2">What does Golfs Cameroon actually do?</h3>
                      <p class="text-sm text-gray-600 leading-relaxed">
                         We empower young people in Cameroon by providing mentorship, skills training, and opportunities that help them become leaders, entrepreneurs, and change-makers in their communities.
                      </p>
                  </div>

                </div>

                 <div class="flex justify-center items-center faq-card relative bg-green-600 text-white p-8 rounded-2xl shadow-md overflow-hidden group transition-all duration-300 hover:bg-white hover:text-green-700" data-faq-card="1">

                  <!-- DEFAULT VIEW -->
                  <div class="default-view flex flex-col items-center justify-center text-center transition-all duration-300">
                      <i class="bi bi-question-octagon text-9xl mb-4"></i>
                      <h3 class="font-bold text-xl">Who can benefit from your programs?</h3>
                  </div>

                  <!-- HOVER VIEW -->
                  <div class="hover-view absolute inset-0 flex flex-col items-center justify-center text-center p-6 opacity-0 transition-all duration-300">
                      <i class="bi bi-question-octagon text-5xl mb-4"></i>
                      <h3 class="font-bold text-lg mb-2">Who can benefit from your programs?</h3>
                      <p class="text-sm text-gray-600 leading-relaxed">
                        Our programs are designed for Cameroonian youth, especially those in underserved communities who need access to guidance, education, and opportunities to grow.
                      </p>
                  </div>

                 </div>
                 <div class="flex justify-center items-center faq-card relative bg-green-600 text-white p-8 rounded-2xl shadow-md overflow-hidden group transition-all duration-300 hover:bg-white hover:text-green-700" data-faq-card="2">

                  <!-- DEFAULT VIEW -->
                  <div class="default-view flex flex-col items-center justify-center text-center transition-all duration-300">
                      <i class="bi bi-question-octagon text-9xl mb-4"></i>
                      <h3 class="font-bold text-xl">Do I need any prior experience to join?</h3>
                  </div>

                  <!-- HOVER VIEW -->
                  <div class="hover-view absolute inset-0 flex flex-col items-center justify-center text-center p-6 opacity-0 transition-all duration-300">
                      <i class="bi bi-question-octagon text-5xl mb-4"></i>
                      <h3 class="font-bold text-lg mb-2">Do I need any prior experience to join?</h3>
                      <p class="text-sm text-gray-600 leading-relaxed">
                       Not at all. We welcome young people at all levels. What matters most is your willingness to learn, grow, and make a positive impact.
                      </p>
                  </div>

                 </div>
        </section>

        <!-- Why Choose Us Section -->
        <section id="why-choose-golfs" class="py-16 mb-16" data-reveal>
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-green-700 mb-6 uppercase">Why Choose The Golfs Cameroon?</h1>
                <p class="text-lg text-gray-600 leading-relaxed">We are a youth-focused organization striving to empower the next generation of leaders and changemakers. For years, we've worked alongside young people and their communities to ensure every youth can reach their full potential and every young person has access to guidance, mentorship, and opportunities. We bring people together to nurture talent, build skills, and create pathways to leadership, even in underserved areas.</p>
            </div>
        </section>
    
    </main>

  <!-- Donation Modal -->
  <div id="donateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
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
  </div>

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

// FAQ Auto-Reveal on Scroll
(function() {
    const faqSection = document.getElementById('faq');
    const faqCards = document.querySelectorAll('[data-faq-card]');
    let faqHasTriggered = false;
    let currentRevealedCard = null;

    function revealFaqCards() {
        if (faqSection && !faqHasTriggered) {
            const sectionRect = faqSection.getBoundingClientRect();
            const screenBottom = window.innerHeight;
            
            // Check if section is in viewport
            if (sectionRect.top < screenBottom && sectionRect.bottom > 0) {
                faqHasTriggered = true;
                
                // Reveal cards one by one sequentially
                faqCards.forEach((card, index) => {
                    setTimeout(() => {
                        // Close previous card before opening new one
                        if (currentRevealedCard && currentRevealedCard !== card) {
                            currentRevealedCard.classList.remove('active-reveal');
                        }
                        
                        // Open current card
                        card.classList.add('active-reveal');
                        currentRevealedCard = card;
                        
                        // Close after 3 seconds unless hovering
                        setTimeout(() => {
                            if (!card.matches(':hover') && currentRevealedCard === card) {
                                card.classList.remove('active-reveal');
                                currentRevealedCard = null;
                            }
                        }, 3000);
                    }, index * 3600); // Each card: 3.6 seconds (3s display + 0.6s transition)
                });
            }
        }
    }

    // Listen for scroll events
    window.addEventListener('scroll', revealFaqCards);
    
    // Call once on page load in case section is already visible
    revealFaqCards();
    
    // Keep hover functionality working
    faqCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            // Close any previously revealed card
            if (currentRevealedCard && currentRevealedCard !== card) {
                currentRevealedCard.classList.remove('active-reveal');
            }
            card.classList.add('active-reveal');
            currentRevealedCard = card;
        });
        card.addEventListener('mouseleave', () => {
            card.classList.remove('active-reveal');
            if (currentRevealedCard === card) {
                currentRevealedCard = null;
            }
        });
    });
})();

        (function () {
  const carousel  = document.getElementById('heroCarousel');
  const slides    = carousel.querySelectorAll('.hc-slide');
  const dotsWrap  = document.getElementById('heroDots');
  const barEl     = document.getElementById('heroProgressBar');
  const currentEl = document.getElementById('heroCurrent');
  const totalEl   = document.getElementById('heroTotal');
  const INTERVAL  = 6000;
  let current = 0, timer, barTimer;
 
  totalEl.textContent = slides.length;
  slides[0].classList.add('active');
 
  slides.forEach((_, i) => {
    const d = document.createElement('button');
    d.className = 'hc-dot' + (i === 0 ? ' active' : '');
    d.setAttribute('aria-label', `Go to slide ${i + 1}`);
    d.onclick = () => { goTo(i); startAuto(); };
    dotsWrap.appendChild(d);
  });
 
  function goTo(n) {
    slides[current].classList.remove('active');
    dotsWrap.children[current].classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current].classList.add('active');
    dotsWrap.children[current].classList.add('active');
    currentEl.textContent = current + 1;
    resetProgress();
  }
 
  function resetProgress() {
    barEl.classList.remove('running');
    barEl.style.transition = 'none';
    barEl.style.width = '0%';
    clearTimeout(barTimer);
    barTimer = setTimeout(() => barEl.classList.add('running'), 30);
  }
 
  function startAuto() {
    clearInterval(timer);
    timer = setInterval(() => heroMove(1), INTERVAL);
  }
 
  window.heroMove = function (dir) { goTo(current + dir); startAuto(); };
 
  carousel.addEventListener('mouseenter', () => clearInterval(timer));
  carousel.addEventListener('mouseleave', startAuto);
 
  document.addEventListener('keydown', e => {
    if (e.key === 'ArrowLeft')  heroMove(-1);
    if (e.key === 'ArrowRight') heroMove(1);
  });
 
  let touchX = 0;
  carousel.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; });
  carousel.addEventListener('touchend',   e => {
    const dx = e.changedTouches[0].clientX - touchX;
    if (Math.abs(dx) > 50) heroMove(dx < 0 ? 1 : -1);
  });
 
  resetProgress();
  startAuto();
})();
    </script>

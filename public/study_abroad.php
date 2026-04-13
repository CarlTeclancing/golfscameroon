<?php
$page_title = 'Study Abroad';
require_once __DIR__ . '/../config/components.php';
require_once __DIR__ . '/../config/data.php';
include __DIR__ . '/header.php';
?>
<?php
$studyPrograms = get_program_offered();
$topChineseUniversities = get_top_chinese_universities();
?>
<style>
  .study-abroad-hero {
    background-image: linear-gradient(rgba(32, 34, 33, 0.4), rgba(32, 32, 32, 0.6)), url('<?php echo asset_url('uploads/china_image.png'); ?>');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }
  .study-abroad-hero img {
    border-radius: 2rem;
    max-width: 100%;
    object-fit: cover;
  }
  .smartest-way,.top-uni{
     background-image: linear-gradient(#167347E5, #122A1F);
  }
   .way-1{
    background-image: linear-gradient(#009F5E), url('uploads/SVG.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-size:8px;
  }
   .way-2{
    background-image: linear-gradient(#D17E00), url('uploads/SVG1.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-size:8px;
  }
   .way-3{
    background-image: linear-gradient(#D17E00), url('uploads/SVG2.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-size:8px;
  }
   .way-4{
    background-image: linear-gradient(#FF5151), url('uploads/SVG3.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-size:8px;
  }
  .program-card {
  position: relative;
  width: 350px;
  height: 500px;
  border-radius: 20px;
  overflow: hidden; /* Clips the green box to the rounded corners */
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  font-family: sans-serif;
}

.program-bg {
  width: 100%;
  height: 70%;
}

.program-content-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%; 
  height: 50%; 
  background: linear-gradient(135deg, #1e6b45 0%, #113222 100%);
  color: white;
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start; 
  box-sizing: border-box;
}

  .university-carousel {
    position: relative;
    overflow: hidden;
    margin-top: 2rem;
  }
  .university-track {
    display: flex;
    gap: 1.5rem;
    transition: transform 0.6s ease;
    will-change: transform;
    padding-bottom: 1rem;
  }
  .uni-card {
    position: relative;
    flex: 0 0 320px;
    min-height: 460px;
    border-radius: 2rem;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.35s ease, box-shadow 0.35s ease;
  }
  .uni-card.active,
  .uni-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 55px rgba(15, 23, 42, 0.18);
  }
  .uni-card__image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.85);
    transition: filter 0.4s ease;
  }
  .uni-card.active .uni-card__image,
  .uni-card:hover .uni-card__image {
    filter: brightness(0.58);
  }
  .uni-card__info {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 1.5rem;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.45) 40%, rgba(0,0,0,0.88) 100%);
    opacity: 0;
    transform: translateY(18px);
    transition: opacity 0.35s ease, transform 0.35s ease;
  }
  .uni-card.active .uni-card__info,
  .uni-card:hover .uni-card__info {
    opacity: 1;
    transform: translateY(0);
  }
  .uni-card__name {
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 0.65rem;
    color: #ffffff;
  }
  .uni-card__desc {
    font-size: 0.95rem;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.92);
  }
  .uni-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    pointer-events: none;
    transform: translateY(-50%);
  }
  .uni-button {
    pointer-events: auto;
    border: none;
    background: rgba(255, 255, 255, 0.92);
    color: #14532d;
    width: 3rem;
    height: 3rem;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.05rem;
    cursor: pointer;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    transition: transform 0.2s ease, background 0.2s ease;
  }
  .uni-button:hover {
    transform: scale(1.08);
    background: #ffffff;
  }
  @media (max-width: 1024px) {
    .program-grid { grid-template-columns: 1fr; }
    .uni-card { flex: 0 0 280px; }
  }
  @media (max-width: 767px) {
    .study-abroad-hero { grid-template-columns: 1fr; text-align: center; padding: 3rem 1rem; }
    .study-abroad-hero img { margin: 0 auto; width: min(320px, 100%); height: auto; }
    .program-card__content { padding: 1.6rem; }
    .uni-nav { display: none; }
    .program-grid { gap: 1.5rem; }
  }
  .end-section{
    background:#E8F3ED;
  }
</style>

  <!-- Hero Section -->
<header class="study-abroad-hero  grid grid-cols-2 items-center text-center" data-reveal>
    <div class=" mx-auto px-6 text-left" data-reveal>
      <div class="flex justify-center items-center gap-2 ">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-2 sm:mb-4  ">Study In China</h1>
        <img src="uploads/plane.png" alt="plane" class="w-30 h-20 object-contain mb-4 hidden sm:block">
      </div>
      <p class="text-lg md:text-xl text-green-100 max-w-3xl mx-auto mb-8">Unlock world-class education opportunities in China through fully and partially funded scholarships. We guide you every step of the way, from application to admission making your dream of studying abroad simple, accessible, and achievable..</p>
      <button>Explore Program</button>
    </div>
    <img src="uploads/graduate.png" alt="graduate " className="w-96 h-96 mx-auto hidden sm:block">
  </header>


  <main class=" ">
    <!-- counters Sections -->
  <section class="flex justify-center items-center mx-auto my-16 w-full sm:w-3/4" data-reveal>
        <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <?php 
            $stats = [
                ['num' => '20+', 'label' => 'Universities'],
                ['num' => '98%', 'label' => 'admit rate'],
                ['num' => '50+', 'label' => 'Enrolled Learners'],
                ['num' => '500,000 FCFA', 'label' => 'Saved with our procedure']
            ];
            foreach ($stats as $stat): ?>
            <div class="group" data-reveal>
                <h2 class="text-4xl font-extrabold text-green-600 mb-2 group-hover:scale-110 transition-transform"><?php echo $stat['num']; ?></h2>
                <p class="text-gray-400 text-xs uppercase tracking-widest font-semibold"><?php echo $stat['label']; ?></p>
            </div>
            <?php endforeach; ?>
            
        </div>
    </section>
    <!-- Intro Section /Smartest way-->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 text-center mb-20 px-8 sm:px-24 py-8 sm:py-20 bg-green-700  smartest-way" data-reveal>
      <div class="text-left text-white px-6 py-12">
        <h2 class="text-3xl md:text-5xl font-bold text-white mt-2 mb-6">The smartest way to study in China</h2>
       <p class=" text-lg max-w-4xl mx-auto leading-relaxed">Studying in China isn’t complicated but doing it the wrong way can be costly. Avoid fake programs and misleading information by getting trusted guidance from the</p>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-4 ">
        <p class="mt-6 p-2 w-38 border-2 border-green-700 bg-white rounded-lg flex justify-center items-center gap-2 text-black  ">
          <a href="" class="font-bold text-xl cursor-pointer">
            Talk to our counselor
          </a>
          <i class="bi bi-chevron-right"></i>
        </p>
         <p class="mt-6 p-2 w-38 border-2 border-green-700 rounded-lg flex justify-center items-center gap-2">
          <a href="" class="font-bold text-xl cursor-pointer">
          Explore Programs
          </a>
          <i class="bi bi-chevron-right"></i>
        </p>
       </div>
      
      </div>
      
       <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white flex  h-40  items-center justify-center rounded-lg overflow-hidden">
          <p class="w-full px-4 text-4xl font-bold text-green-700 flex justify-center items-center">01</p>
          <div class=" text-white way-1  h-full w-full flex flex-col justify-center items-center gap-2 p-2">
            <p>Understand available scholarships and eligibility requirements</p>
          </div>
        </div>
         <div class="bg-white flex  h-40  items-center justify-center rounded-lg overflow-hidden">
          <p class="w-full px-4 text-4xl font-bold text-green-700 flex justify-center items-center">02</p>
          <div class=" text-white way-2  h-full w-full flex flex-col justify-center items-center gap-2" p-2>
            <p>Select accredited universities and the best programs for your goals.</p>
          </div>
        </div>
        <div class="bg-white flex  h-40  items-center justify-center rounded-lg overflow-hidden">
          <p class="w-full px-4 text-4xl font-bold text-green-700 flex justify-center items-center">03</p>
          <div class=" text-white way-3  h-full w-full flex flex-col justify-center items-center gap-2 p-2">
            <p>Submit all required documents and complete application package.</p>
          </div>
        
        </div>
        <div class="bg-white flex  h-40  items-center justify-center rounded-lg overflow-hidden">
          <p class="w-full px-4 text-4xl font-bold text-green-700 flex justify-center items-center">04</p>
          <div class=" text-white way-4  h-full w-full flex flex-col justify-center items-center gap-2 p-2">
            <p>Apply and stay on track through admission and visa processes. </p>
          </div>
        </div>
       </div>
    </section>

    <!-- Study Abroad Programs -->
    <section id="programs-offered" class=" px-8 sm:px-12 py-8 sm:py-20" data-reveal>
      <div class="text-center mb-10">
        <p class="text-2xl sm:text-4xl font-bold text-green-700">Programs offered</p>
        <p class="mt-4 text-gray-600 max-w-3xl mx-auto">Explore the best study abroad pathways in China with strong scholarship support, seamless applications, and full student guidance.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 justify-center items-center ">
        <?php foreach ($studyPrograms as $program): ?>
          <?php render_program_offered($program); ?>
        <?php endforeach; ?>
      </div>

        <!-- partners -->

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center items-center p "> 
         <div class="grid grid-cols-4 gap-2 ">
          <img src="<?php echo asset_url('uploads/northernu.png'); ?>" alt="partners" class=" h-20 object-cover mt-12">
            <img src="<?php echo asset_url('uploads/SRH.png'); ?>" alt="partners" class="h-20 object-cover mt-12">
             <img src="<?php echo asset_url('uploads/PSB.png'); ?>" alt="partners" class="h-20 object-cover mt-12">
             <img src="<?php echo asset_url('uploads/drexel.png'); ?>" alt="partners" class="h-20 object-cover mt-12">
         </div>
          <div class="">
            <p class="text-2xl"> <span class="font-bold text-green-400"><br> 10+ national & international</span>  partners for your study abroad
journey</p>
            <p></p>
          </div>
        </div>
    </section>

    <!-- Top Chinese Universities Carousel -->
    <section class="py-16 px-8 md:px-12 top-uni" data-reveal>
      
      <div class="text-center mb-12">
      <h1 class="text-2xl sm:text-4xl font-bold text-white  text-center mb-6 capitalize">
        Some of the top China universities offering these programs include
      </h1>
      </div>
      <div class="university-carousel">
        <div class="university-track">
          <?php foreach ($topChineseUniversities as $index => $uni): ?>
            <?php render_university_card($uni, $index === 0, $index); ?>
          <?php endforeach; ?>
        </div>
        <div class="uni-nav">
          <button class="uni-button uni-prev" aria-label="Previous university"><i class="bi bi-chevron-left"></i></button>
          <button class="uni-button uni-next" aria-label="Next university"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>
    </section>

   <!-- Why choose us -->

   <section  class="px-8 sm:px-24 py-10 ">
        <h1 class="text-3xl sm:text-8xl text-green-700 font-semibold w-full sm:w-1/2 ">Why Choose Us ?</h1> 
        <div class="flex justify-end">
          <div class=" border-4  rounded-lg leading-[2] p-4 w-1/2 flex flex-col gap-4">
            <p class="flex items-center gap-2">
              <img src="<?php echo asset_url('uploads/check.png'); ?>" alt="Why Choose Us" class="w-4 h-4 object-cover">
              <span class="text-green-700 text-xl">We do pickups for all international students, payable</span>
            </p>
             <p class="flex items-center gap-2">
              <img src="<?php echo asset_url('uploads/check.png'); ?>" alt="Why Choose Us" class="w-4 h-4 object-cover">
              <span class="text-green-700 text-xl">We ensure their security is our priority.</span>
            </p>
            <p class="flex items-center gap-2">
              <img src="<?php echo asset_url('uploads/check.png'); ?>" alt="Why Choose Us" class="w-4 h-4 object-cover">
              <span class="text-green-700 text-xl">Monthly stipule form the university based on academic performance</span>
            </p>
            <p class="flex items-center gap-2">
              <img src="<?php echo asset_url('uploads/check.png'); ?>" alt="Why Choose Us" class="w-4 h-4 object-cover">
              <span class="text-green-700 text-xl">We ensure accommodations are fixed partially free </span>
            </p>
          </div>
        </div>
        <div>
          <h1 class="text-2x sm:text-4xl text-green-700 font-extrabold">Students Testimonials</h1>
           <p class="text-2xl text-gray-600 my-2">
            From learners to <span class="text-green-700">achievers</span> 
           </p>
           <p class='text-sm text-gray-600'>
            Hear from our learners who have turned their study-abroad dreams into reality. If they can, so can you!
           </p>
        </div>
        

   </section>
   <!-- ///// -->
   <section class="grid grid-cols-1 md:grid-cols-2 end-section my-8 sm:my-16" data-reveal>
       <img src="<?php echo asset_url('uploads/graduation.jpg'); ?>" alt="testimonial" class="w-full  object-cover">
       <div class="px-8 py-4 flex flex-col justify-center  items-start ">
        <p class="text-2xl"><span class="text-green-600"> 30+ Learners</span> have trusted us </p>
        <p class="text-gray-400 ">Advance your career with our expert guidance & global programs.</p>
        <button class="p-4 rounded-xl bg-green-700 text-white font-bold mt-4">
          Download Brochure
        </button>
       </div>
   </section>
  </main>

  <script>
    (function() {
      const track = document.querySelector('.university-track');
      const cards = Array.from(document.querySelectorAll('.uni-card'));
      const prevButton = document.querySelector('.uni-prev');
      const nextButton = document.querySelector('.uni-next');
      let activeIndex = 0;
      let intervalId;

      function updateCarousel(index) {
        activeIndex = (index + cards.length) % cards.length;
        const cardWidth = cards[0].offsetWidth + 24;
        track.style.transform = `translateX(${-activeIndex * cardWidth}px)`;
        cards.forEach((card, idx) => card.classList.toggle('active', idx === activeIndex));
      }

      function startAutoPlay() {
        intervalId = setInterval(() => {
          updateCarousel(activeIndex + 1);
        }, 4500);
      }

      function stopAutoPlay() {
        clearInterval(intervalId);
      }

      prevButton.addEventListener('click', () => {
        stopAutoPlay();
        updateCarousel(activeIndex - 1);
        startAutoPlay();
      });

      nextButton.addEventListener('click', () => {
        stopAutoPlay();
        updateCarousel(activeIndex + 1);
        startAutoPlay();
      });

      cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
          stopAutoPlay();
          updateCarousel(Number(card.dataset.index));
        });
        card.addEventListener('mouseleave', startAutoPlay);
      });

      window.addEventListener('resize', () => updateCarousel(activeIndex));
      updateCarousel(activeIndex);
      startAutoPlay();
    })();
  </script>
<?php include __DIR__ . '/footer.php'; ?>

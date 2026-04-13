<style>
    .scard {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    height: 500px;
    cursor: pointer;
    background: #111;
}

.scard-img {
    width: 100%;
    height: 100%;
    object-fit: center;
    display: block;
    transition: transform 0.5s ease;
}

.scard:hover .scard-img {
    transform: scale(1.07);
}

/* default gradient — dark at bottom so title is always readable */
.scard-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.82) 0%,
        rgba(0,0,0,0.35) 45%,
        rgba(0,0,0,0.08) 100%
    );
    transition: background 0.4s ease;
}

/* on hover shift to a green tint matching your brand */
.scard:hover .scard-gradient {
    background: linear-gradient(
        to top,
        rgba(10, 60, 20, 0.92) 0%,
        rgba(10, 60, 20, 0.58) 50%,
        rgba(0, 0, 0, 0.15) 100%
    );
}

.scard-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px;
}

.scard-title {
    font-size: 2rem;
    font-weight: 600;
    color: #fff;
    margin: 0;
}

/* hidden by default, revealed on hover */
.scard-reveal {
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transition: max-height 0.4s ease, opacity 0.35s ease;
}

.scard:hover .scard-reveal {
    max-height: 140px;
    opacity: 1;
}

.scard-desc {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.6;
    margin: 8px 0 12px;
}

.scard-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #fff;
    background: #b91c1c;
    border-radius: 6px;
    padding: 7px 14px;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s;
}

.scard-btn:hover {
    background: #991b1b;
    transform: translateX(2px);
}
</style>
<?php

function render_info_cards($cards) {
    ?>
    <div class="grid md:grid-cols-3 gap-6 my-12">
        
        <?php foreach ($cards as $card): ?>
            <div class="text-left">
                <h3 class="font-bold text-2xl px-2"><?php echo e($card['title']); ?></h3>
                <img src="<?php echo asset_url('uploads/Vector.jpg'); ?>" alt="green line" class="w-20">
                <p class="mt-2 text-sm sm:text-lg text-gray-600 leading-[2]"><?php echo e($card['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function render_hero_slide($slide) {
    ?>
    <div class="hc-slide">
      <div class="hc-bg-img" style="background-image:url('<?php echo asset_url('uploads/' . $slide['image']); ?>')"></div>
      <div class="hc-overlay"></div>
      <div class="hc-inner">
        <div class="hc-text">
          <span class="hc-tag">
            <i class="bi <?php echo $slide['tag']['icon']; ?>"></i>
            <?php echo $slide['tag']['label']; ?>
          </span>
          <h1 class="hc-title"><?php echo $slide['title']; ?></h1>
          <p class="hc-desc"><?php echo $slide['desc']; ?></p>
          <div class="hc-actions">
            <?php foreach ($slide['buttons'] as $btn): ?>
              <?php if ($btn['href']): ?>
                <a href="<?php echo $btn['href']; ?>" class="btn-<?php echo $btn['style']; ?>">
                  <i class="bi <?php echo $btn['icon']; ?>"></i>
                  <?php echo $btn['label']; ?>
                </a>
              <?php else: ?>
                <button onclick="<?php echo htmlspecialchars($btn['onclick']); ?>" class="btn-<?php echo $btn['style']; ?>">
                  <i class="bi <?php echo $btn['icon']; ?>"></i>
                  <?php echo $btn['label']; ?>
                </button>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="hc-img-wrap">
          <div class="hc-card">
            <img src="<?php echo asset_url('uploads/' . $slide['image']); ?>" alt="<?php echo htmlspecialchars($slide['alt']); ?>">
          </div>
        </div>
      </div>
    </div>
    <?php
}

function render_service_card($service) {
    ?>
    <div class="scard" data-reveal>
        <div class="scard-img-wrapper">
            <img 
                src="<?php echo asset_url($service['image']); ?>" 
                alt="<?php echo e($service['title']); ?>" 
                class="scard-img"
            >
        </div>

        <div class="scard-gradient"></div>

        <div class="scard-content">
            <h3 class="scard-title flex justify-between items-center">
                <span><?php echo e($service['title']); ?></span>
                <a href="<?php echo base_url('services'); ?>" class="scard-btn">
                   <i class="bi bi-chevron-right scard-icon"></i>
                </a> 
            </h3>

            <div class="scard-reveal">
                <p class="scard-desc">
                    <?php echo e($service['description']); ?>
                </p>
            </div>
        </div>
    </div>
    <?php
}



function render_stat_card($stat) {
    ?>
    <article data-reveal>
        <h2 class="font-bold text-green-700 text-center text-4xl"><?php echo e($stat['number']); ?></h2>
        <p class="text-sm sm:text-lg text-gray-600 mt-2 text-center leading-[2]"><?php echo e($stat['description']); ?></p>
    </article>
    <?php
}

function render_involvement_card($card, $image_on_left = true) {
    ?>
    <div class="group aspect-square involvement-card overflow-hidden grid sm:grid-cols-2 h-auto sm:h-[250px] mb-8" data-reveal>
        
        <?php if ($image_on_left): ?>
            <div class="aspect-square relative overflow-hidden h-96 sm:h-full">
                <img src="<?php echo asset_url($card['image']); ?>"
                     alt="<?php echo e($card['title']); ?>"
                     class="w-full h-[400px] transition-transform duration-500 group-hover:scale-110">
                <!-- <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div> -->
            </div>
        <?php endif; ?>

        <div class="px-4 py-2 w-full flex flex-col justify-center <?php echo $image_on_left ? '' : 'sm:order-first'; ?>">
            <div>
                <div class="flex items-center gap-3 mb-1 sm:mb-2">
                    <span>
                   <img src="<?php echo asset_url($card['icon']); ?>" alt="" class="w-12 h-12 object-contain"> 
                </span>
                <h3 class="font-bold text-2xl sm:text-3xl text-green-700 mb-3"><?php echo e($card['title']); ?></h3>
                </div>
                
                <p class="text-gray-600 mb-5 text-sm sm:text-xl leading-relaxed line-clamp-3">
                    <?php echo e($card['description']); ?>
                </p>
                <a href="<?php echo base_url($card['link']); ?>"
                   class="inline-block bg-green-700 text-white px-6 py-2.5 rounded-lg transition-all duration-300 font-bold hover:bg-red-800 w-fit text-xs uppercase tracking-wider">
                    <?php echo e($card['button_text'] ?? 'Learn More'); ?>
                </a>
            </div>
        </div>

        <?php if (!$image_on_left): ?>
            <div class="relative overflow-hidden h-56 sm:h-full">
                <img src="<?php echo asset_url($card['image']); ?>"
                     alt="<?php echo e($card['title']); ?>"
                     class="w-full h96 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
        <?php endif; ?>

    </div>
    <?php
}

function render_faq_card($faq) {
    ?>
    <div class="text-left">
        <h3 class="font-bold text-2xl mb-4 text-green-700"><?php echo e($faq['question']); ?></h3>
        <p class="mt-2 text-lg text-gray-600 leading-[2]"><?php echo e($faq['answer']); ?></p>
    </div>
    <?php
}


function render_focus_area($area, $image_on_left = true) {
    ?>
    <section id="<?php echo e($area['id']); ?>" class="py-16 mb-16" data-reveal>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <?php if ($image_on_left): ?>
                <div class="relative overflow-hidden shadow-2xl group p-2 bg-white">
                    <img src="<?php echo asset_url($area['image']); ?>" alt="<?php echo e($area['title']); ?>" class="w-full h-96 group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            <?php endif; ?>

            <div class="<?php echo $image_on_left ? '' : 'md:order-first'; ?>">
                <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold mb-3"><?php echo e($area['subtitle']); ?></span>
                <h3 class="font-bold text-3xl md:text-4xl text-green-700 mb-4"><?php echo e($area['title']); ?></h3>
                <p class="text-gray-600 text-lg leading-relaxed mb-6"><?php echo e($area['content']); ?></p>
                
                <div class="mb-6">
                    <h4 class="font-bold text-xl text-green-700 mb-3 flex items-center">
                        <i class="bi bi-check-circle-fill mr-2"></i> What We Do
                    </h4>
                    <ul class="space-y-3">
                        <?php foreach ($area['what_we_do'] as $item): ?>
                            <li class="flex items-start text-gray-700">
                                <span class="text-green-600 mr-3 mt-1">•</span>
                                <span><?php echo e($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-white rounded-xl p-6 border-l-4 border-green-600">
                    <h4 class="font-bold text-lg text-green-700 mb-2">Why It Matters</h4>
                    <p class="text-gray-700 leading-relaxed"><?php echo e($area['why_it_matters']); ?></p>
                </div>
            </div>

            <?php if (!$image_on_left): ?>
                <div class="relative overflow-hidden p-2 shadow-2xl group">
                    <img src="<?php echo asset_url($area['image']); ?>" alt="<?php echo e($area['title']); ?>" class="object-cover w-full h-96 group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

function render_testimonial_carousel($testimonials) {
    ?>
      
      <div class="testimonial-carousel max-w-4xl mx-auto">
        <div class="testimonial-track">
          <?php foreach ($testimonials as $index => $testimonial): ?>
            <div class="testimonial-slide<?php echo $index === 0 ? ' active' : ''; ?>" data-index="<?php echo $index; ?>">
              <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10 border border-gray-100">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                  <div class="">
                    <img src="<?php echo asset_url($testimonial['image']); ?>" alt="<?php echo e($testimonial['name']); ?>" class="w-56 h-full">
                  </div>
                  <div class="flex-1 text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-3">
                      <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                        <i class="bi bi-star-fill text-yellow-400"></i>
                      <?php endfor; ?>
                    </div>
                    <blockquote class="text-gray-700 text-lg leading-relaxed mb-6 italic">
                      "<?php echo e($testimonial['testimonial']); ?>"
                    </blockquote>
                    <div>
                      <h4 class="font-bold text-green-700 text-lg"><?php echo e($testimonial['name']); ?></h4>
                      <p class="text-gray-600 text-sm"><?php echo e($testimonial['program']); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="testimonial-nav mt-8 flex justify-center gap-4">
          <button class="testimonial-prev bg-green-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors" aria-label="Previous testimonial">
            <i class="bi bi-chevron-up"></i>
          </button>
          <div class="testimonial-dots flex gap-2">
            <?php foreach ($testimonials as $index => $testimonial): ?>
              <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 hover:bg-green-600 transition-colors<?php echo $index === 0 ? ' bg-green-600' : ''; ?>" data-index="<?php echo $index; ?>"></button>
            <?php endforeach; ?>
          </div>
          <button class="testimonial-next bg-green-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors" aria-label="Next testimonial">
            <i class="bi bi-chevron-down"></i>
          </button>
        </div>
      </div>
    <?php
}

/**
 * Service Feature Card - For bottom service features section
 */
function render_service_feature($feature) {
    ?>
    <div class="p-6 bg-white rounded shadow hover:shadow-lg hover:bg-gradient-to-br hover:from-green-50 hover:to-white transition-all duration-300 transform hover:-translate-y-1 group cursor-default">
        <h4 class="font-semibold text-green-700 group-hover:text-red-700 transition-colors duration-300"><?php echo e($feature['title']); ?></h4>
        <p class="mt-2 text-sm text-gray-600 group-hover:text-gray-700 transition-colors duration-300"><?php echo e($feature['description']); ?></p>
        <div class="h-1 w-0 bg-green-600 group-hover:w-full transition-all duration-300 mt-3"></div>
    </div>
    <?php
}

// ============= travel abroad page

function render_travel_program($program){
    ?>
    <div class="">
      <img src="<?php echo asset_url($program['image']); ?>" alt="<?php echo e($program['title']); ?>" class="w-full h-48 object-cover rounded-lg mb-4">

       <div>
        <i class="<?php echo $program['icon'];?>" ></i>
        <h3 class="font-bold text-xl text-green-700 mb-2"><?php echo e($program['title']); ?></h3>
      <p class="text-gray-600 text-sm mb-4"><?php echo e($program['details']); ?></p>
       </div>

    </div>
    <?php
}
function render_program_offered($program) {
    ?>
    <div class="program-card" data-reveal>
      <img src="<?php echo asset_url($program['image']); ?>" alt="<?php echo e($program['title']); ?>" class="program-bg">
      <div class="program-content-overlay">
        <div class="">
        <div>
          <div class="text-green-700 w-14 h-14 bg-white flex justify-center items-center rounded-xl mb-4">
            <i class="bi <?php echo e($program['icon']); ?> text-2xl"></i>
          </div>
          <h3 class="text-2xl sm:5xl"><?php echo e($program['title']); ?></h3>
          <p class=""><?php echo e($program['details']); ?></p>
        </div>
      </div>
      
      </div>
    </div>
    <?php
}

function render_university_card($university, $active = false, $index = 0) {
    ?>
    <article class="uni-card<?php echo $active ? ' active' : ''; ?>" data-index="<?php echo e($index); ?>">
      <img src="<?php echo asset_url($university['image']); ?>" alt="<?php echo e($university['name']); ?>" class="uni-card__image">
      <div class="uni-card__info">
        <h3 class="uni-card__name"><?php echo e($university['name']); ?></h3>
        <p class="uni-card__desc"><?php echo e($university['description']); ?></p>
      </div>
    </article>
    <?php
}
?>



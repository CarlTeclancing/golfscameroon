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
    <div class="group bg-white rounded shadow shadow-sm overflow-hidden   block" data-reveal>
        <div class="relative overflow-hidden h-3/5">
            <img src="<?php echo asset_url($service['image']); ?>" alt="<?php echo e($service['title']); ?>" class="h-full w-full  group-hover:scale-110 transition-transform duration-300">
        </div>
        <div class="px-2 py-3">
            <h3 class="font-semibold text-xl text-green-700 flex justify-between items-center ">
                <span><?php echo e($service['title']); ?></span>
               <a  href="<?php echo base_url('services'); ?>"><i class="bi bi-chevron-right text-green-700 group-hover:text-red-700 group-hover:translate-x-1 transition-all duration-300"></i></a> 
            </h3>
            <p class="text-sm sm:text-md text-gray-600 mt-2 line-clamp-2 leading-[2]"><?php echo e($service['description']); ?></p>
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

function render_involvement_card($card) {
    ?>
     <div class="involvement-card bg-white rounded-sm shadow-lg overflow-hidden grid sm:grid-cols-2 h-[200px]" data-reveal>
        <img src="<?php echo asset_url($card['image']); ?>"
             alt="<?php echo e($card['title']); ?>"
             class="w-full h-full object-cover">
        <div class="p-6 w-full flex flex-col justify-between">
            <div>
                <h3 class="font-semibold text-xl text-green-700 mb-3"><?php echo e($card['title']); ?></h3>
                <p class="text-gray-600 mb-4 text-sm leading-relaxed"><?php echo e($card['description']); ?></p>
                <a href="<?php echo base_url($card['link']); ?>"
               class="inline-block bg-red-700 text-white px-5 py-2 rounded-lg transition font-medium hover:bg-red-800 w-fit text-center">
                <?php echo e($card['button_text']); ?>
            </a>
            </div>
            
        </div>
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
?>

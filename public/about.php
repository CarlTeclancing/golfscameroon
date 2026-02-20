<?php $page_title = 'About'; include __DIR__ . '/header.php'; ?>

<style>
  .about-hero {
    background-image: linear-gradient(rgba(22, 78, 58, 0.85), rgba(22, 78, 58, 0.75)), url('uploads/hands_smile.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }
  .value-card:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
  }
</style>

  <!-- Hero Section -->
  <header class="about-hero py-20 md:py-32">
    <div class="max-w-5xl mx-auto px-6 text-center" data-reveal>
      <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">About Golfs Cameroon</h1>
      <p class="text-lg md:text-xl text-green-50 max-w-3xl mx-auto leading-relaxed">
        Empowering youth through education, mentorship, and community-driven projects across Cameroon.
      </p>
      <div class="mt-10 flex gap-4 justify-center">
        <a href="<?php echo base_url('contact'); ?>" class="bg-white text-green-700 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition duration-300 transform hover:scale-105">
          Get in Touch
        </a>
        <a href="<?php echo base_url('donations'); ?>" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-green-700 transition duration-300">
          Support Our Mission
        </a>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-16">
    
    <!-- Mission & Vision -->
    <section class="grid md:grid-cols-2 gap-12 items-center mb-20" data-reveal>
      <div>
        <img src="<?php echo asset_url('uploads/initiative.jpg'); ?>" alt="Youth empowerment" class="rounded-2xl shadow-2xl w-full h-80 object-cover transform -rotate-3 hover:rotate-0 transition duration-500">
      </div>
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-6">Our Mission & Vision</h2>
        <div class="space-y-6">
          <div class="border-l-4 border-green-600 pl-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Mission</h3>
            <p class="text-gray-600 leading-relaxed">
              To empower Cameroonian youth with the skills, knowledge, and opportunities they need to become leaders, entrepreneurs, and positive change-makers in their communities.
            </p>
          </div>
          <div class="border-l-4 border-red-600 pl-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Vision</h3>
            <p class="text-gray-600 leading-relaxed">
              A Cameroon where every young person has the opportunity to thrive, lead, and build prosperous, resilient communities.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Organization History -->
    <section class="bg-gradient-to-br from-green-50 to-white rounded-3xl p-8 md:p-12 mb-20 shadow-lg" data-reveal>
      <div class="text-center max-w-4xl mx-auto">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Our Story</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2 mb-6">Our Journey</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-6">
          Golfs Cameroon began as a grassroots community initiative focused on youth development in underserved areas. 
          What started as small mentorship circles has grown into a comprehensive youth empowerment organization.
        </p>
        <p class="text-gray-600 text-lg leading-relaxed">
          Over the years, we've expanded our programs to align with the <strong class="text-green-700">UN Sustainable Development Goals</strong>, 
          particularly focusing on <strong class="text-green-700">Quality Education (SDG 4)</strong> and 
          <strong class="text-green-700">Reduced Inequalities (SDG 10)</strong>. Today, we continue to break barriers 
          and create pathways for young people to realize their full potential.
        </p>
      </div>
    </section>

    <!-- Statistics -->
    <section class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-20" data-reveal>
      <div class="stat-card bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-md transition-all duration-300">
        <div class="text-4xl md:text-5xl font-bold text-green-600 mb-2">500+</div>
        <div class="text-gray-600 text-sm md:text-base">Youth Reached</div>
      </div>
      <div class="stat-card bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-md transition-all duration-300">
        <div class="text-4xl md:text-5xl font-bold text-red-600 mb-2">50+</div>
        <div class="text-gray-600 text-sm md:text-base">Workshops</div>
      </div>
      <div class="stat-card bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-md transition-all duration-300">
        <div class="text-4xl md:text-5xl font-bold text-green-600 mb-2">20+</div>
        <div class="text-gray-600 text-sm md:text-base">Partner Schools</div>
      </div>
      <div class="stat-card bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-md transition-all duration-300">
        <div class="text-4xl md:text-5xl font-bold text-red-600 mb-2">100%</div>
        <div class="text-gray-600 text-sm md:text-base">Commitment</div>
      </div>
    </section>

    <!-- Core Values -->
    <section class="mb-20" data-reveal>
      <div class="text-center mb-12">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">What Drives Us</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Our Core Values</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="value-card bg-white rounded-2xl p-8 shadow-lg text-center transition-all duration-300">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-people-fill text-3xl text-green-600"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-3">Community First</h3>
          <p class="text-gray-600">We believe in the power of community-driven solutions and local leadership.</p>
        </div>
        <div class="value-card bg-white rounded-2xl p-8 shadow-lg text-center transition-all duration-300">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-lightbulb-fill text-3xl text-red-600"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-3">Innovation</h3>
          <p class="text-gray-600">We embrace creative approaches to tackle youth development challenges.</p>
        </div>
        <div class="value-card bg-white rounded-2xl p-8 shadow-lg text-center transition-all duration-300">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-heart-fill text-3xl text-green-600"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-3">Integrity</h3>
          <p class="text-gray-600">Transparency, accountability, and honesty guide everything we do.</p>
        </div>
      </div>
    </section>

    <!-- Focus Areas -->
    <!-- <section class="bg-brand text-white rounded-3xl p-8 md:p-16 mb-20" data-reveal>
      <div class="text-center mb-12">
        <span class="text-green-300 font-semibold text-sm uppercase tracking-wider">What We Do</span>
        <h2 class="text-3xl md:text-4xl font-bold mt-2 mb-4">Focus: Youth Development</h2>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">
          Comprehensive programs designed to nurture talent, build confidence, and create opportunities.
        </p>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="text-center">
          <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-chat-dots-fill text-3xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Mentorship</h3>
          <p class="text-green-100 text-sm">One-on-one guidance from experienced professionals and leaders.</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-book-fill text-3xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Education</h3>
          <p class="text-green-100 text-sm">Scholarships and educational support for underserved students.</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-briefcase-fill text-3xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Skills Training</h3>
          <p class="text-green-100 text-sm">Practical workshops in leadership, entrepreneurship, and life skills.</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-people-fill text-3xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Community Projects</h3>
          <p class="text-green-100 text-sm">Youth-led initiatives that address local challenges and create impact.</p>
        </div>
      </div>
    </section> -->

    <!-- Team/Leadership -->
    <section class="mb-20" data-reveal>
      <div class="text-center mb-12">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Leadership</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Meet Our Team</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden text-center group">
          <div class="h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
            <i class="bi bi-person-circle text-8xl text-green-300 group-hover:scale-110 transition duration-300"></i>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800">Founder Name</h3>
            <p class="text-red-600 font-medium text-sm mb-3">Founder & Executive Director</p>
            <p class="text-gray-600 text-sm">Passionate about youth empowerment with over 10 years of experience in community development.</p>
          </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden text-center group">
          <div class="h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
            <i class="bi bi-person-circle text-8xl text-red-300 group-hover:scale-110 transition duration-300"></i>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800">Program Director</h3>
            <p class="text-green-600 font-medium text-sm mb-3">Programs & Operations</p>
            <p class="text-gray-600 text-sm">Dedicated to designing and implementing impactful youth programs across Cameroon.</p>
          </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden text-center group">
          <div class="h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
            <i class="bi bi-person-circle text-8xl text-green-300 group-hover:scale-110 transition duration-300"></i>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800">Community Lead</h3>
            <p class="text-red-600 font-medium text-sm mb-3">Community Engagement</p>
            <p class="text-gray-600 text-sm">Building bridges between youth, families, and community stakeholders.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-3xl p-8 md:p-16 text-center" data-reveal>
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Join Us in Empowering Youth</h2>
      <p class="text-green-100 text-lg max-w-2xl mx-auto mb-8">
        Whether you want to volunteer, partner with us, or support our programs, there's a place for you in this movement.
      </p>
      <div class="flex flex-wrap gap-4 justify-center">
        <a href="<?php echo base_url('members'); ?>" class="bg-white text-green-700 px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition duration-300 transform hover:scale-105 shadow-lg">
          <i class="bi bi-person-plus"></i> Become a Member
        </a>
        <a href="<?php echo base_url('donations'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-700 transition duration-300 shadow-lg">
          <i class="bi bi-heart"></i> Make a Donation
        </a>
      </div>
    </section>

  </main>

<?php include __DIR__ . '/footer.php'; ?>

<?php
$page_title = 'Study Abroad';
require_once __DIR__ . '/../config/components.php';
require_once __DIR__ . '/../config/data.php';
include __DIR__ . '/header.php';
?>
<style>
  .study-abroad-hero {
    background-image: linear-gradient(rgba(32, 34, 33, 0.9), rgba(22, 78, 58, 0.8)), url('uploads/global_patnership.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }
  .program-card {
    transition: all 0.4s ease;
  }
  .program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
  }
  .benefit-box {
    transition: all 0.3s ease;
  }
  .benefit-box:hover {
    background: linear-gradient(135deg, rgba(22, 78, 58, 0.08) 0%, rgba(34, 197, 94, 0.08) 100%);
    transform: translateY(-5px);
  }
</style>

  <!-- Hero Section -->
  <header class="study-abroad-hero py-24 md:py-36">
    <div class="max-w-5xl mx-auto px-6 text-center" data-reveal>
      <span class="inline-block bg-white bg-opacity-20 text-green-100 px-4 py-2 rounded-full text-sm font-semibold mb-4">Global Opportunities</span>
      <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Study Abroad Programs</h1>
      <p class="text-lg md:text-xl text-green-100 max-w-3xl mx-auto mb-8">Unlock global opportunities and expand your horizons with our comprehensive study abroad support and partnership programs.</p>
      <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 inline-block">
        <p class="text-2xl md:text-3xl font-semibold text-white italic">"Expanding Horizons, Building Futures"</p>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-16">
    
    <!-- Intro Section -->
    <section class="text-center mb-20" data-reveal>
      <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">International Education</span>
      <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2 mb-6">Breaking Boundaries in Education</h2>
      <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">The Golfs Cameroon is committed to opening doors for Cameroonian youth to pursue quality education beyond borders. Our study abroad programs provide comprehensive support from application preparation to cultural integration, ensuring every scholar has the tools to succeed globally while maintaining their roots.</p>
    </section>

    <!-- Study Abroad Programs -->
    <section class="py-16 mb-16" data-reveal>
      <div class="text-center mb-12">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Our Programs</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2 mb-6">Pathways to Global Education</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Program 1: Undergraduate Scholarships -->
        <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
          <div class="relative overflow-hidden h-64 bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center">
            <i class="bi bi-mortarboard-fill text-7xl text-white opacity-20"></i>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-8">
            <h3 class="font-bold text-2xl text-green-700 mb-3">Undergraduate Scholarships</h3>
            <p class="text-gray-600 mb-6">Access fully-funded and partial scholarship opportunities at leading universities across North America, Europe, and Africa for high-achieving secondary school graduates.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Academic excellence support</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>University application guidance</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Visa & documentation assistance</span>
              </li>
            </ul>
            <a href="<?php echo base_url('contact'); ?>" class="inline-block bg-red-700 text-white px-6 py-2.5 rounded-lg transition-all duration-300 font-bold hover:bg-red-800 text-xs uppercase tracking-wider">Learn More</a>
          </div>
        </div>

        <!-- Program 2: Graduate Studies -->
        <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
          <div class="relative overflow-hidden h-64 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
            <i class="bi bi-book-fill text-7xl text-white opacity-20"></i>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-8">
            <h3 class="font-bold text-2xl text-green-700 mb-3">Graduate Studies Programs</h3>
            <p class="text-gray-600 mb-6">Pursue advanced degrees at prestigious universities worldwide. We support scholarships and grants for master's and doctoral programs aligned with your career goals.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Research & thesis support</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Career mentoring</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Alumni networking</span>
              </li>
            </ul>
            <a href="<?php echo base_url('contact'); ?>" class="inline-block bg-red-700 text-white px-6 py-2.5 rounded-lg transition-all duration-300 font-bold hover:bg-red-800 text-xs uppercase tracking-wider">Learn More</a>
          </div>
        </div>

        <!-- Program 3: Exchange Programs -->
        <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
          <div class="relative overflow-hidden h-64 bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center">
            <i class="bi bi-globe-americas text-7xl text-white opacity-20"></i>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-8">
            <h3 class="font-bold text-2xl text-green-700 mb-3">International Exchange Programs</h3>
            <p class="text-gray-600 mb-6">Short-term exchange opportunities for cultural immersion and skill development. Spend a semester or year abroad while earning credits toward your degree.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Cultural integration programs</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Language preparation</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Host family placement</span>
              </li>
            </ul>
            <a href="<?php echo base_url('contact'); ?>" class="inline-block bg-red-700 text-white px-6 py-2.5 rounded-lg transition-all duration-300 font-bold hover:bg-red-800 text-xs uppercase tracking-wider">Learn More</a>
          </div>
        </div>

        <!-- Program 4: Professional Development -->
        <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden" data-reveal>
          <div class="relative overflow-hidden h-64 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center">
            <i class="bi bi-briefcase-fill text-7xl text-white opacity-20"></i>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-8">
            <h3 class="font-bold text-2xl text-green-700 mb-3">Professional Development Abroad</h3>
            <p class="text-gray-600 mb-6">Internships, certifications, and professional training programs designed for working professionals and recent graduates seeking career advancement globally.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Internship placement services</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Professional certifications</span>
              </li>
              <li class="flex items-center text-gray-700">
                <i class="bi bi-check-circle-fill text-green-600 mr-3"></i>
                <span>Career coaching</span>
              </li>
            </ul>
            <a href="<?php echo base_url('contact'); ?>" class="inline-block bg-red-700 text-white px-6 py-2.5 rounded-lg transition-all duration-300 font-bold hover:bg-red-800 text-xs uppercase tracking-wider">Learn More</a>
          </div>
        </div>

      </div>
    </section>

    <!-- Key Benefits -->
    <section class="py-16 mb-16" data-reveal>
      <div class="text-center mb-12">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Why Study With Us</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Comprehensive Support Services</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <div class="benefit-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
          <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="bi bi-pencil-square text-3xl text-green-600"></i>
          </div>
          <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300">Application Guidance</h4>
          <p class="text-gray-600">Expert assistance with application essays, recommendation letters, and portfolio preparation to maximize your chances of admission.</p>
          <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
        </div>

        <div class="benefit-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
          <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="bi bi-file-earmark-text text-3xl text-green-600"></i>
          </div>
          <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300">Visa & Documentation</h4>
          <p class="text-gray-600">Navigate visa requirements and immigration paperwork with confidence through our compliance team's expert guidance.</p>
          <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
        </div>

        <div class="benefit-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
          <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="bi bi-people-fill text-3xl text-green-600"></i>
          </div>
          <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300">Community & Mentoring</h4>
          <p class="text-gray-600">Connect with our global network of alumni and mentors who provide guidance and support throughout your journey.</p>
          <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
        </div>

        <div class="benefit-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
          <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="bi bi-cash-coin text-3xl text-green-600"></i>
          </div>
          <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300">Scholarship Opportunities</h4>
          <p class="text-gray-600">Access to comprehensive scholarship databases and funding sources to make your dream education affordable.</p>
          <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
        </div>

        <div class="benefit-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
          <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="bi bi-globe text-3xl text-green-600"></i>
          </div>
          <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300">Language Preparation</h4>
          <p class="text-gray-600">Language courses and proficiency support to ensure you're prepared to study in English-speaking or other-language environments.</p>
          <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
        </div>

        <div class="benefit-box p-8 bg-white rounded-2xl shadow-md text-center group cursor-default">
          <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="bi bi-heart-fill text-3xl text-green-600"></i>
          </div>
          <h4 class="font-semibold text-xl text-green-700 mb-3 group-hover:text-red-700 transition-colors duration-300">Mental Health Support</h4>
          <p class="text-gray-600">Access to counseling and mental wellness resources to support your well-being during your study abroad experience.</p>
          <div class="h-1 w-0 bg-gradient-to-r from-green-500 to-green-700 rounded-full group-hover:w-full transition-all duration-500 mt-4 mx-auto"></div>
        </div>

      </div>
    </section>

    <!-- Application Process -->
    <section class="py-16 mb-16 bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 md:p-12" data-reveal>
      <div class="text-center mb-12">
        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Getting Started</span>
        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mt-2">Simple Application Process</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="text-center" data-reveal>
          <div class="w-12 h-12 bg-green-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
          <h4 class="font-semibold text-lg text-green-700 mb-2">Initial Consultation</h4>
          <p class="text-gray-600 text-sm">Meet with our advisors to discuss your goals and identify the best programs for you.</p>
        </div>
        <div class="text-center" data-reveal>
          <div class="w-12 h-12 bg-green-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
          <h4 class="font-semibold text-lg text-green-700 mb-2">Preparation & Support</h4>
          <p class="text-gray-600 text-sm">Receive comprehensive support with test prep, essays, and documentation requirements.</p>
        </div>
        <div class="text-center" data-reveal>
          <div class="w-12 h-12 bg-green-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
          <h4 class="font-semibold text-lg text-green-700 mb-2">Application Submission</h4>
          <p class="text-gray-600 text-sm">Submit your applications with confidence knowing they're complete and competitive.</p>
        </div>
        <div class="text-center" data-reveal>
          <div class="w-12 h-12 bg-green-700 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
          <h4 class="font-semibold text-lg text-green-700 mb-2">Acceptance & Transition</h4>
          <p class="text-gray-600 text-sm">Get accepted and transition smoothly with pre-arrival support and orientation programs.</p>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="mt-20 bg-gradient-to-r from-green-700 to-green-600 text-white rounded-3xl p-8 md:p-16 text-center" data-reveal>
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Pursue Global Education?</h2>
      <p class="text-green-100 text-lg max-w-2xl mx-auto mb-8">Take the next step in your academic journey with The Golfs Cameroon. Our team is ready to support you every step of the way.</p>
      <div class="flex flex-wrap gap-4 justify-center">
        <a href="<?php echo base_url('contact'); ?>" class="bg-white text-green-700 px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition duration-300 transform hover:scale-105 shadow-lg">
          <i class="bi bi-envelope-fill"></i> Get in Touch
        </a>
        <a href="<?php echo base_url('members'); ?>" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-700 transition duration-300 shadow-lg">
          <i class="bi bi-person-plus"></i> Join Our Program
        </a>
      </div>
    </section>

  </main>
<?php include __DIR__ . '/footer.php'; ?>

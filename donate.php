<?php
require_once __DIR__ . '/config/helpers.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Donor.php';
require_once __DIR__ . '/models/Donation.php';

$database = new Database();
$db = $database->getConnection();

// Fetch projects to display
$projStmt = $db->query('SELECT * FROM projects WHERE status = "active" ORDER BY created_at DESC');
$projects = $projStmt->fetchAll();

// Compute project progress helper
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

$page_title = 'Donate';
include __DIR__ . '/public/header.php';
?>
  <header class="bg-white border-b border-gray-200 p-6" style="background-image: linear-gradient(rgba(64, 74, 63, 0.7), rgba(0,0,0,0.6)), url('uploads/hands_smile.jpg') ">
    <div class="max-w-6xl mx-auto text-center">
      <h1 class="text-3xl font-bold text-green-500">Make a Donation</h1>
      <p class="text-white mt-2">Your contribution helps us create lasting change in communities across Cameroon.</p>
    </div>
  </header>

  <main class="max-w-6xl mx-auto p-6">
    <!-- Quick Donate Section -->
    <section class="bg-green-50 rounded-lg p-6 mb-8">
      <h2 class="text-2xl font-semibold text-green-800 mb-4 text-center">Quick Donate</h2>
      <form method="post" action="<?php echo base_url('api/process_donation.php'); ?>" class="max-w-lg mx-auto space-y-4">
        <input type="hidden" name="_csrf" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="project_id" value="">

        <div class="grid grid-cols-3 gap-3">
          <button type="button" class="amount-btn bg-white border-2 border-green-300 text-green-700 px-4 py-3 rounded-lg hover:bg-green-600 hover:text-white transition font-semibold" data-amount="10">$10</button>
          <button type="button" class="amount-btn bg-white border-2 border-green-300 text-green-700 px-4 py-3 rounded-lg hover:bg-green-600 hover:text-white transition font-semibold" data-amount="25">$25</button>
          <button type="button" class="amount-btn bg-white border-2 border-green-300 text-green-700 px-4 py-3 rounded-lg hover:bg-green-600 hover:text-white transition font-semibold" data-amount="50">$50</button>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Custom Amount (USD)</label>
          <input type="number" name="amount" id="custom_amount" step="0.01" min="1" placeholder="Enter amount" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
          <input type="text" name="full_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
          <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" name="location" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Dedication (Optional)</label>
          <input type="text" name="dedication" placeholder="In honor/memory of someone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Message (Optional)</label>
          <textarea name="message" rows="3" placeholder="Leave a message of encouragement" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"></textarea>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white px-6 py-4 rounded-lg hover:bg-green-700 transition font-semibold text-lg shadow-md hover:shadow-lg">
          <i class="bi bi-heart-fill"></i> Complete Donation
        </button>

        <p class="text-xs text-gray-500 text-center mt-4">
          <i class="bi bi-shield-check"></i> Your donation is secure and tax-deductible
        </p>
      </form>
    </section>

    <!-- Projects Section -->
    <section>
      <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">Support Our Active Projects</h2>
      <?php if (empty($projects)): ?>
        <div class="text-center text-gray-600 py-8">No active projects at the moment. Check back soon!</div>
      <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach ($projects as $proj):
            list($raised,$progress) = project_progress($db, $proj['id'], $proj['target_amount']);
          ?>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
              <h3 class="text-lg font-semibold mb-2 text-gray-800"><?php echo e($proj['name']); ?></h3>
              <p class="text-sm text-gray-600 mb-4"><?php echo e(substr($proj['description'],0,120)); ?>...</p>
              
              <div class="mb-4">
                <div class="flex justify-between text-sm mb-1">
                  <span class="text-gray-600">Raised: <?php echo format_currency($raised); ?></span>
                  <span class="text-green-600 font-semibold"><?php echo $progress; ?>%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                  <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500" style="width: <?php echo $progress; ?>%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Goal: <?php echo format_currency($proj['target_amount']); ?></p>
              </div>

              <button class="w-full bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-700 transition font-medium shadow hover:shadow-md"
                      onclick="selectProject(<?php echo e($proj['id']); ?>, '<?php echo e($proj['name']); ?>')">
                <i class="bi bi-heart"></i> Donate to this Project
              </button>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <!-- Impact Section -->
    <section class="mt-12 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg p-8">
      <h2 class="text-2xl font-bold text-center mb-6">Your Donation Makes a Difference</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="p-4">
          <i class="bi bi-people-fill text-4xl mb-3"></i>
          <h3 class="font-semibold text-lg">Community Impact</h3>
          <p class="text-sm text-green-100 mt-2">Direct support to families and individuals in need</p>
        </div>
        <div class="p-4">
          <i class="bi bi-book text-4xl mb-3"></i>
          <h3 class="font-semibold text-lg">Education Support</h3>
          <p class="text-sm text-green-100 mt-2">Scholarships and educational resources for youth</p>
        </div>
        <div class="p-4">
          <i class="bi bi-heart text-4xl mb-3"></i>
          <h3 class="font-semibold text-lg">Healthcare Access</h3>
          <p class="text-sm text-green-100 mt-2">Medical supplies and health programs</p>
        </div>
      </div>
    </section>
  </main>

  <script>
    // Amount button selection
    document.querySelectorAll('.amount-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.amount-btn').forEach(b => {
          b.classList.remove('bg-green-600', 'text-white');
          b.classList.add('bg-white', 'text-green-700');
        });
        this.classList.remove('bg-white', 'text-green-700');
        this.classList.add('bg-green-600', 'text-white');
        document.getElementById('custom_amount').value = this.dataset.amount;
      });
    });

    // Select project for donation
    function selectProject(projectId, projectName) {
      document.querySelector('input[name="project_id"]').value = projectId;
      document.getElementById('custom_amount').scrollIntoView({ behavior: 'smooth', block: 'center' });
      
      // Show notification
      const notification = document.createElement('div');
      notification.className = 'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce';
      notification.innerHTML = '<i class="bi bi-check-circle"></i> Selected: ' + projectName;
      document.body.appendChild(notification);
      
      setTimeout(function() {
        notification.remove();
      }, 3000);
    }

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
      const amount = document.getElementById('custom_amount').value;
      if (!amount || amount <= 0) {
        e.preventDefault();
        alert('Please enter a valid donation amount');
        document.getElementById('custom_amount').focus();
      }
    });
  </script>

<?php include __DIR__ . '/public/footer.php'; ?>

<?php
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Donor.php';
require_once __DIR__ . '/../models/Donation.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Verify CSRF token
if (!verify_csrf($_POST['_csrf'] ?? '')) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid CSRF token']);
    exit;
}

// Get form data
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$location = trim($_POST['location'] ?? '');
$project_id = (int) ($_POST['project_id'] ?? 0);
$amount = (float) ($_POST['amount'] ?? 0);

// Validate inputs
if (empty($full_name)) {
    $_SESSION['donation_error'] = 'Full name is required';
    redirect(base_url('donations'));
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['donation_error'] = 'Valid email is required';
    redirect(base_url('donations'));
}

if ($amount < 1) {
    $_SESSION['donation_error'] = 'Amount must be at least $1';
    redirect(base_url('donations'));
}

if ($project_id < 1) {
    $_SESSION['donation_error'] = 'Please select a project';
    redirect(base_url('donations'));
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Create donor record
    $donorModel = new Donor($db);
    $donorData = [
        'name' => $full_name,
        'email' => $email,
        'location' => !empty($location) ? $location : null,
        'phone' => !empty($phone) ? $phone : null,
    ];
    $donorModel->create($donorData);
    $donor_id = $donorModel->findLastInsertId();

    // Create donation record
    $donationModel = new Donation($db);
    $donationModel->create($donor_id, $project_id, $amount);

    // Get project and payment link
    $ps = $db->prepare('SELECT payment_link, name FROM projects WHERE id = :id');
    $ps->execute([':id' => $project_id]);
    $project = $ps->fetch();
    
    if (!$project) {
        $_SESSION['donation_error'] = 'Project not found';
        redirect(base_url('donations'));
    }

    $payment_link = $project['payment_link'] ?? '';
    
    if (empty($payment_link)) {
        // If no payment link, show a thank you page instead
        $_SESSION['donation_success'] = [
            'name' => $full_name,
            'amount' => $amount,
            'project' => $project['name']
        ];
        redirect(base_url('donations') . '#thank-you');
    }

    // Redirect to payment link with donation info
    $separator = (strpos($payment_link, '?') !== false) ? '&' : '?';
    $payment_url = $payment_link . $separator . 'amount=' . urlencode($amount) . '&name=' . urlencode($full_name) . '&email=' . urlencode($email);
    
    redirect($payment_url);

} catch (Exception $e) {
    $_SESSION['donation_error'] = 'An error occurred: ' . $e->getMessage();
    redirect(base_url('donations'));
}
?>

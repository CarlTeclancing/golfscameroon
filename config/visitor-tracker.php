<?php
// Visitor tracking helper - include on all pages
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function track_visitor() {
    // Don't track admin pages
    if (strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/') !== false) {
        return;
    }

    // Get current page from URI
    $path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '', '/');
    $base = trim(parse_url(base_url(''), PHP_URL_PATH) ?? '', '/');
    if ($base !== '' && strpos($path, $base) === 0) {
        $path = trim(substr($path, strlen($base)), '/');
    }
    if ($path === 'public' || $path === 'public/index.php' || $path === 'index.php') {
        $path = 'home';
    }
    if (strpos($path, 'public/') === 0) {
        $path = substr($path, 7);
    }
    $parts = explode('/', $path);
    $page = $parts[0] ?: 'home';
    $page = preg_replace('/\.php$/', '', $page);

    // Track only once per session per minute to avoid spam
    $session_key = 'visited_' . md5($page) . '_' . date('YmdHi');
    if (isset($_SESSION[$session_key])) {
        return;
    }
    $_SESSION[$session_key] = true;

    try {
        require_once __DIR__ . '/database.php';
        $db = (new Database())->getConnection();
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        if (strpos($ip, ',') !== false) {
            $ips = array_map('trim', explode(',', $ip));
            $ip = $ips[0];
        }
        $stmt = $db->prepare('INSERT INTO visitors (page, ip_address, user_agent) VALUES (:page, :ip, :ua)');
        $stmt->execute([':page' => $page, ':ip' => $ip, ':ua' => substr($ua, 0, 500)]);
    } catch (Exception $e) {
        // Silent fail
    }
}

track_visitor();
?>

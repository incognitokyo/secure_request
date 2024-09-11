<?php
// Secret key (shared between your server and the client)
$secret_key = "your_secret_key";

// Get the POST data
$user_id = $_POST['user_id'] ?? '';
$amount = $_POST['amount'] ?? '';
$trx = $_POST['TRX'] ?? '';
$received_hash = $_POST['hash'] ?? '';

// Check if all necessary data is present
if (empty($user_id) || empty($amount) || empty($trx) || empty($received_hash)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Recreate the hash on the server
$hash_string = $user_id . $amount . $trx . $secret_key;
$expected_hash = hash('sha256', $hash_string);

// Verify the hash
if ($expected_hash === $received_hash) {
    // Hash matches, process the request (this is where you could implement further logic)
    echo json_encode(['status' => 'success', 'message' => 'Request is valid']);
} else {
    // Hash doesn't match
    echo json_encode(['status' => 'error', 'message' => 'Invalid hash']);
}
?>

<?php
// Retrieve POST data
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
$trx = $_POST['TRX'];
$received_hash = $_POST['hash'];

// Secret key (shared between your server and the client)
$secret_key = "your_secret_key";

// Generate the hash using the same method
$hash_string = $user_id . $amount . $trx . $secret_key;
$expected_hash = hash('sha256', $hash_string);

// Check if the hash matches
if ($expected_hash === $received_hash) {
    echo "OK: Hash is valid";
} else {
    echo "Error: Invalid hash";
}
?>

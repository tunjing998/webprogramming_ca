<?php
// require_once '../../models/Account.php';
// $username = $_POST['username'];
// $avaliable = \Account::checkNameAvailable($username);
$db = new PDO(
    'mysql:host=127.0.0.1;dbname=wp_ca4_tunjing_ang_xingnuo_cen;charset=utf8mb4',
    'root',
    '',
    null
);
$action = $_POST['action'];
switch ($action) {
    case 'checkUsername': {
            $username = $_POST['username'];

            $query = $db->prepare('SELECT account_id, username, email FROM accounts WHERE username = :username LIMIT 1');
            $query->execute([
                'username' => $username
            ]);
            $available = $query->rowCount();
            echo $available;
            break;
        }
    case 'checkEmail': {
            $email = $_POST['email'];

            $query = $db->prepare('SELECT account_id, username, email FROM accounts WHERE email = :email LIMIT 1');
            $query->execute([
                'email' => $email
            ]);
            $available = $query->rowCount();
            echo $available;
            break;
        }
    case 'checkPasswordStrength': {
            $passcode = $_POST['passcode'];
            $strength = 0;
            $uppercase = preg_match('@[A-Z]@', $passcode);
            $lowercase = preg_match('@[a-z]@', $passcode);
            $number    = preg_match('@[0-9]@', $passcode);
            $length    = strlen($passcode) >= 8;
            if ($uppercase) {
                $strength++;
            }
            if ($lowercase) {
                $strength++;
            }
            if ($number) {
                $strength++;
            }
            if ($length) {
                $strength++;
            }
            echo $strength;
            break;
        }
    case 'login': {
            $input = $_POST['username'];
            $passcode = $_POST['password'];
            if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
                $query = $db->prepare('SELECT account_id,hash FROM accounts WHERE email = :dataIn ');
            } else {
                $query = $db->prepare('SELECT account_id,hash FROM accounts WHERE username = :dataIn ');
            }
            $query->execute([
                'dataIn' => $input
            ]);
            $row = $query->fetch();
            if (password_verify($passcode, $row['hash'])) { 
                $id = $row['account_id'];
            } else { 
                $id = -1;
            }

            echo $id;
        }
}

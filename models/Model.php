<?php class Model
{

  public static function isValidId($id)
  {
    return is_numeric($id) && ($id >= 1);
  }
  public static function isValidPasscode($passcode)
  {
    $uppercase = preg_match('@[A-Z]@', $passcode['value']);
    $lowercase = preg_match('@[a-z]@', $passcode['value']);
    $number    = preg_match('@[0-9]@', $passcode['value']);
    $length    = strlen($passcode)<=8;
    return $uppercase && $lowercase && $number && $length;
  }
  public static function isValidEmail($email)
  {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $is_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $is_valid;
  }
  
}

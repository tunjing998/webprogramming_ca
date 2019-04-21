<?php
use Rapid\Database;

class Account
{
    private $account_id;
    private $username;
    private $email;
    private $passcode;

    public function __construct($args)
    {
        if (!is_array($args)) {
            throw new Exception('Account constructor requires an array');
        }

        $this->setId($args['account_id']     ?? NULL);
        $this->setUsername($args['username'] ?? NULL);
        $this->setEmail($args['email']       ?? NULL);
        $this->setPasscode($args['passcode'] ?? NULL);
    }

    /**
     * Getter
     */
    public function getId()
    {
        return $this->account_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPasscode()
    {
        return $this->passcode;
    }

    /**
     * Setter
     */
    public function setId($account_id)
    {
        if ($account_id === NULL) {
            $this->account_id = NULL;
            return;
        }
        $account_id = (int)$account_id;

        if (!Model::isValidId($account_id)) {
            throw new Exception('account_id for setId must be positive numeric or NULL');
        }

        $this->account_id = $account_id;
    }

    public function setUsername($username)
    {
        if ($username === NULL) {
            $this->username = NULL;
            return;
        }
        //Maybe apply some regex for the username at here    
        // if (!preg_match('/^[a-z]{3,55}$/i', $name)) {
        //     throw new Exception('Student names must be alphabetic, and between 3 and 5 characters long');
        //   }
        $this->username = $username;
    }

    public function setEmail($email)
    {
        if ($email === NULL) {
            $this->email = NULL;
            return;
        }
        if (!Model::isValidEmail($email)) {
            throw new Exeption('The email is not is correct format');
        }
        $this->email = $email;
    }

    public function setPasscode($passcode)
    {
        if ($passcode === NULL) {
            $this->passcode = NULL;
            return;
        }
        if (!Model::isValidPasscode($passcode)) {
            throw new Exception('Passcode must contain at least 1 upper case , 1 lower case, 1 number');
        }
        $this->passcode = $passcode;
    }

    /**
     * Delete
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        if ($this->getId() === NULL) {
            throw new Exception('Cannot delete a transient Account object');
        }

        $stt = $pdo->prepare('DELETE FROM accounts WHERE account_id = :account_id');
        $stt->execute([
            'account_id' => $this->getId()
        ]);

        $deleted = $stt->rowCount() === 1;

        if ($deleted) {
            $this->setId(NULL);
        }

        return $deleted;
    }

    /**
     * Update
     */
    public function save()
    {
        $pdo = Database::getPDO();
        if (!($pdo instanceof PDO)) {
            throw new Exception('Invalid PDO object for Account save');
        }
        $hash = password_hash($this->getPasscode(), PASSWORD_BCRYPT, ['cost' => 12]);
        if ($this->getId() === NULL) {

            $stt = $pdo->prepare('INSERT INTO accounts (username,email,hash) VALUES (:name,:email,:hash)');
            $stt->execute([
                'name' => $this->getName(),
                'email' => $this->getEmail(),
                'hash' => $hash
            ]);
            $saved = $stt->rowCount() === 1;

            if ($saved) {
                $this->setId($pdo->lastInsertId());
            }

            return $saved;
        } else {

            $stt = $pdo->prepare('UPDATE accounts SELECT username = :name,email=:email,hash=:hash WHERE account_id = :account_id');
            $stt->execute([
                'name' => $this->getUsername(),
                'email' => $this->getEmail(),
                'hash' => $hash,
                'account_id'   => $this->getId()
            ]);
            return $stt->rowCount() === 1;
        }
    }

    /**
     * ######################################################
     * # Static methods
     * ######################################################
     */
    public static function login($input, $passcode)
    {
        if (Model::isValidEmail($input)) {
            $inputType = 'email';
        }
        $pdo = Database::getPDO();
        $query = $pdo->prepare("SELECT hash FROM accounts WHERE :input=:value");
        $query->execute([
            'input' => $inputType,
            'value' => $input
        ]);
        $row = $query->fetch();
        return password_verify($passcode, $row['hash']);
    }
}

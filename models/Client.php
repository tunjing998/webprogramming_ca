<?php require_once('Model.php') ?>
<?php
use Rapid\Database;
class Client
{
    private $client_id;
    private $nickname;
    private $registerdate;

    public function __construct($args)
    {
        if (!is_array($args)) {
            throw new Exception('Client constructor requires an array');
        }
        $this->setClientId($args['client_id']              ?? NULL);
        $this->setNickname($args['nickname']         ?? NULL);
        $this->setRegisterdate($args['registerdate'] ?? NULL);
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getRegisterdate()
    {
        return $this->registerdate;
    }
    public function setClientId($client_id)
    {
        if ($client_id === NULL) {
            $this->client_id = NULL;
            return;
        }
        $client_id = (int)$client_id;

        if (!Model::isValidId($client_id)) {
            throw new Exception('client_id for setId must be positive numeric or NULL');
        }

        $this->client_id = $client_id;
    }
    public function setNickname($nickname)
    {
        // if($nickname===NULL)
        // {
        //     $this->nickname= NULL;
        //     return;
        // }
        $this->nickname = $nickname;
    }

    public function setRegisterdate($registerdate)
    {
        // if($nickname===NULL)
        // {
        //     $this->nickname= NULL;
        //     return;
        // }
        $this->registerdate = $registerdate;
    }

    public function delete()
    {
        $pdo = Database::getPDO();
        if ($this->getClientId() === NULL) {
            throw new Exception('Cannot delete a transient Client object');
        }

        $stt = $pdo->prepare('DELETE FROM clients WHERE client_id = :client_id');
        $stt->execute([
            'client_id' => $this->getClientId()
        ]);

        $deleted = $stt->rowCount() === 1;

        if ($deleted) {
            $this->setClientId(NULL);
        }

        return $deleted;
    }

    public function save()
    {
        $pdo = Database::getPDO();


        if ($this->getClientId() === NULL) {

            $stt = $pdo->prepare('INSERT INTO clients (nickname) VALUES (:name)');
            $stt->execute([
                'name' => $this->getNickname()
            ]);

            $saved = $stt->rowCount() === 1;


            if ($saved) {
                $this->setId($pdo->lastInsertId());
            }

            return $saved;
        } else {

            $stt = $pdo->prepare('UPDATE clients SET nickname = :name WHERE client_id = :client_id');
            $stt->execute([
                'name' => $this->getNickname(),
                'client_id'   => $this->getClientId()
            ]);

            return $stt->rowCount() === 1;
        }
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT client_id, nickname, registerdate FROM clients');
        $query->execute();

        return array_map(function ($row) {
            return new Client($row);
        }, $query->fetchAll());
    }

    public static function findOneById($id)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }

        $query = $pdo->prepare('SELECT client_id, nickname, registerdate FROM clients WHERE client_id = :id LIMIT 1');
        $query->execute([
            'id' => $id
        ]);

        $row = $query->fetch();

        return $row !== FALSE
            ? new Client($row)
            : NULL;
    }
}

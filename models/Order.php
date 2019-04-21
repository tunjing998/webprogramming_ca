<?php
class Order
{
    private $order_id;
    private $client_id;
    private $order_status;
    private $order_date;

    public function __construct($args)
    {
        if (!is_array($args)) {
            throw new Exception('Order constructor requires an array');
        }

        $this->setOrderId($args['order_id']         ?? NULL);
        $this->setClientId($args['client_id']       ?? NULL);
        $this->setOrderStatus($args['order_status'] ?? NULL);
        $this->setOrderDate($args['order_date']     ?? NULL);
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function getOrderStatus()
    {
        return $this->order_status;
    }

    public function getOrderDate()
    {
        return $this->order_date;
    }

    public function setOrderId($id)
    {
        if ($id === NULL) {
            $this->order_id = NULL;
            return;
        }

        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for setId must be positive numeric or NULL');
        }

        $this->order_id = $id;
    }

    public function setClientId($id)
    {
        if ($id === NULL) {
            $this->client_id = NULL;
            return;
        }

        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for setId must be positive numeric or NULL');
        }

        $this->client_id = $id;
    }

    public function setOrderStatus($status)
    {
        if ($status === NULL) {
            $this->order_status = NULL;
            return;
        }
        $this->order_status = $status;
    }

    public function setOrderDate($date)
    {
        if ($date === NULL) {
            $this->order_date = NULL;
            return;
        }

        $this->order_date = $date;
    }

    public function delete()
    {
        $pdo = Database::getPDO();
        if ($this->getOrderId() === NULL) {
            throw new Exception('Cannot delete a transient Order object');
        }

        $stt = $pdo->prepare('DELETE FROM orders WHERE order_id = :order_id');
        $stt->execute([
            'order_id' => $this->getOrderId()
        ]);

        $deleted = $stt->rowCount() === 1;

        if ($deleted) {
            $this->setOrderId(NULL);
        }

        return $deleted;
    }

    public function save()
    {
        $pdo = Database::getPDO();


        if ($this->getId() === NULL) {

            $stt = $pdo->prepare('INSERT INTO orders (client_id,order_status) VALUES (:client_id,:order_status)');
            $stt->execute([
                'client_id' => $this->getClientId(),
                'order_status' => $this->getOrderStatus()
            ]);

            $saved = $stt->rowCount() === 1;


            if ($saved) {
                $this->setClientId($pdo->lastInsertId());
            }

            return $saved;
        } else {

            $stt = $pdo->prepare('UPDATE orders SET client_id = :client_id,order_status=:order_status WHERE order_id = :order_id');
            $stt->execute([
                'client_id' => $this->getClientId(),
                'order_status' => $this->getOrderStatus(),
                'order_id'   => $this->getOrderId()
            ]);

            return $stt->rowCount() === 1;
        }
    }

    public function findAll()
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT order_id, client_id, order_status,order_date FROM orders');
        $query->execute();

        return array_map(function ($row) {
            return new Order($row);
        }, $query->fetchAll());
    }

    public function findByClientId($id)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }
        $query = $pdo->prepare('SELECT order_id, client_id, order_status,order_date FROM orders WHERE client_id = :id');
        $query->execute([
            'id' => $id
        ]);

        return array_map(function ($row) {
            return new Order($row);
        }, $query->fetchAll());
    }

    public function findOneById($id)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }

        $query = $pdo->prepare('SELECT order_id, client_id, order_status,order_date FROM orders WHERE order_id = :id LIMIT 1');
        $query->execute([
            'id' => $id
        ]);

        $row = $query->fetch();

        return $row !== FALSE
            ? new Order($row)
            : NULL;
    }
}

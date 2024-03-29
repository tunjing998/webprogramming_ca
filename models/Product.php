<?php require_once('Model.php') ?>
<?php
use Rapid\Database;

class Product
{
    private $productId;
    private $productName;
    private $productType;
    private $productDetail;
    private $productPrice;
    private $productImageAddr;
    public function __construct($args)
    {

        if (!is_array($args)) {
            throw new Exception('Product constructor requires an array');
        }
        $this->setProductId($args['product_id']                 ?? NULL);
        $this->setProductName($args['product_name']             ?? NULL);
        $this->setProductType($args['product_type']             ?? NULL);
        $this->setProductDetail($args['product_details']        ?? NULL);
        $this->setProductPrice($args['product_price']           ?? NULL);
        $this->setProductImageAddr($args['product_img_address'] ?? NULL);
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductType()
    {
        return $this->productType;
    }

    public function getProductDetail()
    {
        return $this->productDetail;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }
    public function getProductImageAddr()
    {
        return $this->productImageAddr;
    }

    public function setProductId($id)
    {
        if ($id === NULL) {
            $this->product_id = NULL;
            return;
        }

        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for setId must be positive numeric or NULL');
        }
        $this->productId = $id;
    }

    public function setProductName($name)
    {
        if ($name === NULL) {
            $this->productName = NULL;
            return;
        }

        $this->productName = $name;
    }

    public function setProductType($type)
    {
        if ($type === NULL) {
            $this->productType = NULL;
            return;
        }

        $this->productType = $type;
    }

    public function setProductDetail($detail)
    {
        if ($detail === NULL) {
            $this->productDetail = NULL;
            return;
        }

        $this->productDetail = $detail;
    }

    public function setProductPrice($price)
    {
        if ($price === NULL) {
            $this->productPrice = NULL;
            return;
        }
        $price = (double)$price;

        if (!Model::isValidId($price)) {
            throw new Exception('Price for setPrice must be positive numeric');
        }
        $this->productPrice = $price;
    }
    public function setProductImageAddr($addr)
    {
        if ($addr === NULL) {
            $this->productImageAddr = NULL;
            return;
        }

        $this->productImageAddr = $addr;
    }
    public function delete()
    {
        $pdo = Database::getPDO();
        if ($this->getProductId() === NULL) {
            throw new Exception('Cannot delete a transient Product object');
        }

        $stt = $pdo->prepare('DELETE FROM products WHERE product_id = :id');
        $stt->execute([
            'id' => $this->getProductId()
        ]);

        $deleted = $stt->rowCount() === 1;

        if ($deleted) {
            $this->setProductId(NULL);
        }

        return $deleted;
    }

    public function save()
    {
        $pdo = Database::getPDO();

        if ($this->getProductId() === NULL) {

            $stt = $pdo->prepare('INSERT INTO products (product_name,product_type,product_details,product_price,product_img_address) VALUES (:product_name,:product_type,:product_details,:product_price,:product_img_address)');
            $stt->execute([
                'product_name' => $this->getProductName(),
                'product_type' => $this->getProductType(),
                'product_details' => $this->getProductDetail(),
                'product_price' => $this->getProductPrice(),
                'product_img_address' => $this->getProductImageAddr()
            ]);

            $saved = $stt->rowCount() === 1;


            if ($saved) {
                $this->setProductId($pdo->lastInsertId());
            }

            return $saved;
        } else {

            $stt = $pdo->prepare('UPDATE products SET product_name=:product_name,product_type=:product_type,product_details=:product_details,product_price=:product_price,product_img_address=:product_img_address WHERE product_id = :product_id');
            $stt->execute([
                'product_name' => $this->getProductName(),
                'product_type' => $this->getProductType(),
                'product_details' => $this->getProductDetail(),
                'product_price' => $this->getProductPrice(),
                'product_img_address' => $this->getProductImageAddr(),
                'product_id'   => $this->getProductId()
            ]);

            return $stt->rowCount() === 1;
        }
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT product_id,product_name,product_type,product_details,product_price,product_img_address FROM products');
        $query->execute();

        return array_map(function ($row) {
            return new Product($row);
        }, $query->fetchAll());
    }
    public static function find25()
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT product_id,product_name,product_type,product_details,product_price,product_img_address FROM products LIMIT 25');
        $query->execute();
        return array_map(function ($row) {
            return new Product($row);
        }, $query->fetchAll());
    }
    public static function findTenByRand()
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT product_id,product_name,product_type,product_details,product_price,product_img_address FROM products ORDER BY RAND() LIMIT 8');
        $query->execute();

        return array_map(function ($row) {
            return new Product($row);
        }, $query->fetchAll());
    }
    public static function findOneById($id)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }

        $query = $pdo->prepare('SELECT product_id,product_name,product_type,product_details,product_price,product_img_address FROM products WHERE product_id = :id LIMIT 1');
        $query->execute([
            'id' => $id
        ]);

        $row = $query->fetch();

        return $row !== FALSE
            ? new Product($row)
            : NULL;
    }

    public static function findByType($type)
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT product_id,product_name,product_type,product_details,product_price,product_img_address FROM products WHERE product_type = :type');
        $query->execute([
            'type' => $type
        ]);

        return array_map(function ($row) {
            return new Product($row);
        }, $query->fetchAll());
    }

    public static function findByName($name)
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT product_id, product_name, product_type, product_details,product_price,product_img_address FROM products WHERE product_name LIKE :name ');
        $query->execute([
            'name' => "%" . $name . "%",
        ]);
        return array_map(function ($row) {
            return new Product($row);
        }, $query->fetchAll());
    }
}

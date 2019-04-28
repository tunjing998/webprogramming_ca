<?php require_once('Model.php') ?>
<?php
use Rapid\Database;

class Review
{
    private $reviewId;
    private $productId;
    private $clientId;
    private $reviewTitle;
    private $reviewText;
    private $suggest;
    private $lastModified;

    public function __construct($args)
    {

        if (!is_array($args)) {
            throw new Exception('Order constructor requires an array');
        }
        $this->setReviewId($args['review_id'] ?? NULL);
        $this->setProductId($args['product_id']         ?? NULL);
        $this->setClientId($args['client_id']       ?? NULL);
        $this->setReviewTitle($args['review_title'] ?? NULL);
        $this->setReviewTest($args['review_text']     ?? NULL);
        $this->setSuggest($args['suggest'] ?? NULL);
        $this->setLastModified($args['last_modified'] ?? NULL);
    }

    public function getReviewId()
    {
        return $this->reviewId;
    }
    public function getProductId()
    {
        return $this->productId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getReviewTitle()
    {
        return $this->reviewTitle;
    }

    public function getReviewText()
    {
        return $this->reviewText;
    }

    public function getSuggest()
    {
        return $this->suggest;
    }

    public function getLastModified()
    {
        return $this->lastModified;
    }
    public function setReviewId($id)
    {
        if ($id === NULL) {
            $this->review_id = NULL;
            return;
        }

        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for setId must be positive numeric or NULL');
        }

        $this->review_id = $id;
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

        $this->product_id = $id;
    }

    public function setClientId($id)
    {
        if ($id === NULL) {
            $this->client_id = NULL;
            return;
        }
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('client_id for setId must be positive numeric or NULL');
        }

        $this->client_id = $id;
    }

    public function setReviewTitle($title)
    {
        if ($title === NULL) {
            $this->reviewTitle = NULL;
            return;
        }
        $this->reviewTitle = $title;
    }
    public function setReviewText($text)
    {
        if ($text === NULL) {
            $this->reviewText = NULL;
            return;
        }
        $this->reviewText = $text;
    }
    public function setSuggest($suggest)
    {
        if ($suggest === NULL) {
            $this->suggest = NULL;
            return;
        }
        $this->suggest = $suggest;
    }
    public function setLastModified($time)
    {
        if ($time === NULL) {
            $this->lastModified = NULL;
            return;
        }
        $this->lastModified = $time;
    }

    public function delete()
    {
        $pdo = Database::getPDO();
        if ($this->getProductId() === NULL) {
            throw new Exception('Cannot delete a transient Review object');
        }

        $stt = $pdo->prepare('DELETE FROM reviews WHERE review_id = :id');
        $stt->execute([
            'id' => $this->getReviewId()
        ]);

        $deleted = $stt->rowCount() === 1;

        if ($deleted) {
            $this->setReviewId(NULL);
            $this->setProductId(NULL);
            $this->setClientId(NULL);
        }

        return $deleted;
    }
    public function save()
    {
        $pdo = Database::getPDO();


        if ($this->getReviewId() === NULL) {

            $stt = $pdo->prepare('INSERT INTO reviews (product_id,client_id,review_title,review_text,suggest,last_modified) VALUES (:product_id,:client_id,:review_title,:review_text,:suggest,:last_modified)');
            $stt->execute([
                'product_id' => $this->getProductId(),
                'client_id' => $this->getClientId(),
                'review_title' => $this->getReviewTitle(),
                'review_text' => $this->getReviewText(),
                'suggest' => $this->getSuggest(),
                'last_modified' => $this->getLastModified()
            ]);

            $saved = $stt->rowCount() === 1;

            return $saved;
        } else {

            $stt = $pdo->prepare('UPDATE products SET review_title=:review_title,review_text=:review_text,suggest=:suggest,last_modified=:last_modified WHERE review_id = :id');
            $stt->execute([
                'review_title' => $this->getReviewTitle(),
                'review_text' => $this->getReviewText(),
                'suggest' => $this->getSuggest(),
                'last_modified' => $this->getLastModified(),
                'id' => $this->getReviewId()
            ]);

            return $stt->rowCount() === 1;
        }
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $query = $pdo->prepare('SELECT review_id,roduct_id,client_id,review_title,review_text,suggest,last_modified FROM reviews');
        $query->execute();

        return array_map(function ($row) {
            return new Review($row);
        }, $query->fetchAll());
    }

    public static function findByClientId($id)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }
        $query = $pdo->prepare('SELECT review_id,product_id,client_id,review_title,review_text,suggest,last_modified FROM reviews WHERE client_id = :id');
        $query->execute([
            'id' => $id
        ]);

        return array_map(function ($row) {
            return new Review($row);
        }, $query->fetchAll());
    }

    public static function findByProductId($id, $limit = 3)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;

        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }
        $query = $pdo->prepare('SELECT review_id,product_id,client_id,review_title,review_text,suggest,last_modified FROM reviews WHERE product_id = :id LIMIT :limit');
        $query->execute([
            'id' => $id,
            'limit' => $limit
        ]);

        return array_map(function ($row) {
            return new Review($row);
        }, $query->fetchAll());
    }

    public static function findOneById($id)
    {
        $pdo = Database::getPDO();
        $id = (int)$id;
        $client_id = (int)$client_id;
        if (!Model::isValidId($id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }
        if (!Model::isValidId($client_id)) {
            throw new Exception('ID for findOneById must be positive numeric');
        }

        $query = $pdo->prepare('SELECT review_id,product_id,client_id,review_title,review_text,suggest,last_modified FROM reviews WHERE WHERE review_id = :id LIMIT 1');
        $query->execute([
            'id' => $id
        ]);

        $row = $query->fetch();

        return $row !== FALSE
            ? new Review($row)
            : NULL;
    }
}

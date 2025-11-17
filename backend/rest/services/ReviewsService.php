<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/ReviewsDao.php';

class ReviewsService extends BaseService {
    public function __construct() {
        $this->dao = new ReviewsDao();
    }

    public function getByClientId($client_id) {
        return $this->dao->getByClientId($client_id);
    }
}
?>


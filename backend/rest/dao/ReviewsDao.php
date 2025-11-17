<?php
require_once 'BaseDao.php';

class ReviewsDao extends BaseDao {
    public function __construct() {
        parent::__construct("reviews");
    }

    // Dohvati recenzije po client_id
    public function getByClientId($client_id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE client_id = :client_id");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Kreiraj novu recenziju
    // public function createReview($client_id, $comment, $rating) {
    //     $stmt = $this->connection->prepare(
    //         "INSERT INTO reviews (client_id, comment, rating) 
    //          VALUES (:client_id, :comment, :rating)"
    //     );
    //     $stmt->bindParam(':client_id', $client_id);
    //     $stmt->bindParam(':comment', $comment);
    //     $stmt->bindParam(':rating', $rating);
    //     return $stmt->execute();
    // }

    // Update recenzije
    // public function updateReview($review_id, $comment, $rating) {
    //     $stmt = $this->connection->prepare(
    //         "UPDATE reviews SET comment = :comment, rating = :rating WHERE review_id = :review_id"
    //     );
    //     $stmt->bindParam(':comment', $comment);
    //     $stmt->bindParam(':rating', $rating);
    //     $stmt->bindParam(':review_id', $review_id);
    //     return $stmt->execute();
    // }

    //     // Delete recenzije
    //     public function deleteReview($review_id) {
    //         return $this->delete($review_id);
    //     }
}
//  ?>

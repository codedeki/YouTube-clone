<?php 

class SearchResultsProvider {

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos($term, $orderBy) {
        $query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%', :term, '%') 
                                        OR uploadedBy LIKE CONCAT('%', :term, '%') ORDER BY $orderBy DESC");
        // the modulo '%' is vital for how we filter search results in PHP
        //e.g. if user searches for 'my dog', assuming a video in the databse is titled 'dog', ('%', :term[where term='dog'], '%') will get any number of characters before or after dog [%dog%]as long as "dog" is present in the title
        $query->bindParam(":term", $term);
        $query->execute();

        $videos = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->con, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos;
    }
}

?>
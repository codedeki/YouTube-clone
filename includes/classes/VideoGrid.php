<?php 

class VideoGrid {

    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter) {

        if ($videos == null) {
            $gridItems = $this->generateItems();
        } 
        else {
            $gridItems = $this->generateItemsFromVideos();

        }

        $header = "";

        if ($title != null) {
            $header = $this->createGridHeader($title, $showFilter); 
        }
        
        return "<div class='$this->gridClass'>
                $gridItems
                </div>";
    }

    public function generateItems() {
        //prepare to show 15 suggested videos from the db for grid on the right of watch.php
        $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elementsHTML = "";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $video = new Video($this->con, $row, $this->userLoggedInObj);
            $item = new VideoGridItem($video, $this->largeMode);
            $elementsHTML .= $item->create();
        }

        return $elementsHTML;
    }

    public function generateItemsFromVideos() {

    }

    public function createGridHeader() {
        return "";
    }
}



?>
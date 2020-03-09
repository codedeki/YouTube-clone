<?php 

class LikedVideosProvider {

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();
        //get 15 most viewed videos in the last 7 days
        $query = $this->con->prepare("SELECT videoId FROM likes WHERE username=:username AND commentId=0
                                        ORDER BY id DESC");
        $username = $this->userLoggedInObj->getUserName();
        $query->bindParam(":username", $username);
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $videos[] = new Video($this->con, $row["videoId"], $this->userLoggedInObj);
            // array_push($videos, $video); same as above []
        }

        return $videos;
    }

}

?>
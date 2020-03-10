<?php 
class VideoUploadData {

    private $videoDataArray, $title, $description, $privacy, $category, $uploadedBy;

    public function __construct($videoDataArray, $title, $description, $privacy, $category, $uploadedBy) {
        $this->videoDataArray = $videoDataArray;
        $this->title = $title;
        $this->description = $description;
        $this->privacy = $privacy;
        $this->category = $category;
        $this->uploadedBy = $uploadedBy;
    }

    public function getVideoDataArray() {
        return $this->videoDataArray;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description; 
    }

    public function getPrivacy() {
        return $this->privacy;  
    }

    public function getCategory() {
        return $this->category;
    }
    
    public function getUploadedBy() {
        return $this->uploadedBy;
    }

    public function updateDetails($con, $videoId) {
        $title = $this->getTitle();
        $desc = $this->getDescription();
        $privacy = $this->getPrivacy();
        $category = $this->getCategory();

        $query = $con->prepare("UPDATE videos SET title=:title, description=:description, 
                                privacy=:privacy, category=:category WHERE id=:videoId");
        $query->bindParam(":title", $title);
        $query->bindParam(":description", $desc);
        $query->bindParam(":privacy", $privacy);
        $query->bindParam(":category", $category);
        $query->bindParam(":videoId", $videoId);

        return $query->execute();

    }
}

?>
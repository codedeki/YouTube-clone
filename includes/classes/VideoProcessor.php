<?php 

class VideoProcessor {

    private $con;
    private $sizeLimit = 500000000;
    private $allowedTypes = array("mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");

    public function __constructor($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->getVideoDataArray();

        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        //e.g. uploads/videos/5aa3e939393cfdogsplaying.mp4   
        $tempFilePath = str_replace(" ", "", $tempFilePath); //replace spaces with underscore in our get request

        $isValidData = $this->processData($videoData, $tempFilePath);

        if (!$isValidData) {
            return false;
        }

        if (move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {
            $finalFilePath = $targetDir . uniqid() . ".mp4";

            if (!$this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo "Insert query failed";
                return false;
            }
        }
        
        echo $tempFilePath;
    }

    private function processData($videoData, $filePath) {
        $videoType = pathInfo($filePath, PATHINFO_EXTENSION);

        if (!$this->isValidSize($videoData)) {
            echo "File too large. Can't be more than " . $this->sizeLimit . " bytes";
            return false;
        } 
        else if (!$this->isValidType($videoType)) {
            echo "Invalid file type.";
            return false;
        }
        else if ($this->hasError($videoData)) {
            echo "Error code: " . $videoData["error"];
            return false;
        }
        return true;
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizeLimit; 
    }

    private function isValidType($type) {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }
    
    private function hasError($data) {
        return $data["error"] != 0;
    }

    private function insertVideoData($uploadData, $filePath) {
        $query = $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
                                        VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");

        $query->bindParam(":title", $uploadData->getTitle());
        $query->bindParam(":uploadedBy", $uploadData->getUploadedBy());
        $query->bindParam(":description", $uploadData->getDescription());
        $query->bindParam(":privacy", $uploadData->getPrivacy());
        $query->bindParam(":category", $uploadData->getCategory());
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
    }

}


?>
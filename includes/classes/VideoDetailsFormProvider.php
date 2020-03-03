<?php

class VideoDetailsFormProvider {
    
    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        return "<form action='processing.php' method='POST'>
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                </form>";
    }

    private function createFileInput() {
        return "<div class='form-group'>
                    <label for='example'>Upload your file: </label>
                    <input type='file' class='form-control-file' id='example' name='fileInput'>
                </div>";
    }

    private function createTitleInput() {
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='title' name='titleInput'>
                </div>";
    }

    private function createDescriptionInput() {
        return "<div class='form-group'>
                    <textarea class='form-control' placeholder='Description' name='descriptionInput'></textarea>
                </div>";
        
    }

    private function createPrivacyInput() {
        return "<div class='form-group' name='privacyInput'>
                    <select class='form-control'>
                        <option value='0'>Private</option>
                        <option value='1'>Public</optionvalue='0'>
        
                    </select>
                </div>";
        
    }
}

?>
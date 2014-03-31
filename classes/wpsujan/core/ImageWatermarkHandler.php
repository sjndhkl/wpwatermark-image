<?php

namespace wpsujan\core;

class ImageWatermarkHandler implements WatermarkHandlerInterface {
    
    private $watermarkImage;
    private $imageHandler;
    
    public function __construct($imageHandler,$watermarkPath) {
       
        if(is_null($imageHandler)){
            throw new \Exception("No Image Handler Specified");
        }
        $this->imageHandler = $imageHandler;
        $this->watermarkImage = $this->imageHandler->open($watermarkPath);
        
    }

    public function handle($data,$position = Position::BOTTOM_RIGHT,$xOffset=5,$yOffset=5) {
        $file = $data['file'];
        $sizes = $data['sizes'];
        $this->watermarkImages($file, $sizes,$position,$xOffset,$yOffset);
    }

    private function watermarkImages($file, $sizes,$position,$xOffset,$yOffset) {

        $path_uploaded = ImagePath::getImagePath($file);
        if (file_exists($path_uploaded)) {
            $this->watermarkImage($path_uploaded,$position,$xOffset,$yOffset);
        }
        $this->watermarkThumbnails($sizes,$position,$xOffset,$yOffset);
    }
    
    function watermarkImage($path_uploaded,$position,$xOffset,$yOffset) {
        $targetImage = $this->imageHandler->open($path_uploaded);
        $size = $targetImage->getSize();
        $wSize = $this->watermarkImage->getSize();
        $targetImage->paste($this->watermarkImage, Position::getPositionAsPoint($size,$wSize,$position,$xOffset,$yOffset));
        $targetImage->save($path_uploaded);
    }

    function watermarkThumbnails($sizes,$position,$xOffset,$yOffset) {
        foreach ($sizes as $name=>$sizeData) {
            if ($sizeData['width'] > 300) {
                $path = ImagePath::getImagePath($sizeData['file'], false);
                $this->watermarkImage($path,$position,$xOffset,$yOffset);
            }
        }
    }

}

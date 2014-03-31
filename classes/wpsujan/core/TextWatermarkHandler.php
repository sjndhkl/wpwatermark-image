<?php
namespace wpsujan\core;

class TextWatermarkHandler implements WatermarkHandlerInterface{
    
    private $imageHandler;
    private $watermarkTextBox;
    
    public function __construct($imageHandler,$fontPath,$text,$font_size=16) {
       
        if(is_null($imageHandler)){
            throw new \Exception("No Image Handler Specified");
        }
        $this->imageHandler = $imageHandler;
        $font = new \Imagine\Gd\Font($fontPath,$font_size,new \Imagine\Image\Color('fff'));
         if(is_null($font)){
            throw new \Exception("No Font Specified Specified");
        }
        $box = $font->box($text);
        $textImage = $imageHandler->create(new \Imagine\Image\Box($box->getWidth()+2+3, $box->getHeight()+2), new \Imagine\Image\Color('000'));
        $textImage->draw()->text($text,$font,new \Imagine\Image\Point(2,2));
        $this->watermarkTextBox  = $textImage;
    }
    
    public function handle($data, $position = Position::BOTTOM_RIGHT,$xOffset=5,$yOffset=5)     {
        $file = $data['file'];
        $sizes = $data['sizes'];
        $path_uploaded = ImagePath::getImagePath($file);
        if (file_exists($path_uploaded)) {
            $this->watermarkWithText($path_uploaded,$position,$xOffset,$yOffset);
        }
        $this->watermarkWithTextThumbnails($sizes, $position, $xOffset, $yOffset);
    }
    
    private function watermarkWithText($path_uploaded,$position,$xOffset,$yOffset) {
        $targetImage = $this->imageHandler->open($path_uploaded);
        $size = $targetImage->getSize();
        $wSize = $this->watermarkTextBox->getSize();
        $targetImage->paste($this->watermarkTextBox, Position::getPositionAsPoint($size,$wSize,$position,$xOffset,$yOffset));
        $targetImage->save($path_uploaded);
    }
    
    function watermarkWithTextThumbnails($sizes,$position,$xOffset,$yOffset) {
        foreach ($sizes as $name=>$sizeData) {
            if ($sizeData['width'] > 300) {
                $path = ImagePath::getImagePath($sizeData['file'], false);
                $this->watermarkWithText($path,$position,$xOffset,$yOffset);
            }
        }
    }
}


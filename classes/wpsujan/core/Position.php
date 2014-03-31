<?php

namespace wpsujan\core;

class Position {
    
    const TOP_RIGHT = 1;
    const TOP_CENTRE = 2;
    const TOP_LEFT = 3;
    
    const CENTRE_RIGHT = 4;
    const CENTRE = 5;
    const CENTRE_LEFT = 6;
    
    const BOTTOM_RIGHT = 7;
    const BOTTOM_CENTRE = 8;
    const BOTTOM_LEFT = 9;
    
    
    static function getPositionAsPoint($size,$wSize,$position,$xOffset,$yOffset){
        $point = null;
        switch($position){
            case self::TOP_LEFT:
                $point = new \Imagine\Image\Point($xOffset,$yOffset);
                break;
            case  self::TOP_CENTRE:
                $point = new \Imagine\Image\Point($size->getWidth()/2 - $wSize->getWidth()/2,$yOffset);
                break;
            case  self::TOP_RIGHT:
                $point = new \Imagine\Image\Point($size->getWidth() - $wSize->getWidth()-$xOffset,$yOffset);
                break;
            
             case  self::CENTRE_LEFT:
                $point = new \Imagine\Image\Point($xOffset,$size->getHeight()/2 - $wSize->getHeight()/2);
                break;
            case  self::CENTRE:
                $point = new \Imagine\Image\Point($size->getWidth()/2 - $wSize->getWidth()/2,$size->getHeight()/2 - $wSize->getHeight()/2);
                break;
            case  self::CENTRE_RIGHT:
                $point = new \Imagine\Image\Point($size->getWidth() - $wSize->getWidth()-$xOffset,$size->getHeight()/2 - $wSize->getHeight()/2);
                break;
             case  self::BOTTOM_LEFT:
                $point = new \Imagine\Image\Point($yOffset, $size->getHeight() - $wSize->getHeight() - $yOffset);
                break;
             case  self::BOTTOM_CENTRE:
                $point = new \Imagine\Image\Point($size->getWidth()/2 - $wSize->getWidth()/2, $size->getHeight() - $wSize->getHeight() - $yOffset);
                break;
            case  self::BOTTOM_RIGHT:
            default:
                $point = new \Imagine\Image\Point($size->getWidth() - $wSize->getWidth() - $xOffset, $size->getHeight() - $wSize->getHeight() - $yOffset);
                break;
        }
        return $point;
    }
    
}

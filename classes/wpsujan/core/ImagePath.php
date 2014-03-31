<?php
namespace wpsujan\core;

class ImagePath {
    static function getImagePath($name, $return_with_rootdir = true) {
        $upload_dir = wp_upload_dir();
        $filepath = $name;
        if ($return_with_rootdir) {
            $segments_raw = explode('/', $name);
            $segments = array_reverse($segments_raw);
            $filepath = $segments[0];
        }
        return $upload_dir['path'] . '/' . $filepath;
    }
}

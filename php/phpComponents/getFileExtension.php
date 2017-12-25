<?php
    function resolve($name) {
        // reads informations over the path
        $info = pathinfo($name);
        if (!empty($info['extension'])) {
            // if the file already contains an extension returns it
            return $name;
        }
        $filename = $info['filename'];
        $len = strlen($filename);
        // open the folder
        $dh = opendir($info['dirname']);
        if (!$dh) {
            return false;
        }
        // scan each file in the folder
        while (($file = readdir($dh)) !== false) {
            if (strncmp($file, $filename, $len) === 0) {
                if (strlen($name) > $len) {
                    // if name contains a directory part
                    $name = substr($name, 0, strlen($name) - $len) . $file;
                } else {
                    // if the name is at the path root
                    $name = $file;
                }
                closedir($dh);
                return $name;
            }
        }
        // file not found
        closedir($dh);
        return false;
    }
?>
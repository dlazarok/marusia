<?php
spl_autoload_register(
    function ($className) {
        $subject = preg_split('/\\\\/',$className);
        $subject[count($subject)-1] = 'class.' . $subject[count($subject)-1];
        $fileName = str_replace(
            ['ILoveMarusia', '\\'],
            ['ilovemarusia.space', '/'],
            implode('/', $subject)
        ) . '.php';
        if (file_exists(GIRAR_DATA_DIR . '/' . $fileName)) {
            return (@include GIRAR_DATA_DIR . '/' . $fileName);
        }
        return false;
    }
);

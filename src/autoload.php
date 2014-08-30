<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
spl_autoload_register(
    function ($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'robertfirek\\translator\\commandtranslation' => '/translator/CommandTranslation.php',
                'robertfirek\\translator\\translator' => '/translator/Translator.php',
                'robertfirek\\processor\\command' => '/processor/Command.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
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
                'robertfirek\\processor\\command' => '/processor/Command.php',
                'robertfirek\\processor\\commandprocessor' => '/processor/CommandProcessor.php',
                'robertfirek\\processor\\postcommandprocessor' => '/processor/PostCommandProcessor.php',
                'robertfirek\\processor\\readcommandprocessor' => '/processor/ReadCommandProcessor.php',
                'robertfirek\\processor\\subscribecommandprocessor' => '/processor/SubscribeCommandProcessor.php',
                'robertfirek\\processor\\wallcommandprocessor' => '/processor/WallCommandProcessor.php',
                'robertfirek\\wall\\wallservice' => '/wall/WallService.php',
                'robertfirek\\display\\messageformatter' => '/display/MessageFormatter.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
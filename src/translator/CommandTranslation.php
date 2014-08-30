<?php
namespace RobertFirek\Translator;

abstract class CommandTranslation
{
    const POST = "/^\\w+ -> .+$/m";
    const READ = "/^\\w+$/m";
    const SUBSCRIBE = "/\\w+ follows \\w+/m";
    const WALL = "/\\w+ wall/m";

    public static function all()
    {
        return array(CommandTranslation::POST,
            CommandTranslation::READ,
            CommandTranslation::SUBSCRIBE,
            CommandTranslation::WALL);
    }
}

?>
<?php
namespace RobertFirek\Translator;


class CommandTranslation
{
    private static $POST_REGULAR_EXPR = "/^(\\w+) -> (.+)$/m";
    private static $READ_REGULAR_EXPR = "/^(\\w+)$/m";
    private static $SUBSCRIBE_REGULAR_EXPR = "/(\\w+) follows (\\w+)/m";
    private static $WALL_REGULAR_EXPR = "/(\\w+) wall/m";

    private $commandMatchingRegularExpression;
    private $processClassName;

    private function __construct($commandMatchingRegularExpression, $processorClassName)
    {
        $this->commandMatchingRegularExpression = $commandMatchingRegularExpression;
        $this->processClassName = $processorClassName;
    }

    public function getCommandMatchingRegularExpression()
    {
        return $this->commandMatchingRegularExpression;
    }

    public function getProcessClassName()
    {
        return $this->processClassName;
    }


    public static function all()
    {
        return array(new CommandTranslation(CommandTranslation::$POST_REGULAR_EXPR, "RobertFirek\\Processor\\PostCommandProcessor"),
            new CommandTranslation(CommandTranslation::$READ_REGULAR_EXPR, "RobertFirek\\Processor\\ReadCommandProcessor"),
            new CommandTranslation(CommandTranslation::$SUBSCRIBE_REGULAR_EXPR, "RobertFirek\\Processor\\SubscribeCommandProcessor"),
            new CommandTranslation(CommandTranslation::$WALL_REGULAR_EXPR, "RobertFirek\\Processor\\WallCommandProcessor"));
    }
}

?>
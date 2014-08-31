<?php
require("autoload.php");
use \RobertFirek\Wall\WallService as WallService;
use \RobertFirek\Translator\Translator as Translator;
use \RobertFirek\Translator\CommandTranslation as CommandTranslation;
use \RobertFirek\Display\MessageFormatter as MessageFormatter;

$wallService = new WallService();
$translator = new Translator(CommandTranslation::all());
$messageFormatter = new MessageFormatter();
$formatMethods = array(
    "RobertFirek\\Processor\\ReadCommandProcessor" => "formatReadMessages",
    "RobertFirek\\Processor\\WallCommandProcessor" => "formatWallMessages"
);

while (true) {
    $commandText = trim(fgets(STDIN));
    if ($commandText == "exit") {
        break;
    }
    $command = $translator->translateCommandText($commandText);
    if ($command) {
        $commandResponse = $command->execute($wallService);
        if (isset($formatMethods[$command->getProcessorClass()])) {
            $formatMethod = $formatMethods[$command->getProcessorClass()];
            print_r($messageFormatter->$formatMethod(new DateTime(), "\n", $commandResponse));
        }
    }
}

?>
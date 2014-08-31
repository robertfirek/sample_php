<?php

require("autoload.php");
use \RobertFirek\Wall\WallService as WallService;
use \RobertFirek\Translator\Translator as Translator;
use \RobertFirek\Translator\CommandTranslation as CommandTranslation;
use \RobertFirek\Display\MessageFormatter as MessageFormatter;

session_start();

if (!isset($_SESSION["WallService"])) {
    $_SESSION["WallService"] = new WallService();
}
$wallService = $_SESSION["WallService"];
$translator = new Translator(CommandTranslation::all());
$messageFormatter = new MessageFormatter();
$formatMethods = array(
    "RobertFirek\\Processor\\ReadCommandProcessor" => "formatReadMessages",
    "RobertFirek\\Processor\\WallCommandProcessor" => "formatWallMessages"
);

print_r("<html><body>");

print_r("<form action='html.php' method='post'><input name='command' type='text' /><br/><input type='submit' value='Send command' /></form><br/>");


if (isset($_POST["command"])) {
    $commandText = $_POST["command"];
    $command = $translator->translateCommandText($commandText);
    $commandResponse = $command->execute($wallService);
    if (isset($formatMethods[$command->getProcessorClass()])) {
        $formatMethod = $formatMethods[$command->getProcessorClass()];
        print_r($messageFormatter->$formatMethod(new DateTime(), "<br />", $commandResponse));
    }
}

print_r("</body></html>");

?>
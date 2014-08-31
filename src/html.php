<?php

require("autoload.php");
use \RobertFirek\Wall\WallService as WallService;
use \RobertFirek\Translator\Translator as Translator;
use \RobertFirek\Translator\CommandTranslation as CommandTranslation;

session_start();

if (!isset($_SESSION["WallService"])) {
    $_SESSION["WallService"] = new WallService();
}
$wallService = $_SESSION["WallService"];
$translator = new Translator(CommandTranslation::all());
$displayFunctions = array(
    "RobertFirek\\Processor\\ReadCommandProcessor" => "displayRead",
    "RobertFirek\\Processor\\WallCommandProcessor" => "displayWall"
);

print_r("<html><body>");

print_r("<form action='html.php'><input name='command' type='text' /><br/><input type='submit' value='Send command' /></form><br/>");


if (isset($_GET["command"])) {
    $commandText = $_GET["command"];
    $command = $translator->translateCommandText($commandText);
    if ($command) {
        $commandResponse = $command->execute($wallService);
        if (isset($displayFunctions[$command->getProcessorClass()])) {
            $displayFunctions[$command->getProcessorClass()]($commandResponse);
        }
    }
}

print_r("</body></html>");

function displayRead($messages)
{
    foreach ($messages as $message) {
        print_r($message["message"] . " (" . getTimeDifferenceInMinute($message["time"]) . ")<br/>");
    }
}

function displayWall($messages)
{
    foreach ($messages as $message) {
        print_r($message["userName"] . " - " . $message["message"] . " (" . getTimeDifferenceInMinute($message["time"]) . ")<br/>");
    }
}

function getTimeDifferenceInMinute(DateTime $time)
{
    $now = new DateTime();
    $timeDifferenceInSeconds = $now->getTimestamp() - $time->getTimestamp();
    $timeDifferenceInMinutes = (int)($timeDifferenceInSeconds / 60);
    if ($timeDifferenceInMinutes != 0) {
        return $timeDifferenceInMinutes . ($timeDifferenceInMinutes == 1 ? " minute" : " minutes") . " ago";
    }
    return $timeDifferenceInSeconds . ($timeDifferenceInSeconds == 1 ? " second" : " seconds") . " ago";
}

?>
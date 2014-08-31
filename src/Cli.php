<?php
require("autoload.php");
use \RobertFirek\Wall\WallService as WallService;
use \RobertFirek\Translator\Translator as Translator;
use \RobertFirek\Translator\CommandTranslation as CommandTranslation;

$wallService = new WallService();
$translator = new Translator(CommandTranslation::all());
$displayFunctions = array(
    "RobertFirek\\Processor\\ReadCommandProcessor" => "displayRead",
    "RobertFirek\\Processor\\WallCommandProcessor" => "displayWall"
);

while (true) {
    $commandText = trim(fgets(STDIN));
    if ($commandText == "exit") {
        break;
    }
    $command = $translator->translateCommandText($commandText);
    if ($command) {
        $response = $command->execute($wallService);
        if (isset($displayFunctions[$command->getProcessorClass()])) {
            $displayFunctions[$command->getProcessorClass()]($response);
        }
    }
}

function displayRead($messages)
{
    foreach ($messages as $message) {
        print_r($message["message"] . " (" . getTimeDifferenceInMinute($message["time"]) . ")\n");
    }
}

function displayWall($messages)
{
    foreach ($messages as $message) {
        print_r($message["userName"] . " - " . $message["message"] . " (" . getTimeDifferenceInMinute($message["time"]) . ")\n");
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
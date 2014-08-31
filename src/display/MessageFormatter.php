<?php
namespace RobertFirek\Display;

class MessageFormatter
{
    public function formatReadMessages(\DateTime $baseDate, $messageSeparator, $messages)
    {
        $formattedMessage = "";
        foreach ($messages as $message) {
            $formattedMessage .= $message["message"] . " (" . $this->getTimeDifferenceInMinute($baseDate, $message["time"]) . ")" . $messageSeparator;
        }
        return $formattedMessage;
    }

    public function formatWallMessages(\DateTime $baseDate, $messageSeparator, $messages)
    {
        $formattedMessage = "";
        foreach ($messages as $message) {
            $formattedMessage .= $message["userName"] . " - "
                . $message["message"] . " (" . $this->getTimeDifferenceInMinute($baseDate, $message["time"]) . ")" . $messageSeparator;
        }
        return $formattedMessage;
    }

    private function getTimeDifferenceInMinute(\DateTime $baseDate, \DateTime $time)
    {
        $timeDifferenceInSeconds = $baseDate->getTimestamp() - $time->getTimestamp();
        $timeDifferenceInMinutes = (int)($timeDifferenceInSeconds / 60);
        if ($timeDifferenceInMinutes != 0) {
            return $timeDifferenceInMinutes . ($timeDifferenceInMinutes == 1 ? " minute" : " minutes") . " ago";
        }
        return $timeDifferenceInSeconds . ($timeDifferenceInSeconds == 1 ? " second" : " seconds") . " ago";
    }
}

?>
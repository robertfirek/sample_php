<?php
namespace RobertFirek\Wall;

class WallService
{

    private $wallData;

    public function __constructor()
    {
        $this->wallData = array();
    }

    public function postMessage($userName, $message)
    {
        if (!isset($this->wallData[$userName])) {
            $this->wallData[$userName] = array("subscribedUsers" => array(), "messages" => array());
        }
        array_unshift($this->wallData[$userName]["messages"],
            array("userName" => $userName, "message" => $message, "time" => new \DateTime(), "timestamp" => microtime(true))
        );
    }

    public function readMessages($userName)
    {
        return isset($this->wallData[$userName]) ? $this->wallData[$userName]["messages"] : array();
    }

    public function subscribeMessages($subscriberName, $userNameToSubscribe)
    {
        if (isset($this->wallData[$subscriberName])) {
            array_push($this->wallData[$subscriberName]["subscribedUsers"], $userNameToSubscribe);
        }
    }

    public function wallMessages($userName)
    {
        $wallMessages = array();
        if (isset($this->wallData[$userName])) {
            $wallMessages = array_merge($wallMessages, $this->wallData[$userName]["messages"]);

            foreach ($this->wallData[$userName]["subscribedUsers"] as $subscribedUser) {
                $wallMessages = array_merge($wallMessages, $this->getSubscribedUserMessages($subscribedUser));
            }
        }
        $wallMessages = $this->sortWallMessages($wallMessages);
        return $wallMessages;
    }

    private function getSubscribedUserMessages($userName)
    {
        if (isset($this->wallData[$userName])) {
            return $this->wallData[$userName]["messages"];
        }
        return array();
    }

    private function sortWallMessages($wallMessages)
    {
        usort($wallMessages, function ($messageOne, $messageTwo) {

            if ($messageOne["timestamp"] == $messageTwo["timestamp"]) {
                return 0;
            }

            return ($messageOne["timestamp"] < $messageTwo["timestamp"]) ? 1 : -1;
        });
        return $wallMessages;
    }
}

?>
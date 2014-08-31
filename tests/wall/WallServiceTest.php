<?php
namespace RobertFirek\Wall;

class WallServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBeAbleToPostAndReadMessagesByUserName()
    {
        $wallService = new WallService();
        $userName = "Name";
        $message = "Message";
        $anotherMessage = "Message no 2";
        $expectedNumberOfMessages = 2;

        $wallService->postMessage($userName, $message);
        $wallService->postMessage($userName, $anotherMessage);
        $userMessages = $wallService->readMessages($userName);

        $this->assertCount($expectedNumberOfMessages, $userMessages);
        $this->assertEquals($anotherMessage, $userMessages[0]["message"]);
        $this->assertEquals($message, $userMessages[1]["message"]);

    }

    public function testShouldBeAbleToSubscribeToAnotherUserMessagesRetreiveCombinedWallOfMessages()
    {
        $wallService = new WallService();
        $userName = "Name";
        $secondUserName = "Name no 2";
        $thirdUserName = "Name no 3";
        $messages = array("Message no 1", "Message no 2", "Message no 3", "Message no 4", "Message no 5");
        $expectedNumberOfUserMessages = 3;
        $expectedNumberOfWallMessages = 5;

        $wallService->postMessage($userName, $messages[0]);
        $wallService->postMessage($thirdUserName, $messages[1]);
        $wallService->postMessage($userName, $messages[2]);
        $wallService->postMessage($secondUserName, $messages[3]);
        $wallService->postMessage($userName, $messages[4]);
        $wallService->subscribeMessages($userName, $secondUserName);
        $wallService->subscribeMessages($userName, $thirdUserName);
        $userMessages = $wallService->readMessages($userName);
        $wallMessages = $wallService->wallMessages($userName);

        $this->assertCount($expectedNumberOfUserMessages, $userMessages);
        $this->assertCount($expectedNumberOfWallMessages, $wallMessages);
        $this->assertUserMessages($messages, $userMessages, $userName);
        $this->assertWallMessages($messages, $wallMessages, $userName, $thirdUserName, $secondUserName);

    }

    private function assertUserMessages($messages, $userMessages, $userName)
    {
        $this->assertEquals($messages[0], $userMessages[2]["message"]);
        $this->assertEquals($messages[2], $userMessages[1]["message"]);
        $this->assertEquals($messages[4], $userMessages[0]["message"]);
        $this->assertEquals($userName, $userMessages[0]["userName"]);
        $this->assertEquals($userName, $userMessages[1]["userName"]);
        $this->assertEquals($userName, $userMessages[2]["userName"]);
    }

    private function assertWallMessages($messages, $wallMessages, $userName, $thirdUserName, $secondUserName)
    {
        $this->assertEquals($messages[0], $wallMessages[4]["message"]);
        $this->assertEquals($messages[1], $wallMessages[3]["message"]);
        $this->assertEquals($messages[2], $wallMessages[2]["message"]);
        $this->assertEquals($messages[3], $wallMessages[1]["message"]);
        $this->assertEquals($messages[4], $wallMessages[0]["message"]);
        $this->assertEquals($userName, $wallMessages[0]["userName"]);
        $this->assertEquals($secondUserName, $wallMessages[1]["userName"]);
        $this->assertEquals($userName, $wallMessages[2]["userName"]);
        $this->assertEquals($thirdUserName, $wallMessages[3]["userName"]);
        $this->assertEquals($userName, $wallMessages[4]["userName"]);
    }
}
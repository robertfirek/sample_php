<?php
namespace RobertFirek\Processor;

use RobertFirek\Wall\WallService;

class SubscribeCommandProcessorTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldProcessCommand()
    {
        $userName = "Name";
        $anotherUserName = "Another Name";
        $message = "Message";
        $anotherMessage = "Another Message";
        $expectedNumberOfMessages = 2;
        $wallService = new WallService();
        $wallService->postMessage($userName, $message);
        $wallService->postMessage($anotherUserName, $anotherMessage);
        $subscribeCommandProcessor = new SubscribeCommandProcessor($wallService);

        $subscribeCommandProcessor->process(array($userName, $anotherUserName));
        $wallMessages = $wallService->wallMessages($userName);

        $this->assertCount($expectedNumberOfMessages, $wallMessages);
        $this->assertEquals($anotherMessage, $wallMessages[0]["message"]);
        $this->assertEquals($message, $wallMessages[1]["message"]);
    }
}

?>
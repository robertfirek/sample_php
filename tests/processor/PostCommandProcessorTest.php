<?php
namespace RobertFirek\Processor;

use RobertFirek\Wall\WallService;

class PostCommandProcessorTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldProcessCommand()
    {
        $userName = "Name";
        $message = "Message";
        $expectedNumberOfMessages = 1;
        $wallService = new WallService();
        $postCommandProcessor = new PostCommandProcessor($wallService);

        $postCommandProcessor->process(array($userName, $message));
        $userMessages = $wallService->readMessages($userName);

        $this->assertCount($expectedNumberOfMessages, $userMessages);
        $this->assertEquals($message, $userMessages[0]["message"]);
    }
}

?>
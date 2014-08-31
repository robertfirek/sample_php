<?php
namespace RobertFirek\Processor;

use RobertFirek\Wall\WallService;

class ReadCommandProcessorTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldProcessCommand()
    {
        $userName = "Name";
        $message = "Message";
        $expectedNumberOfMessages = 1;
        $wallService = new WallService();
        $wallService->postMessage($userName, $message);
        $readCommandProcessor = new ReadCommandProcessor($wallService);

        $userMessages = $readCommandProcessor->process(array($userName));

        $this->assertCount($expectedNumberOfMessages, $userMessages);
        $this->assertEquals($message, $userMessages[0]["message"]);
    }
}

?>
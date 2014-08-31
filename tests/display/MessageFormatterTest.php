<?php
namespace RobertFirek\Display;

class MessageFormatterTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldFormatReadMessagesUsingDefinedMessageSeparator()
    {
        $baseDate = new \DateTime();
        $firstDate = new \DateTime();
        $firstDate->setTimestamp($baseDate->getTimestamp())->sub(new \DateInterval("PT5S"));
        $secondDate = new \DateTime();
        $secondDate->setTimestamp($baseDate->getTimestamp())->sub(new \DateInterval("PT15S"));
        $messageSeparator = ";";
        $messages = array(
            array("userName" => "someUser", "message" => "first message", "time" => $firstDate),
            array("userName" => "someUser", "message" => "second message", "time" => $secondDate)
        );
        $expectedFormattedMessage = "first message (5 seconds ago);second message (15 seconds ago);";
        $messageFormatter = new MessageFormatter();

        $formattedMessages = $messageFormatter->formatReadMessages($baseDate, $messageSeparator, $messages);

        $this->assertEquals($expectedFormattedMessage, $formattedMessages);
    }

    public function testShouldFormatWallMessagesUsingDefinedMessageSeparator()
    {
        $baseDate = new \DateTime();
        $firstDate = new \DateTime();
        $firstDate->setTimestamp($baseDate->getTimestamp())->sub(new \DateInterval("PT2S"));
        $secondDate = new \DateTime();
        $secondDate->setTimestamp($baseDate->getTimestamp())->sub(new \DateInterval("PT4S"));
        $messageSeparator = ";";
        $messages = array(
            array("userName" => "someUser", "message" => "first message", "time" => $firstDate),
            array("userName" => "anotherUser", "message" => "second message", "time" => $secondDate)
        );
        $expectedFormattedMessage = "someUser - first message (2 seconds ago);anotherUser - second message (4 seconds ago);";
        $messageFormatter = new MessageFormatter();

        $formattedMessages = $messageFormatter->formatWallMessages($baseDate, $messageSeparator, $messages);

        $this->assertEquals($expectedFormattedMessage, $formattedMessages);
    }
}

?>
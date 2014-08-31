<?php

namespace RobertFirek\Translator;

class TranslatorTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldBeAbleTranslateProperCommandTextToCommand()
    {
        $translator = new Translator(CommandTranslation::all());

        $postCommandText = "Name -> Text";
        $postCommandExpectedParameters = array("Name", "Text");

        $readCommandText = "Name";
        $readCommandExpectedParameters = array("Name");

        $subscribeCommandText = "Name follows Name2";
        $subscribeCommandExpectedParameters = array("Name", "Name2");

        $wallCommandText = "Name wall";
        $wallCommandExpectedParameters = array("Name");

        $invalidCommandText = "Text Text";


//        $time_one = new \DateTime('2010-07-30 00:43:45');
//        $time_two = new \DateTime('2010-07-30 01:23:45');
//
//        echo (int)(($time_two->getTimestamp() - $time_one->getTimestamp())/60);


        $postCommand = $translator->translateCommandText($postCommandText);
        $readCommand = $translator->translateCommandText($readCommandText);
        $subscribeCommand = $translator->translateCommandText($subscribeCommandText);
        $wallCommand = $translator->translateCommandText($wallCommandText);
        $invalidCommand = $translator->translateCommandText($invalidCommandText);

        $this->assertNull($invalidCommand);
        $this->assertCommand($postCommand, "RobertFirek\\Processor\\PostCommandProcessor", $postCommandExpectedParameters);
        $this->assertCommand($readCommand, "RobertFirek\\Processor\\ReadCommandProcessor", $readCommandExpectedParameters);
        $this->assertCommand($subscribeCommand, "RobertFirek\\Processor\\SubscribeCommandProcessor", $subscribeCommandExpectedParameters);
        $this->assertCommand($wallCommand, "RobertFirek\\Processor\\WallCommandProcessor", $wallCommandExpectedParameters);
    }


    private function assertCommand(\RobertFirek\Processor\Command $command, $expectedCommandProcessor, array $commandParameters)
    {
        $this->assertNotNull($command);
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $command);
        $this->assertEquals($expectedCommandProcessor, $command->getProcessorClass());
        $this->assertEquals($commandParameters, $command->getParameters());
    }
}

?>
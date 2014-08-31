<?php

namespace RobertFirek\Translator;


class TranslatorTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldBeAbleTranslateProperCommandTextToCommand()
    {
        $translator = new Translator(CommandTranslation::all());
        $postCommandText = "Name -> Text";
        $readCommandText = "Name";
        $subscribeCommandText = "Name follows Name2";
        $wallCommandText = "Name wall";
        $invalidCommandText = "Text Text";

        $postCommand = $translator->translateCommandText($postCommandText);
        $readCommand = $translator->translateCommandText($readCommandText);
        $subscribeCommand = $translator->translateCommandText($subscribeCommandText);
        $wallCommand = $translator->translateCommandText($wallCommandText);
        $invalidCommand = $translator->translateCommandText($invalidCommandText);

        $this->assertNull($invalidCommand);
        $this->assertNotNull($postCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $postCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\PostCommandProcessor", $postCommand->getProcessor());
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $readCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\ReadCommandProcessor", $readCommand->getProcessor());
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $subscribeCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\SubscribeCommandProcessor", $subscribeCommand->getProcessor());
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $wallCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\WallCommandProcessor", $wallCommand->getProcessor());

    }
}

?>
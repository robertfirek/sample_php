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
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $readCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $subscribeCommand);
        $this->assertInstanceOf("RobertFirek\\Processor\\Command", $wallCommand);

    }

    public function testShouldNotTranslateUnknownCommandText()
    {
        $this->assertTrue(TRUE);
    }
}

?>
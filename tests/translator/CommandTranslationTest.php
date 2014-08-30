<?php
namespace RobertFirek\Translator;

class CommandTranslationTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldContainsOnlyAvailableCommands()
    {
        $expectedNumberOfDefinitions = 4;

        $definitions = CommandTranslation::all();

        $this->assertCount($expectedNumberOfDefinitions, $definitions);
        $this->assertContains(CommandTranslation::POST, $definitions);
        $this->assertContains(CommandTranslation::READ, $definitions);
        $this->assertContains(CommandTranslation::SUBSCRIBE, $definitions);
        $this->assertContains(CommandTranslation::WALL, $definitions);
    }

    public function testOfPostCommandShouldMatchProperCommandText()
    {
        $properPostCommand = "My_NAME -> My_POST text!@#$%^&*()";
        $postCommandWithoutName = " -> My_POST text!@#$%^&*()";
        $postCommandWithoutPost = "My_NAME -> ";
        $postCommandWithoutParameters = " -> ";

        $properPostCommandMatch = preg_match(CommandTranslation::POST, $properPostCommand);
        $postCommandWithoutNameMatch = preg_match(CommandTranslation::POST, $postCommandWithoutName);
        $postCommandWithoutPostMatch = preg_match(CommandTranslation::POST, $postCommandWithoutPost);
        $postCommandWithoutParametersMatch = preg_match(CommandTranslation::POST, $postCommandWithoutParameters);

        $this->assertEquals(1, $properPostCommandMatch);
        $this->assertEquals(0, $postCommandWithoutNameMatch);
        $this->assertEquals(0, $postCommandWithoutPostMatch);
        $this->assertEquals(0, $postCommandWithoutParametersMatch);
    }

    public function testOfReadCommandShouldMatchProperCommandText()
    {
        $properReadCommand = "My_NAME";
        $readCommandWithSpaces = " My_NAME ";

        $properReadCommandMatch = preg_match(CommandTranslation::READ, $properReadCommand);
        $readCommandWithSpacesMatch = preg_match(CommandTranslation::READ, $readCommandWithSpaces);

        $this->assertEquals(1, $properReadCommandMatch);
        $this->assertEquals(0, $readCommandWithSpacesMatch);
    }


    public function testOfSubscribeCommandShouldMatchProperCommandText()
    {
        $properSubscribeCommand = "My_NAME follows subscribe_to_Name";
        $subscribeCommandWithoutName = " follows subscribe_to_Name";
        $subscribeCommandWithoutSubscribeTo = "My_NAME follows ";
        $subscribeCommandWithoutParameters = " follows ";

        $properSubscribeCommandMatch = preg_match(CommandTranslation::SUBSCRIBE, $properSubscribeCommand);
        $subscribeCommandWithoutNameMatch = preg_match(CommandTranslation::SUBSCRIBE, $subscribeCommandWithoutName);
        $subscribeCommandWithoutSubscribeToMatch = preg_match(CommandTranslation::SUBSCRIBE, $subscribeCommandWithoutSubscribeTo);
        $subscribeCommandWithoutParametersMatch = preg_match(CommandTranslation::SUBSCRIBE, $subscribeCommandWithoutParameters);

        $this->assertEquals(1, $properSubscribeCommandMatch);
        $this->assertEquals(0, $subscribeCommandWithoutNameMatch);
        $this->assertEquals(0, $subscribeCommandWithoutSubscribeToMatch);
        $this->assertEquals(0, $subscribeCommandWithoutParametersMatch);
    }


    public function testOfWallCommandShouldMatchProperCommandText()
    {
        $properWallCommand = "My_NAME wall";
        $wallCommandWithoutName = " wall";

        $properWallCommandMatch = preg_match(CommandTranslation::WALL, $properWallCommand);
        $wallCommandWithoutNameMatch = preg_match(CommandTranslation::WALL, $wallCommandWithoutName);

        $this->assertEquals(1, $properWallCommandMatch);
        $this->assertEquals(0, $wallCommandWithoutNameMatch);
    }
}

?>
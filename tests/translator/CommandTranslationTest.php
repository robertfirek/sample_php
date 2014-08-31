<?php
namespace RobertFirek\Translator;

class CommandTranslationTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldContainsOnlyAvailableCommands()
    {
        $expectedNumberOfDefinitions = 4;

        $definitions = CommandTranslation::all();

        $this->assertCount($expectedNumberOfDefinitions, $definitions);
    }

    public function testOfPostCommandShouldMatchValidCommandText()
    {
        $validPostCommand = "My_NAME -> My_POST text!@#$%^&*()";
        $postCommandWithoutName = " -> My_POST text!@#$%^&*()";
        $postCommandWithoutPost = "My_NAME -> ";
        $postCommandWithoutParameters = " -> ";
        $postCommandTranslation = CommandTranslation::all()[0];
        $postCommandRegexp = $postCommandTranslation->getCommandMatchingRegularExpression();

        $validPostCommandMatch = preg_match($postCommandRegexp, $validPostCommand);
        $postCommandWithoutNameMatch = preg_match($postCommandRegexp, $postCommandWithoutName);
        $postCommandWithoutPostMatch = preg_match($postCommandRegexp, $postCommandWithoutPost);
        $postCommandWithoutParametersMatch = preg_match($postCommandRegexp, $postCommandWithoutParameters);

        $this->assertEquals("RobertFirek\\Processor\\PostCommandProcessor", $postCommandTranslation->getProcessClassName());
        $this->assertEquals(1, $validPostCommandMatch);
        $this->assertEquals(0, $postCommandWithoutNameMatch);
        $this->assertEquals(0, $postCommandWithoutPostMatch);
        $this->assertEquals(0, $postCommandWithoutParametersMatch);
    }

    public function testOfReadCommandShouldMatchValidCommandText()
    {
        $validReadCommand = "My_NAME";
        $readCommandWithSpaces = " My_NAME ";
        $readCommandTranslation = CommandTranslation::all()[1];
        $readCommandRegexp = $readCommandTranslation->getCommandMatchingRegularExpression();

        $validReadCommandMatch = preg_match($readCommandRegexp, $validReadCommand);
        $readCommandWithSpacesMatch = preg_match($readCommandRegexp, $readCommandWithSpaces);

        $this->assertEquals("RobertFirek\\Processor\\ReadCommandProcessor", $readCommandTranslation->getProcessClassName());
        $this->assertEquals(1, $validReadCommandMatch);
        $this->assertEquals(0, $readCommandWithSpacesMatch);
    }


    public function testOfSubscribeCommandShouldMatchValidCommandText()
    {
        $validSubscribeCommand = "My_NAME follows subscribe_to_Name";
        $subscribeCommandWithoutName = " follows subscribe_to_Name";
        $subscribeCommandWithoutSubscribeTo = "My_NAME follows ";
        $subscribeCommandWithoutParameters = " follows ";
        $subscribeCommandTranslation = CommandTranslation::all()[2];
        $subscribeCommandRegexp = $subscribeCommandTranslation->getCommandMatchingRegularExpression();

        $validSubscribeCommandMatch = preg_match($subscribeCommandRegexp, $validSubscribeCommand);
        $subscribeCommandWithoutNameMatch = preg_match($subscribeCommandRegexp, $subscribeCommandWithoutName);
        $subscribeCommandWithoutSubscribeToMatch = preg_match($subscribeCommandRegexp, $subscribeCommandWithoutSubscribeTo);
        $subscribeCommandWithoutParametersMatch = preg_match($subscribeCommandRegexp, $subscribeCommandWithoutParameters);

        $this->assertEquals("RobertFirek\\Processor\\SubscribeCommandProcessor", $subscribeCommandTranslation->getProcessClassName());
        $this->assertEquals(1, $validSubscribeCommandMatch);
        $this->assertEquals(0, $subscribeCommandWithoutNameMatch);
        $this->assertEquals(0, $subscribeCommandWithoutSubscribeToMatch);
        $this->assertEquals(0, $subscribeCommandWithoutParametersMatch);
    }


    public function testOfWallCommandShouldMatchValidCommandText()
    {
        $validWallCommand = "My_NAME wall";
        $wallCommandWithoutName = " wall";
        $wallCommandTranslation = CommandTranslation::all()[3];
        $wallCommandRegexp = $wallCommandTranslation->getCommandMatchingRegularExpression();

        $validWallCommandMatch = preg_match($wallCommandRegexp, $validWallCommand);
        $wallCommandWithoutNameMatch = preg_match($wallCommandRegexp, $wallCommandWithoutName);

        $this->assertEquals("RobertFirek\\Processor\\WallCommandProcessor", $wallCommandTranslation->getProcessClassName());
        $this->assertEquals(1, $validWallCommandMatch);
        $this->assertEquals(0, $wallCommandWithoutNameMatch);
    }
}

?>
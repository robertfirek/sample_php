<?php
namespace RobertFirek\Processor;

use RobertFirek\Wall\WallService;

class CommandTest extends \PHPUnit_Framework_TestCase
{

    public function testShouldExecuteCommandUsingCommandProcessor()
    {

        $processorName = "RobertFirek\\Processor\\ReturnParametersCommandProcessor";
        $commandParameters = array("parameter1" => "value1");
        $command = new Command($processorName, $commandParameters);
        $wallService = new WallService();

        $returnedParameters = $command->execute($wallService);

        $this->assertEquals($commandParameters, $returnedParameters);
    }
}

class ReturnParametersCommandProcessor implements CommandProcessor
{
    public function __construct(\RobertFirek\Wall\WallService $wallService)
    {
    }

    public function process(array $parameters)
    {
        return $parameters;
    }
}

?>
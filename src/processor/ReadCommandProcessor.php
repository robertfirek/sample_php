<?php
namespace RobertFirek\Processor;

class ReadCommandProcessor implements CommandProcessor
{
    private $wallService;

    public function __construct(\RobertFirek\Wall\WallService $wallService)
    {
        $this->wallService = $wallService;
    }

    public function process(array $parameters)
    {
        return $this->wallService->readMessages($parameters[0]);
    }
}

?>
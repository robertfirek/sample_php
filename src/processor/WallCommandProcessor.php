<?php
namespace RobertFirek\Processor;

class WallCommandProcessor implements CommandProcessor
{
    private $wallService;

    public function __construct(\RobertFirek\Wall\WallService $wallService)
    {
        $this->wallService = $wallService;
    }

    public function process(array $parameters)
    {
        return $this->wallService->wallMessages($parameters[0]);
    }
}

?>
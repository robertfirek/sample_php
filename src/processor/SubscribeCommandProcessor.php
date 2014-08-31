<?php
namespace RobertFirek\Processor;

class SubscribeCommandProcessor implements CommandProcessor
{
    private $wallService;

    public function __construct(\RobertFirek\Wall\WallService $wallService)
    {
        $this->wallService = $wallService;
    }

    public function process(array $parameters)
    {
        $this->wallService->subscribeMessages($parameters[0], $parameters[1]);
    }
}

?>
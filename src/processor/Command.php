<?php
namespace RobertFirek\Processor;

class Command
{
    private $processorClass;
    private $parameters;

    public function __construct($processorClass, array $parameters)
    {
        $this->processorClass = $processorClass;
        $this->parameters = $parameters;
    }

    public function getProcessorClass()
    {
        return $this->processorClass;
    }


    public function getParameters()
    {
        return $this->parameters;
    }

    public function execute(\RobertFirek\Wall\WallService $wallService)
    {
        $processor = new $this->processorClass($wallService);
        return $processor->process($this->parameters);
    }
}

?>
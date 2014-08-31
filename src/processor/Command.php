<?php
namespace RobertFirek\Processor;

class Command
{
    /**
     * @var CommandProcessor
     */
    private $commandProcessor;

    public function __construct(CommandProcessor $commandProcessor)
    {
        $this->commandProcessor = $commandProcessor;
    }

    public function getProcessor() {
        return $this->commandProcessor;
    }
}

?>
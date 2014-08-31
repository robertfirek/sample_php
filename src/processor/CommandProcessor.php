<?php
namespace RobertFirek\Processor;

interface CommandProcessor
{
    public function __construct(\RobertFirek\Wall\WallService $wallService);

    public function process(array $parameters);
}

?>
<?php
namespace RobertFirek\Translator;
use RobertFirek\Processor\Command as Command;

class Translator
{
    private $commandTranslations;

    public function __construct(array $commandTranslations){
        $this->commandTranslations = $commandTranslations;
    }

    public function translateCommandText($commandText)
    {
        foreach ($this->commandTranslations as $commandTranslation) {
            if (preg_match($commandTranslation,$commandText)) {
                return new Command();
            }
        }
        return null;
    }
}

?>
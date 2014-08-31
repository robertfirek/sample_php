<?php
namespace RobertFirek\Translator;

use RobertFirek\Processor\Command as Command;

class Translator
{
    private $commandTranslations;

    public function __construct(array $commandTranslations)
    {
        $this->commandTranslations = $commandTranslations;
    }

    public function translateCommandText($commandText)
    {
        foreach ($this->commandTranslations as $commandTranslation) {

            if (preg_match($commandTranslation->getCommandMatchingRegularExpression(), $commandText, $matches)) {
                $commandParameters = array_slice($matches, 1);
                return new Command($commandTranslation->getProcessClassName(), $commandParameters);
            }
        }
        return null;
    }
}

?>
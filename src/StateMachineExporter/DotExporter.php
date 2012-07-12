<?php

namespace StateMachineExporter;

class DotExporter
{
    public function export(\Database $database)
    {
        foreach ($database->getTables() as $table) {
            if ($table->hasBehavior('state_machine')) {
                $behavior = $table->getBehavior('state_machine');

                $this->writeFile($behavior, sprintf('%s_%s.dot', $database->getName(), $table->getName()));
            }
        }
    }

    private function writeFile(\StateMachineBehavior $behavior, $filename) {
        $content = "digraph G {\n";
        foreach ($behavior->getTransitions() as $transition) {
            $content .= sprintf(
                '%s -> %s [label="%s"]' . "\n",
                $transition['from'],
                $transition['to'],
                $transition['symbol']
            );
        }

        $content .= "}\n";

        file_put_contents($filename, $content);
        echo sprintf("-> Wrote file \"%s\"\n", $filename);
    }
}

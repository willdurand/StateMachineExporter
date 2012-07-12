<?php

namespace StateMachineExporter;

class GeneratorConfig extends \QuickGeneratorConfig
{
    public function getConfiguredBehavior($name)
    {
        if ('state_machine' === $name) {
            return new \StateMachineBehavior();
        }

        if (false === $behavior = parent::getConfiguredBehavior($name)) {
            return new NoopBehavior();
        }

        return $behavior;
    }
}

class NoopBehavior extends \Behavior {}

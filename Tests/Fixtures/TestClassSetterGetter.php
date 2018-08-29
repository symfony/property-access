<?php

namespace Symfony\Component\PropertyAccess\Tests\Fixtures;


/**
 * @property mixed emptySignature
 * @property mixed withSignature
 */
class TestClassSetterGetter
{

    private $emptySignature;
    private $withSignature;


    /**
     * Cute helper that assigns a variable when called with two arguments.
     * The idea is to avoid two mutators for most (if not all) fields.
     *
     * Example:
     *
     *      class Foo
     *      {
     *          use TimeTracking\Trait\SetOrGetTrait;
     *          public function bar()
     *          {
     *              return $this->setOrGet(func_get_args(), $this->barProperty);
     *          }
     *      }
     *
     * @param array $callersArgv parameters of the function that called us.
     * @param mixed $targetProperty address of the property that will be assigned to.
     * @return static|mixed
     */
    protected function setOrGet($callersArgv, &$targetProperty) {
        if (count($callersArgv) > 0) {
            $targetProperty = $callersArgv[0];
            return $this;
        }
        return $targetProperty;
    }

    /**
     * @inheritdoc
     */
    public function withSignature($foo = null) {
        return $this->setOrGet(func_get_args(), $this->withSignature);
    }

    /**
     * @inheritdoc
     */
    public function emptySignature() {
        return $this->setOrGet(func_get_args(), $this->emptySignature);
    }
}

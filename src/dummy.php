<?php

namespace \Fine\Valid;

class f_valid_dummy extends ValidAbstract
{

    const NOT_VALID = 'NOT_VALID';

    protected $_dummy_valid;

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public static function _(array $config = array())
    {
        return new self($config);
    }

    public function valid($bDummyValid = null)
    {
        if (func_num_args() == 0) {
            return $this->_dummy_valid;
        }
        $this->_dummy_valid = $bDummyValid;
        return $this;
    }

    public function isValid($mValue = null)
    {
        if (!$this->_dummy_valid) {
            $this->_error(self::NOT_VALID);
            return false;
        }

        return true;
    }

}

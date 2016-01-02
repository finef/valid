<?php

namespace \Fine\Valid;

class f_valid_min extends ValidAbstract
{

    const NOT_MIN = 'NOT_MIN';

    protected $_var = array(
        '{min}' => '_min',
    );
    protected $_min;

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public static function _(array $config = array())
    {
        return new self($config);
    }

    public function min($fiMin = null)
    {
        if (func_num_args() == 0) {
            return $this->_min;
        }
        $this->_min = $fiMin;
        return $this;
    }

    public function isValid($mValue)
    {
        $iValue = (int) $mValue;
        $this->_val($iValue);

        if (!($iValue >= $this->_min)) {
            $this->_error(self::NOT_MIN);
            return false;
        }

        return true;
    }

}

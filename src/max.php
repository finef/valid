<?php

namespace \Fine\Valid;

class f_valid_max extends ValidAbstract
{

    const NOT_MAX = 'NOT_MAX';

    protected $_var = array(
        '{max}' => '_max'
    );
    protected $_max;

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public static function _(array $config = array())
    {
        return new self($config);
    }

    public function max($fiMax = null)
    {
        if (func_num_args() == 0) {
            return $this->_max;
        }
        $this->_max = $fiMax;
        return $this;
    }

    public function isValid($mValue)
    {
        $iValue = (int) $mValue;
        $this->_val($iValue);

        if (!($iValue <= $this->_max)) {
            $this->_error(self::NOT_MAX);
            return false;
        }

        return true;
    }

}

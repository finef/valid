<?php

namespace \Fine\Valid;

class f_valid_notEqual extends ValidAbstract
{

    const EQUAL = 'EQUAL';

    protected $_msg = array(
        self::EQUAL => 'Wartość musi być różna od \'{notEqual}\'',
    );
    protected $_var = array(
        '{notEqual}' => '_notEqual'
    );
    protected $_notEqual;

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public static function _(array $config = array())
    {
        return new self($config);
    }

    public function notEqual($mNotEqualValue = null)
    {
        if (func_num_args() == 0) {
            return $this->_notEqual;
        }
        $this->_notEqual = $mNotEqualValue;
        return $this;
    }

    public function isValid($mValue)
    {
        $sValue = (string) $mValue;
        $this->_val($sValue);
        if ($sValue == $this->_notEqual) {
            $this->_error(self::EQUAL);
            return false;
        }
        return true;
    }

}

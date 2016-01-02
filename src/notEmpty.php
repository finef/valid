<?php

namespace \Fine\Valid;

class f_valid_notEmpty extends ValidAbstract
{

    const STRING_EMPTY = 'STRING_EMPTY';

    protected $_msg = array(
        self::STRING_EMPTY => 'Wymagana wartość',
    );

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public static function _(array $config = array())
    {
        return new self($config);
    }

    public function isValid($mValue)
    {
        $sValue = (string) $mValue;
        $this->_val($sValue);

        if (strlen($sValue) == 0) {
            $this->_error(self::STRING_EMPTY);
            return false;
        }

        return true;
    }

}

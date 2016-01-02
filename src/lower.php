<?php

namespace \Fine\Valid;

class f_valid_lower extends ValidAbstract
{

    const STRING_EMPTY = 'STRING_EMPTY';
    const NOT_LOWER    = 'NOT_LOWER';

    protected $_msg = array(
        self::STRING_EMPTY => 'Wymagana wartość',
        self::NOT_LOWER    => 'Wymagane male znaki alfabetyczne (a-z, np. abnm)',
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

        if ('' === $sValue) {
            $this->_error(self::STRING_EMPTY);
            return false;
        }

        if (!ctype_lower($sValue)) {
            $this->_error(self::NOT_LOWER);
            return false;
        }

        return true;
    }

}

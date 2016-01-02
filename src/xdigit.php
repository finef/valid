<?php

namespace \Fine\Valid;

class Xdigit extends ValidAbstract
{

    const STRING_EMPTY = 'STRING_EMPTY';
    const NOT_XDIGIT   = 'NOT_XDIGIT';

    protected $_msg = array(
        self::STRING_EMPTY => 'Wymagana wartość',
        self::NOT_XDIGIT   => 'Wymagana wartość heksadecymalna (0-9, a-f, A-F np. 00ff00)',
    );

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public function isValid($val)
    {
        $val = $this->getVal();

        if ('' === $val) {
            return $this->_error(self::STRING_EMPTY);
        }

        if (!ctype_xdigit($val)) {
            return $this->_error(self::NOT_XDIGIT);
        }

        return true;
    }

}

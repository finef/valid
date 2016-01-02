<?php

namespace \Fine\Valid;

class Alnum extends ValidAbstract
{

    const STRING_EMPTY = 'STRING_EMPTY';
    const NOT_ALNUM    = 'NOT_ALNUM';

    protected $_msg = array(
        self::STRING_EMPTY => "Wymagana wartość",
        self::NOT_ALNUM    => "Wymagane znaki alfabetyczne lub numeryczne (a-z, A-Z, 0-9, np. qweRTY123)",
    );

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public function isValid()
    {
        $val = $this->getVal();

        if ('' === $val) {
            $this->_error(self::STRING_EMPTY);
        }

        if (!ctype_alnum($val)) {
            return $this->_error(self::NOT_ALNUM);
        }

        return true;
    }

}

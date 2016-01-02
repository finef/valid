<?php

namespace \Fine\Valid;

class Alpha extends ValidAbstract
{

    const STRING_EMPTY = 'STRING_EMPTY';
    const NOT_ALPHA    = 'NOT_ALPHA';

    protected $_msg = array(
        self::STRING_EMPTY => "Wymagana wartość",
        self::NOT_ALPHA    => "Wymagane znaki alfabetyczne (a-z, A-Z, np. qweRTY)",
    );

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public function isValid()
    {
        $val = $this->getVal();

        if ('' === $val) {
            return $this->_error(self::STRING_EMPTY);
        }

        if (!ctype_alpha($val)) {
            return $this->_error(self::NOT_ALPHA);
        }

        return true;
    }

}

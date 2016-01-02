<?php

namespace \Fine\Valid;

class f_valid_between extends ValidAbstract
{

    const NOT_BETWEEN = 'NOT_BETWEEN';

    protected $_msg = array(
        self::NOT_BETWEEN => 'Wymagana wartość pomiędzy {min} i {max}',
    );
    protected $_var = array(
        '{min}' => 'min',
        '{max}' => 'max'
    );
    protected $_min;
    protected $_max;

    public function setVal($val)
    {
        $this->setVal((string)$val);
    }

    public function setMin($min)
    {
        $this->_min = $min;
        return $this;
    }

    public function getMin()
    {
        return $this->_min;
    }

    public function setMax($max)
    {
        $this->_max = $max;
        return $this;
    }

    public function getMax()
    {
        return $this->_max;
    }

    public function isValid()
    {
        $val = $this->getVal();

        if ($this->_min > $val || $val > $this->_max) {
            return $this->_error(self::NOT_BETWEEN);
        }

        return true;
    }

}

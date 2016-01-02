<?php

namespace \Fine\Valid;

use \Fine\I18n\TranslatorInterface;

abstract class ValidAbstract implements ValidInterface
{

    protected $_val;
    protected $_msg = array();
    protected $_msgVar = array();
    protected $_msgVarVal = '{val}';
    protected $_error = array();
    protected $_translator;

    public function __construct(array $config = array())
    {
        foreach ($config as $method => $arg) {
            $this->{$method}($arg);
        }
    }

    /* val */

    public function setVal($val)
    {
        $this->_val = $val;
        $this->_error = array();
        return $this;
    }

    public function getVal()
    {
        return $this->_val;
    }

    /* message */

    public function hasMsg($key)
    {
        return array_key_exists($key, $this->_msg);
    }

    public function setMsg($key, $msg)
    {
        $this->_msg[$key] = $msg;
        return $this;
    }

    public function getMsg($key)
    {
        return $this->_msg[$key];
    }

    public function removeMsg($key)
    {
        unset($this->_msg[$key]);
    }

    public function hasMsgs(array $keys)
    {
        foreach ($keys as $key) {
            if ($this->hasMsgs($key)) {
                continue;
            }
            return false;
        }

        return true;
    }

    public function setMsgs(array $msgs)
    {
        foreach ($msgs as $key => $msg) {
            $this->setMsg($key, $msg);
        }
    }

    public function getMsgs()
    {
        return $this->_msg;
    }

    public function removeMsgs()
    {
        $this->_msg = array();
        return $this;
    }

    /* message variable */

    public function hasMsgVar($var)
    {
        return array_key_exists($var, $this->_msgVar);
    }

    public function setMsgVar($var, $method)
    {
        $this->_msgVar[$var] = $method;
        return $this;
    }

    public function getMsgVar($var)
    {
        return $this->_msgVar[$var];
    }

    public function removeMsgVar($var)
    {
        unset($this->_msgVar[$var]);
    }

    public function hasMsgVars(array $vars)
    {
        foreach ($vars as $var) {
            if ($this->isMsgVars($var)) {
                continue;
            }
            return false;
        }

        return true;
    }

    public function setMsgVars(array $msgVars)
    {
        foreach ($msgVars as $var => $method) {
            $this->setMsgVar($var, $method);
        }
    }

    public function getMsgVars()
    {
        return $this->_msgVar;
    }

    public function removeMsgVars()
    {
        $this->_msgVar = array();
        return $this;
    }

    /* message variable value */

    public function setMsgVarVal($varVal)
    {
        $this->_varMsgVal = $varVal;
        return $this;
    }

    public function getMsgVarVal()
    {
        return $this->_msgVarVal;
    }

    /* translator */

    public function setTranslator(TranslatorInterface $translator)
    {
        $this->_translator = $translator;
        return $this;
    }

    public function getTranslator()
    {
        return $this->_translator;
    }

    /* errors */

    public function addError($key, $msg = null)
    {
        $this->_error[$key] = $msg !== null ? $msg : true;
        return $this;
    }

    public function addErrorMsg($msg)
    {
        $this->_error[] = $msg;
    }

    public function hasError()
    {
        return (boolean) $this->_error;
    }

    public function errorKeys()
    {
        return array_keys($this->_error);
    }

    public function getError()
    {
        foreach ($this->_error as $key => $msg) {

            // there is a message already?
            if ($msg !== true) {
                continue;
            }

            // msg
            if (!$this->_msg[$key]) {
                throw new LogicException();
            }
            $msg = $this->_msg[$key];

            // translate
            if ($this->_translator) {
                $msg = $this->_translator->helper($msg);
            }

            // parse variable
            if ($this->_varVal !== null) {
                $msg = str_replace($this->_varVal, (string) $this->_val, $msg);
            }
            foreach ($this->_var as $var => $method) {
                $msg = str_replace($var, $this->{$method}(), $msg);
            }

            $this->_error[$key] = $msg;
        }

        return $this->_error;
    }

    /* private */

    protected function _error($key)
    {
        $this->addError($key);
        return false;
    }
}

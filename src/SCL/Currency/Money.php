<?php

namespace SCL\Currency;

class Money
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var int
     */
    private $units = 0;

    /**
     * @param int      $units
     * @param Currency $precision
     */
    public function __construct($units, Currency $currency)
    {
        if (!is_int($units)) {
            throw new \InvalidArgumentException();
        }

        $this->units    = $units;
        $this->currency = $currency;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->currency->addPrecision($this->units);
    }

    /**
     * @return bool
     */
    public function isSameCurrency(Currency $currency)
    {
        return $this->currency->getCode() === $currency->getCode();
    }
}

<?php

namespace spec\SCL\Currency;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SCL\Currency\Currency;
use SCL\Currency\Exception\NoDefaultCurrencyException;

class MoneyFactorySpec extends ObjectBehavior
{
    /*
     * createFromValue()
     */

    public function it_returns_Money_from_createFromValue()
    {
        $this->setDefaultCurrency(new Currency('XXX', 2));

        $this->createFromValue(1.00)
             ->shouldReturnAnInstanceOf('SCL\Currency\Money');
    }

    public function it_loads_uses_default_currency_to_convert_to_units_in_createFromValue(Currency $currency)
    {
        $currency->removePrecision(1.0)->shouldBeCalled()->willReturn(0);

        $this->setDefaultCurrency($currency);

        $this->createFromValue(1.00);
    }

    public function it_sets_money_units_in_createFromValue(Currency $currency)
    {
        $currency->removePrecision(Argument::any())->willReturn(500);

        $this->setDefaultCurrency($currency);

        $this->createFromValue(0)->getUnits()->shouldReturn(500);
    }

    public function it_sets_money_currency_in_createFromValue()
    {
        $currency = new Currency('XXX', 2);

        $this->setDefaultCurrency($currency);

        $this->createFromValue(0)->getCurrency()->shouldReturn($currency);
    }

    public function it_should_throw_from_createFromValue_if_default_currency_not_set()
    {
        $this->shouldThrow(new NoDefaultCurrencyException())
             ->duringCreateFromValue(0);
    }

    /*
     * createFromUnits()
     */

    public function it_returns_Money_from_createFromUnits()
    {
        $this->setDefaultCurrency(new Currency('XXX', 2));

        $this->createFromUnits(100)
             ->shouldReturnAnInstanceOf('SCL\Currency\Money');
    }

    public function it_sets_money_units_in_createFromUnits()
    {
        $this->setDefaultCurrency(new Currency('XXX', 2));

        $this->createFromUnits(100)->getUnits()->shouldReturn(100);
    }

    public function it_sets_money_currency_in_createFromUnits()
    {
        $currency = new Currency('XXX', 2);

        $this->setDefaultCurrency($currency);

        $this->createFromUnits(0)->getCurrency()->shouldReturn($currency);
    }

    public function it_should_throw_from_createFromUnits_if_default_currency_not_set()
    {
        $this->shouldThrow(new NoDefaultCurrencyException())
             ->duringCreateFromUnits(0);
    }

    /*
     * createDefaultInstance()
     */

    public function it_returns_instance_from_createDefaultInstance()
    {
        $this::createDefaultInstance()->shouldReturnAnInstanceOf('SCL\Currency\MoneyFactory');
    }
}

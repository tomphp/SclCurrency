<?php

namespace spec\SCL\Currency;

use PhpSpec\ObjectBehavior; use Prophecy\Argument;
use SCL\Currency\Exception\IncorrectPrecisionException;
use SCL\Currency\Exception\NegativePrecisionException;
use SCL\Currency\Currency;
use SCL\Currency\Money;

class MoneySpec extends ObjectBehavior
{
    private $currency;

    private $value;

    public function let()
    {
        $this->currency = new Currency('GBP');

        $this->value = 1199;

        $this->beConstructedWith($this->value, $this->currency);
    }

    public function it_returns_currency()
    {
        $this->getCurrency()->shouldReturn($this->currency);
    }

    public function it_returns_value()
    {
        $this->getValue()->shouldReturn($this->value);
    }

    public function it_throws_when_constructed_with_floating_point_value()
    {
        $this->shouldThrow(new \InvalidArgumentException())
             ->during('__construct', array(10.1, $this->currency));
    }

    public function it_returns_true_from_isSameCurrency_for_same_currencies()
    {
        $this->shouldBeSameCurrency($this->currency);
    }

    public function it_returns_false_from_isSameCurrency_for_different_currencies()
    {
        $this->shouldNotBeSameCurrency(new Currency('USD'));
    }

    /*
    public function it_initializes_with_zero_value()
    {
        $this->getValue()->shouldReturn(0.0);
    }

    public function it_set_value_via_constructor()
    {
        $this->beConstructedWith(22);

        $this->getValue()->shouldReturn(22.0);
    }

    public function it_returns_set_value()
    {
        $this->setValue(24.75);

        $this->getValue()->shouldReturn(24.75);
    }

    public function it_throws_if_doesnt_match_precision()
    {
        $this->beConstructedWith(0, 2);

        $this->shouldThrow(new IncorrectPrecisionException())
             ->duringSetValue(2.342);
    }

    public function it_works_with_other_precisions()
    {
        $this->beConstructedWith(0, 3);

        $this->setValue(1.234);

        $this->getValue()->shouldReturn(1.234);
    }

    public function it_throws_if_precision_is_negative()
    {
        $this->shouldThrow(new NegativePrecisionException())
             ->during('__construct', array(0, -1));
    }

    public function it_can_handle_amount_of_one_point_one()
    {
        // This was causing an error, I think it must have
        // been some sort of floating point error
        $this->setValue(1.1);
    }

    public function it_can_handle_amount_of_69_point_1()
    {
        $this->setValue(69.1);
    }

    public function it_converts_to_formatted_string()
    {
        $this->setValue(2.15);

        $this->__toString()->shouldReturn('2.15');
    }
    */
}
<?php
// класс товара
abstract class Product
{
    // рекомендованная цена
    protected $rsp;

    // доход с продаж
    protected static $revenue = 0;

    // метод расчета цены
    abstract public function getPrice();

    public function __construct($rsp) {
        $this->rsp = $rsp;
    }

    // метод продажи
    public function sale($qty = 1) {
        self::$revenue += $this->getPrice()*$qty;
        static::$revenue += $this->getPrice()*$qty;
    }

    // метод получения дохода с продаж
    public static function getRevenue() {
        return static::$revenue;
    }
}

class HardCopy extends Product
{
    protected static $revenue = 0;

    public function getPrice() {
        return $this->rsp;
    }
}

class DigitalCopy extends Product
{
    protected static $revenue = 0;

    public function __construct(HardCopy $hardCopy) {
        parent::__construct($hardCopy->getPrice());
    }

    public function getPrice() {
        return $this->rsp / 2;
    }
}

class ByWeight extends Product
{
    protected static $revenue = 0;
    protected $weight;

    public function __construct($rsp, $weight) {
        parent::__construct($rsp);
        $this->weight = $weight;
    }

    public function getPrice() {
        return $this->rsp * $this->weight;
    }
}

$a = new HardCopy(30); // getPrice() = 30
$b = new DigitalCopy($a); // getPrice() = 15
$c = new ByWeight(10,0.9); // getPrice() = 9
$a->sale(4);
$b->sale(5);
$c->sale(6);
echo HardCopy::getRevenue().PHP_EOL; // 120
echo DigitalCopy::getRevenue().PHP_EOL; // 75
echo ByWeight::getRevenue().PHP_EOL; // 54
echo Product::getRevenue().PHP_EOL; // 249
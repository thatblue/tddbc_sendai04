<?php
namespace Tddbc;

use Tddbc\Person;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Person
     */
    private $sato;

    /**
     * @var Person
     */
    private $suzuki;

    /**
     * @var Person
     */
    private $yamada;    

    /**
     * @var Person
     */
    private $ito;    

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->sato = new Person('佐藤', '太郎', Person::MALE);
        $this->suzuki = new Person('鈴木', '次郎', Person::MALE);
        $this->yamada = new Person('山田', '花子', Person::FEMALE);
        $this->ito = new Person('伊藤', '桜子', Person::FEMALE);
    }

    /**
     * @test
     */
    public function 佐藤太郎の名字は佐藤()
    {
        $this->assertEquals('佐藤', $this->sato->getFamilyName());
    }

    /**
     * @test
     */
    public function 佐藤太郎の名前は太郎(){
        $this->assertEquals('太郎', $this->sato->getFirstName());
    }

    /**
     * @test
     */
    public function 鈴木次郎の名字は鈴木()
    {
        $this->assertEquals('鈴木', $this->suzuki->getFamilyName());
    }

    /**
     * @test
     */
    public function 鈴木次郎の名前は次郎()
    {
        $this->assertEquals('次郎', $this->suzuki->getFirstName());        
    }

    /**
     * @test
     */
    public function 佐藤太郎のフルネームは佐藤太郎()
    {
        $this->assertEquals('佐藤太郎', $this->sato->getFullName());        
    }

    /**
     * @test
     */
    public function 鈴木次郎のフルネームは鈴木次郎()
    {
        $this->assertEquals('鈴木次郎', $this->suzuki->getFullName());        
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 名字がない場合はInvalidArgumentExceptionをスロー()
    {
        new Person('', '太郎', Person::MALE);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 名前がない場合はInvalidArgumentExceptionをスロー()
    {
        new Person('佐藤', '', Person::MALE);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function どっちもない場合はInvalidArgumentExceptionをスロー()
    {
        new Person('', '', Person::MALE);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 名字がnullの場合はInvalidArgumentExceptionをスロー()
    {
        new Person(null, '太郎', Person::MALE);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 名前がnullの場合はInvalidArgumentExceptionをスロー()
    {
        new Person('佐藤', null, Person::MALE);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 名字がstring以外の場合はInvalidArgumentExceptionをスロー()
    {
        new Person(1, '太郎', Person::MALE);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 名前がstring以外の場合はInvalidArgumentExceptionをスロー()
    {
        new Person('佐藤', $this->suzuki, Person::MALE);
    }

    /**
     * @test
     */
    public function 佐藤太郎は男性である()
    {
        $this->assertEquals(Person::MALE, $this->sato->getGender());        
    }

    /**
     * @test
     */
    public function 佐藤太郎は女性ではない()
    {
        $this->assertFalse(Person::FEMALE === $this->sato->getGender());        
    }

    /**
     * @test
     */
    public function 山田花子は女性である()
    {
        $this->assertEquals(Person::FEMALE, $this->yamada->getGender());        
    }

    /**
     * @test
     */
    public function 山田花子は男性ではない()
    {
        $this->assertFalse(Person::MALE === $this->yamada->getGender());        
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 性別がnullのときはInvalidArgumentExceptionをスロー()
    {
        new Person('佐藤', '太郎', null);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 性別がint以外のときはInvalidArgumentExceptionをスロー()
    {
        new Person('佐藤', '太郎', 'aaa');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function 性別が男性でも女性でもないときはInvalidArgumentExceptionをスロー()
    {
        new Person('佐藤', '太郎', 3);
    }

    /**
     * @test
     */
    public function 佐藤太郎と山田花子が結婚できる()
    {
        $this->assertTrue($this->sato->isMarriageable($this->yamada));        
    }

    /**
     * @test
     */
    public function 山田花子と佐藤太郎が結婚できる()
    {
        $this->assertTrue($this->yamada->isMarriageable($this->sato));        
    }

    /**
     * @test
     */
    public function 佐藤太郎と鈴木次郎が結婚できない()
    {
        $this->assertFalse($this->sato->isMarriageable($this->suzuki));        
    }

    /**
     * @test
     */
    public function 山田花子と伊藤桜子が結婚できない()
    {
        $this->assertFalse($this->yamada->isMarriageable($this->ito));        
    }

    /**
     * @test
     */
    public function 山田花子は自分と結婚できない()
    {
        $this->assertFalse($this->yamada->isMarriageable($this->yamada));        
    }
}

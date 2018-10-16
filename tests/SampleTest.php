<?php

class SampleTest extends \PHPUnit\Framework\TestCase{

    protected $Database;
    
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    public function setUp(){
        $this->Database = new App\model\DB;
    }

    protected function tearDown() { }
    /** @test **/

    public function check_if_result_not_empty_brands(){
        $this->assertNotEmpty($this->Database->getBrands());
    }

     /** @test **/

    public function count_for_brand(){
        $this->Database->getBrands();
        $this->assertEquals(2,$this->Database->getBrandCount());
    }

     /** @test **/

     public function count_models_on_brand(){
        $this->Database->getModelsByBrand(2);
        $this->assertEquals(2,$this->Database->getModelCount());
     }

      /** @test **/
      public function check_brand_name_equals(){
          $model = $this->Database->getModelsByBrand(2);
          $this->assertEquals($model[0]['modelName'],'ILX');
          $this->assertEquals($model[1]['modelName'],'MDX');
      }
}
<?php
class Elite_Vaftire_Model_FlexibleSearchTests_SectionWidthTest extends Elite_Vaf_TestCase
{
    function testShouldGetFromRequest()
    {
        $flexibleSearch = $this->flexibleTireSearch(array('section_width'=>'205', 'aspect_ratio'=>'55', 'diameter'=>'16'));
        $this->assertEquals( 205, $flexibleSearch->sectionWidth(), 'should get section width from request' );
    }
    
    function testShouldStoreInSession()
    {
        $flexibleSearch = $this->flexibleTireSearch(array('section_width'=>'205', 'aspect_ratio'=>'55', 'diameter'=>'16'));
        Elite_Vaf_Helper_Data::getInstance()->storeFitInSession();
        $this->assertEquals( 205, $this->flexibleTireSearch()->sectionWidth(), 'should store section width in session' );
    }
    
    function testShouldClearFromSession()
    {
        $flexibleSearch = $this->flexibleTireSearch(array('section_width'=>'205', 'aspect_ratio'=>'55', 'diameter'=>'16'));
        Elite_Vaf_Helper_Data::getInstance()->storeFitInSession();
        
        $flexibleSearch = $this->flexibleTireSearch(array('section_width'=>'0', 'aspect_ratio'=>'0', 'diameter'=>'0'));
        Elite_Vaf_Helper_Data::getInstance()->storeFitInSession();
        
        $this->assertNull( $this->flexibleTireSearch()->sectionWidth(), 'should clear section width from session' );
    }
}
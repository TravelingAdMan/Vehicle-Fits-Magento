<?php
class Elite_Vaf_Model_Level_FinderTests_MergeTest extends Elite_Vaf_TestCase
{
    function doSetUp()
    {
        $this->switchSchema('make,model,year');
    }
    
    // @todo what about a way to merge a make with a model, or year (by traversing the level closest to the root level, and "blowing out" all applicable vehicles).
    
    function testShouldMergeYear()
    {
        $vehicle1 = $this->createMMY('Honda','Civic','2000');
        $vehicle2 = $this->createMMY('Honda','Civic','2001');
        
        $slaveLevels = array(
            array('year', $vehicle1 ),
            array('year', $vehicle2 ),
        );
        $masterLevel = array('year', $vehicle2 );
        
        $this->levelFinder()->merge( $slaveLevels, $masterLevel );
        
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Civic','year'=>2001)) );
        $this->assertFalse( $this->vehicleExists(array('make'=>'Honda','model'=>'Civic','year'=>2000)) );
    }
    
    function testShouldMergeModel()
    {
        $vehicle1 = $this->createMMY('Honda','Civic','2000');
        $vehicle2 = $this->createMMY('Honda','Accord','2001');
        
        $slaveLevels = array(
            array('model', $vehicle1 ),
            array('model', $vehicle2 ),
        );
        $masterLevel = array('model', $vehicle2 );
        $this->levelFinder()->merge( $slaveLevels, $masterLevel );
        
        $this->assertFalse( $this->vehicleExists(array('make'=>'Honda','model'=>'Civic')) );
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Accord')) );
    }
    
    
    function testShouldMergeYears_WhenMergeModel()
    {
        $vehicle1 = $this->createMMY('Honda','Civic','2000');
        $vehicle2 = $this->createMMY('Honda','Accord','2001');
        $vehicle3 = $this->createMMY('Honda','Civic','2002');
        
        $slaveLevels = array(
            array('model', $vehicle1 ),
            array('model', $vehicle2 ),
        );
        $masterLevel = array('model', $vehicle2 );
        $this->levelFinder()->merge( $slaveLevels, $masterLevel );
        
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Accord','year'=>2000)) );
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Accord','year'=>2001)) );
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Accord','year'=>2002)) );
        
        $this->assertFalse( $this->vehicleExists(array('make'=>'Honda','model'=>'Civic')) );
    }
    
    
    function testShouldMergeModels_WhenMergeMakes()
    {
        $vehicle1 = $this->createMMY('Honda','Civic','2000');
        $vehicle2 = $this->createMMY('Honda-oops','Civic','2000');
        $vehicle3 = $this->createMMY('Honda-oops','Civic','2001');
        
        $slaveLevels = array(
            array('make', $vehicle1 ),
            array('make', $vehicle2 ),
        );
        $masterLevel = array('make', $vehicle1 );
        $this->levelFinder()->merge( $slaveLevels, $masterLevel );
        
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Civic','year'=>2000)) );        
        $this->assertTrue( $this->vehicleExists(array('make'=>'Honda','model'=>'Civic','year'=>2001)) );        
        $this->assertFalse( $this->vehicleExists(array('make'=>'Honda-oops')) );
    }
    
    function testShouldMergeProductApplications()
    {
        return $this->markTestIncomplete();
    }
    
    function testShouldClearVehicleFinderIdentityMap()
    {
        return $this->markTestIncomplete();
    }
    
    function testShouldClearLevelFinderIdentityMap()
    {
        return $this->markTestIncomplete();
    }
    
}
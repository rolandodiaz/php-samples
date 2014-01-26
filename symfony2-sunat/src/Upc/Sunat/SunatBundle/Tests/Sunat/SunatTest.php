<?php

namespace Upc\Sunat\SunatBundle\Tests\Sunat;
use Upc\Sunat\SunatBundle\Entity\Concept;

class SunatTest extends \PHPUnit_Framework_TestCase
{
    public function testCrud()
    {
        // Last, mock the EntityManager to return the mock of the repository
        $em = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();
        $concept1 = new Concept();
        $concept1->setName('tributo 1');
        $em->persist($concept1);
        $em->flush();        
        $this->assertEquals('tributo 1', $concept1->getName());
        
    }
}

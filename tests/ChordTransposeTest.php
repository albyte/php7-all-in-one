<?php

require __DIR__ . '/../src/ChordTranspose.php';

/**
 * Class ChordTransposeTest
 */
class ChordTransposeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $src
     * @param $distance
     * @param $expected
     * @dataProvider dpTranspose
     */
    public function testTranspose($src, $distance, $expected)
    {
        $method = new \ReflectionMethod(ChordTranspose::class, 'transpose');
        $method->setAccessible(true);
        $module = new ChordTranspose();
        $actual = $method->invoke($module, $src, $distance);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dpTranspose()
    {
        return [
            'C + 2 = D' => ['C', 2, 'D'],
            'D + 3 = F' => ['D', 3, 'F'],
            'A + 4 = Db' => ['A', 4, 'Db'],
            'D# + 5 = G#' => ['D#', 5, 'G#'],
            'D - 3 = C!?' => ['D', -3, 'C'],
            'Db +14 = Eb' => ['Db', 14, 'Eb'],
        ];
    }

    /**
     * @param $src
     * @param $dst
     * @param $expected
     * @dataProvider dpCalcDistance
     */
    public function testCalcDistance($src, $dst, $expected)
    {
        $method = new \ReflectionMethod(ChordTranspose::class, 'calcDistance');
        $method->setAccessible(true);
        $module = new ChordTranspose();
        $actual = $method->invoke($module, $src, $dst);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dpCalcDistance()
    {
        return [
            'C -> Eb = 3' => ['C', 'Eb', 3],
            'Eb -> Bb = 7' => ['Eb', 'Bb', 7],
            'Bb -> Db = -9' => ['Bb', 'Db', -9],
        ];
    }
}
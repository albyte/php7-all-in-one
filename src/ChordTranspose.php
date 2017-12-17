<?php

/**
 * Class ChordTranspose
 */
class ChordTranspose
{
    private $src_key = 'C';
    private $dst_key = 'C';
    private $distance = 0;
    const CHORDS = ['C', 'Db', 'D', 'Eb', 'E', 'F', 'Gb', 'G', 'Ab', 'A', 'Bb', 'B'];
    const CHORD_LENGTH = 12;
    const CHORDS_ALIAS = [
        'C#' => 'Db',
        'D#' => 'Eb',
        'F#' => 'Gb',
        'G#' => 'Ab',
        'A#' => 'Bb',
        'Db' => 'C#',
        'Eb' => 'D#',
        'Gb' => 'F#',
        'Ab' => 'G#',
        'Bb' => 'A#',
    ];
    const CHORD_REG = '/([A-G][#b]?)/';
    const KEY_REG = '/^([A-G][b#]?)m$/';

    /**
     * @param string $src_key
     * @param string $dst_key
     * @return self
     * @throws \Exception
     */
    public function setDistance($src_key, $dst_key)
    {
        $this->src_key = $this->changeMajor($src_key);
        $this->dst_key = $this->changeMajor($dst_key);

        $this->distance = $this->calcDistance($this->src_key, $this->dst_key);
        return $this;
    }

    /**
     * @param string $text
     * @return string
     */
    public function transposeChordText($text)
    {
        return ($this->distance === 0 || empty($text))
            ? $text
            : preg_replace_callback(self::CHORD_REG, [$this, 'transposeCallback'], $text);
    }

    /**
     * @param $key
     * @return mixed
     */
    private function changeMajor($key)
    {
        return (preg_match(self::CHORD_REG, $key, $matches))
            ? $this->transpose($matches[1], -3)
            : $key;
    }

    /**
     * @param $matches
     * @return mixed
     */
    private function transposeCallback($matches)
    {
        return $this->transpose($matches[1], $this->distance);
    }

    /**
     * @param $src
     * @param $distance
     * @return mixed
     */
    private function transpose($src, $distance)
    {
        $is_sharp = false;
        if (strpos($src, '#') > 0) {
            $src = self::CHORDS_ALIAS[$src];
            $is_sharp = true;
        }
        $src_pos = array_search($src, self::CHORDS);
        $src_pos += $distance;
        $src_pos = $src_pos % self::CHORD_LENGTH;
        $dst = self::CHORDS[$src_pos < 0 ? self::CHORD_LENGTH + $src_pos : $src_pos];
        return ($is_sharp && strpos($dst, 'b')) ? self::CHORDS_ALIAS[$dst] : $dst;
    }

    /**
     * @param $src
     * @param $dst
     * @throws \Exception
     * @return int;
     */
    private function calcDistance($src, $dst)
    {
        $src_pos = array_search($src, self::CHORDS);
        $dst_pos = array_search($dst, self::CHORDS);
        if ($src_pos === false || $dst_pos === false) {
            throw new \Exception("'ranges' not exist in chords.$src, $dst");
        }
        return ($dst_pos - $src_pos);
    }
}
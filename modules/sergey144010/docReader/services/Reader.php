<?php

namespace app\modules\sergey144010\docReader\services;

use yii\helpers\Url;

class Reader
{
    private $parsedown;
    private $docPath;
    private $string;


    public function __construct($docPath)
    {
        $this->parsedown = new \Parsedown();
        $this->docPath = $docPath;
    }

    public function parse($fileName)
    {
        $stringFile = file_get_contents($this->docPath.DIRECTORY_SEPARATOR.$fileName);
        $this->string = $this->parsedown->text($stringFile);
        return $this;
    }

    public function getString()
    {
        return $this->string;
    }

    public function normalize()
    {
        #preg_match_all('#<li><a href=\"[^./]*\.md\">#i', $this->string, $matches);
        preg_match_all('#<a href=\"[^./]*\.md\">#i', $this->string, $matches);

        /**
         * Method № 1
         *
         * Time ~80ms
         * Memory 4,996
         */
        /*
        foreach ($matches[0] as $match) {
            $name = substr($match, 13, -2);
            $newMatch = '<li><a href="'.Url::to(['doc/index', 'file'=>$name]).'">';
            $pattern = '%'.$match.'%i';
            $stringParsedown = preg_replace($pattern, $newMatch, $stringParsedown);
        };
        */

        /**
         * Method № 2
         *
         * Time ~80ms
         * Memory 4,992
         */
        #/*
        $newMatch = $matches[0];
        $pattern = $matches[0];
        $patterns = array_map($this->patternCallback(), $pattern);
        $newMatches = array_map($this->matchCallback(), $newMatch);
        $this->string = preg_replace($patterns, $newMatches, $this->string);
        #*/

        /**
         * Method № 3
         *
         * Time ~80ms
         * Memory 4,994
         */
        /*
        $newMatch = $matches[0];
        $pattern = $matches[0];
        $patterns = array_map(function ($string){
            return '%'.$string.'%i';
            }, $pattern);
        $newMatches = array_map(function ($match){
            $name = substr($match, 13, -2);
            return '<li><a href="'.Url::to(['doc/index', 'file'=>$name]).'">';
        }, $newMatch);
        $stringParsedown = preg_replace($patterns, $newMatches, $stringParsedown);
        */
    }

    private function patternCallback()
    {
        return function ($string){
            return '%'.$string.'%i';
        };
    }

    private function matchCallback()
    {
        return function ($match){
            #$name = substr($match, 13, -2);
            #return '<li><a href="'.Url::to(['doc/index', 'file'=>$name]).'">';
            $name = substr($match, 9, -2);
            return '<a href="'.Url::to(['doc/index', 'file'=>$name]).'">';
        };
    }
}
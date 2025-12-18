<?php

namespace DMT\Address\Abbreviation;

use DMT\Address\Abbreviation\Dutch\Designation\AdditionAbbreviator;
use DMT\Address\Abbreviation\Dutch\Designation\BAGStandardAbbreviator;
use DMT\Address\Abbreviation\Dutch\Designation\SeparatorAbbreviator;
use DMT\Address\Abbreviation\Dutch\Designation\TermAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\AdjectiveAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\DirectionalIndicationAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\NumeralAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\PrepositionAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesOfNobilityAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\ToSingleLetterAbbreviationGroupAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TypeNameAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesAbbreviator;
use DMT\Address\Abbreviation\General\AbbreviationGroupAbbreviator;
use DMT\Address\Abbreviation\General\PunctuationAbbreviator;

class AbbreviationGroupFactory
{
    /**
     * Abbreviate a street using the NEN 5825:2002 standard.
     */
    public function getNen5825AbbreviationGroup(): AbbreviatorInterface
    {
        $punctuationAbbreviation = new PunctuationAbbreviator();
        $titleAbbreviation = new TitlesAbbreviator();
        $numeralAbbreviation = new NumeralAbbreviator();
        $directionAbbreviation = new DirectionalIndicationAbbreviator();
        $typeNameAbbreviation = new TypeNameAbbreviator();
        $adjectiveAbbreviation = new AdjectiveAbbreviator();
        $prepositionAbbreviation = new PrepositionAbbreviator();
        $prepositionInsideAbbreviation = new PrepositionAbbreviator(matchInsideOnly: true);
        $titleOfNobilityAbbreviation = new TitlesOfNobilityAbbreviator();

        return new AbbreviationGroupAbbreviator([
            // Standard abbreviation (rule 1)
            new AbbreviationGroupAbbreviator([$punctuationAbbreviation], cumulative: true),
            // Neutral abbreviations (rule 2 - 7)
            new AbbreviationGroupAbbreviator([
                $titleAbbreviation,
                $numeralAbbreviation,
                $directionAbbreviation,
                $typeNameAbbreviation,
                $adjectiveAbbreviation,
                $prepositionAbbreviation,
                new AbbreviationGroupAbbreviator([
                    $titleAbbreviation,
                    $numeralAbbreviation,
                    $directionAbbreviation,
                    $typeNameAbbreviation,
                    $adjectiveAbbreviation,
                    $prepositionAbbreviation,
                ], cumulative: true)
            ]),
            // Connotative abbreviations (rule 8 - 10)
            new AbbreviationGroupAbbreviator([
                $titleOfNobilityAbbreviation,
                $prepositionInsideAbbreviation,
                new AbbreviationGroupAbbreviator([
                    $titleAbbreviation,
                    $numeralAbbreviation,
                    $directionAbbreviation,
                    $typeNameAbbreviation,
                    $adjectiveAbbreviation,
                    $prepositionAbbreviation,
                    $titleOfNobilityAbbreviation,
                    $prepositionInsideAbbreviation
                ], cumulative: true),
            ]),
            // Extra abbreviations (rule 11)
            new ToSingleLetterAbbreviationGroupAbbreviator([
                $titleAbbreviation,
                $numeralAbbreviation,
                $directionAbbreviation,
                $typeNameAbbreviation,
                $adjectiveAbbreviation,
                $prepositionAbbreviation,
                $titleOfNobilityAbbreviation,
                $prepositionInsideAbbreviation,
            ]),
        ], cumulative: true);
    }

    public function getDesignationBAGStandardAbbreviationGroup(): AbbreviatorInterface
    {
        return new AbbreviationGroupAbbreviator([
            new SeparatorAbbreviator(),
            new TermAbbreviator(),
            new AdditionAbbreviator(),
            new BAGStandardAbbreviator()
        ], maxLength: 1, cumulative: true);
    }
}

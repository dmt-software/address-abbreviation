<?php

namespace DMT\Address\Abbreviation;

use DMT\Address\Abbreviation\Dutch\Street\AdjectiveAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\DirectionalIndicationAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\NumeralAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\PrepositionAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\TitlesOfNobilityAbbreviation;
use DMT\Address\Abbreviation\Dutch\Street\TypeNameAbbreviator;
use DMT\Address\Abbreviation\Dutch\Street\TitlesAbbreviation;
use DMT\Address\Abbreviation\General\AbbreviatorGroupAbbreviator;
use DMT\Address\Abbreviation\General\PunctuationAbbreviator;

class AbbreviationStrategyFactory
{
    /**
     * Abbreviate a street using the NEN 5825:2002 standard.
     */
    public function getNen5825Strategy(): AbbreviatorInterface
    {
        $punctuationAbbreviation = new PunctuationAbbreviator();
        $titleAbbreviation = new TitlesAbbreviation();
        $numeralAbbreviation = new NumeralAbbreviation();
        $directionAbbreviation = new DirectionalIndicationAbbreviation();
        $typeNameAbbreviation = new TypeNameAbbreviator();
        $adjectiveAbbreviation = new AdjectiveAbbreviation();
        $prepositionAbbreviation = new PrepositionAbbreviation();
        $prepositionInsideAbbreviation = new PrepositionAbbreviation(matchInside: true);
        $titleOfNobilityAbbreviation = new TitlesOfNobilityAbbreviation();

        $neutralGroupAbbreviators = [
            $titleAbbreviation,
            $numeralAbbreviation,
            $directionAbbreviation,
            $typeNameAbbreviation,
            $adjectiveAbbreviation,
            $prepositionAbbreviation,
        ];

        $group = new AbbreviatorGroupAbbreviator([
            // Standard abbreviation (rule 1)
            new AbbreviatorGroupAbbreviator([$punctuationAbbreviation], cumulative: true),
            // Neutral abbreviations (rule 2 - 7)
            new AbbreviatorGroupAbbreviator(
                $neutralGroupAbbreviators + [
                    new AbbreviatorGroupAbbreviator($neutralGroupAbbreviators, cumulative: true)
                ]
            ),
            // Connotative abbreviations (rule 8 - 10)
            new AbbreviatorGroupAbbreviator([
                $titleOfNobilityAbbreviation,
                $prepositionInsideAbbreviation,
                new AbbreviatorGroupAbbreviator(
                    $neutralGroupAbbreviators + [$titleOfNobilityAbbreviation, $prepositionAbbreviation],
                    cumulative: true
                ),
            ]),
            // Extra abbreviations (rule 11)
            new AbbreviatorGroupAbbreviator([

            ])
        ]);
    }
}

<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation;

use DMT\Address\Abbreviation\Belgian\Designation as BelgianDesignation;
use DMT\Address\Abbreviation\Belgian\Street as BelgianStreet;
use DMT\Address\Abbreviation\Dutch\Designation as DutchDesignation;
use DMT\Address\Abbreviation\Dutch\Street as DutchStreet;
use DMT\Address\Abbreviation\General\AbbreviationGroupAbbreviator;
use DMT\Address\Abbreviation\General\PunctuationAbbreviator;

class AbbreviationGroupFactory
{
    /**
     * Abbreviate Belgian street names.
     */
    public function getBelgiumStreetAbbreviationGroup(int $maxLength): AbbreviatorInterface
    {
        return new AbbreviationGroupAbbreviator([
            new BelgianStreet\TitlesAbbreviator(),
            new BelgianStreet\TypeNameAbbreviator()
        ], maxLength: $maxLength, cumulative: true);
    }

    /**
     * Abbreviate Dutch street names.
     */
    public function getDutchStreetAbbreviationGroup(int $maxLength): AbbreviatorInterface
    {
        $punctuationAbbreviation = new PunctuationAbbreviator();
        $titleAbbreviation = new DutchStreet\TitlesAbbreviator();
        $numeralAbbreviation = new DutchStreet\NumeralAbbreviator();
        $directionAbbreviation = new DutchStreet\DirectionalIndicationAbbreviator();
        $typeNameAbbreviation = new DutchStreet\TypeNameAbbreviator();
        $adjectiveAbbreviation = new DutchStreet\AdjectiveAbbreviator();
        $prepositionAbbreviation = new DutchStreet\PrepositionAbbreviator();

        return new AbbreviationGroupAbbreviator([
            new AbbreviationGroupAbbreviator([$punctuationAbbreviation], maxLength: $maxLength, cumulative: true),
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
                ], maxLength: $maxLength, cumulative: true)
            ], maxLength: $maxLength),
        ], maxLength: $maxLength);
    }

    /**
     * Abbreviate a street using the NEN 5825:2002 standard.
     */
    public function getNen5825AbbreviationGroup(): AbbreviatorInterface
    {
        $punctuationAbbreviation = new PunctuationAbbreviator();
        $titleAbbreviation = new DutchStreet\TitlesAbbreviator();
        $numeralAbbreviation = new DutchStreet\NumeralAbbreviator();
        $directionAbbreviation = new DutchStreet\DirectionalIndicationAbbreviator();
        $typeNameAbbreviation = new DutchStreet\TypeNameAbbreviator();
        $adjectiveAbbreviation = new DutchStreet\AdjectiveAbbreviator();
        $prepositionAbbreviation = new DutchStreet\PrepositionAbbreviator();
        $prepositionInsideAbbreviation = new DutchStreet\PrepositionAbbreviator(matchInsideOnly: true);
        $titleOfNobilityAbbreviation = new DutchStreet\TitlesOfNobilityAbbreviator();

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
            new DutchStreet\ToSingleLetterAbbreviationGroupAbbreviator([
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

    /**
     * Abbreviate Belgian designations.
     */
    public function getBelgianDesignationAbbreviationGroup(): AbbreviatorInterface
    {
        return new AbbreviationGroupAbbreviator([
            new BelgianDesignation\InvalidCharactersAbbreviator(),
            new BelgianDesignation\AdditionAbbreviator(),
            new BelgianDesignation\BoxAbbreviator(),
            new BelgianDesignation\RemoveRemarkAbbreviator(),
        ], maxLength: 1, cumulative: true);
    }

    /**
     * Abbreviate Dutch designations.
     */
    public function getDutchDesignationAbbreviationGroup(): AbbreviatorInterface
    {
        return $this->getDesignationBAGStandardAbbreviationGroup();
    }

    /**
     * Abbreviate a designation using the BAG Standard.
     */
    public function getDesignationBAGStandardAbbreviationGroup(): AbbreviatorInterface
    {
        return new AbbreviationGroupAbbreviator([
            new DutchDesignation\SeparatorAbbreviator(),
            new DutchDesignation\TermAbbreviator(),
            new DutchDesignation\RomanNumeralAbbreviator(),
            new DutchDesignation\AdditionAbbreviator(),
            new DutchDesignation\BAGStandardAbbreviator()
        ], maxLength: 1, cumulative: true);
    }
}

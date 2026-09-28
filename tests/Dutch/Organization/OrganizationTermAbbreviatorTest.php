<?php

declare(strict_types=1);

namespace DMT\Test\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\Dutch\Organization\OrganizationTermAbbreviator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Tests abbreviation of generic Dutch organization terms.
 */
#[CoversClass(OrganizationTermAbbreviator::class)]
final class OrganizationTermAbbreviatorTest extends TestCase
{
    #[DataProvider('provideOrganizationTerms')]
    public function testAbbreviatesOrganizationTerms(string $phrase, string $expected): void
    {
        $abbreviator = new OrganizationTermAbbreviator();

        $this->assertSame($expected, $abbreviator->abbreviate($phrase));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideOrganizationTerms(): iterable
    {
        return [
            'administratie' => [
                'administratie Noord',
                'adm Noord',
            ],
            'Administratie' => [
                'Administratie Noord',
                'Adm Noord',
            ],
            'afdeling' => [
                'afdeling Vergunningen',
                'afd Vergunningen',
            ],
            'Afdeling' => [
                'Afdeling Vergunningen',
                'Afd Vergunningen',
            ],
            'bedrijf' => [
                'bedrijf Jansen',
                'bedr Jansen',
            ],
            'Bedrijf' => [
                'Bedrijf Jansen',
                'Bedr Jansen',
            ],
            'bureau' => [
                'bureau Onderzoek',
                'bur Onderzoek',
            ],
            'Bureau' => [
                'Bureau Onderzoek',
                'Bur Onderzoek',
            ],
            'centrum' => [
                'centrum Jeugd en Gezin',
                'ctr Jeugd en Gezin',
            ],
            'Centrum' => [
                'Centrum Jeugd en Gezin',
                'Ctr Jeugd en Gezin',
            ],
            'dienst' => [
                'dienst Belastingen',
                'dnst Belastingen',
            ],
            'Dienst' => [
                'Dienst Belastingen',
                'Dnst Belastingen',
            ],
            'directie' => [
                'directie Onderwijs',
                'dir Onderwijs',
            ],
            'Directie' => [
                'Directie Onderwijs',
                'Dir Onderwijs',
            ],
            'divisie' => [
                'divisie Vastgoed',
                'div Vastgoed',
            ],
            'Divisie' => [
                'Divisie Vastgoed',
                'Div Vastgoed',
            ],
            'filiaal' => [
                'filiaal Haarlem',
                'fil Haarlem',
            ],
            'Filiaal' => [
                'Filiaal Haarlem',
                'Fil Haarlem',
            ],
            'groep' => [
                'zorg groep Nederland',
                'zorg grp Nederland',
            ],
            'Groep' => [
                'Zorg Groep Nederland',
                'Zorg Grp Nederland',
            ],
            'instelling' => [
                'instelling voor Zorg',
                'inst voor Zorg',
            ],
            'Instelling' => [
                'Instelling voor Zorg',
                'Inst voor Zorg',
            ],
            'instituut' => [
                'instituut voor Onderzoek',
                'inst voor Onderzoek',
            ],
            'Instituut' => [
                'Instituut voor Onderzoek',
                'Inst voor Onderzoek',
            ],
            'kantoor' => [
                'kantoor Amsterdam',
                'knt Amsterdam',
            ],
            'Kantoor' => [
                'Kantoor Amsterdam',
                'Knt Amsterdam',
            ],
            'locatie' => [
                'locatie Hoofddorp',
                'loc Hoofddorp',
            ],
            'Locatie' => [
                'Locatie Hoofddorp',
                'Loc Hoofddorp',
            ],
            'maatschappij' => [
                'maatschappij voor Dienstverlening',
                'mij voor Dienstverlening',
            ],
            'Maatschappij' => [
                'Maatschappij voor Dienstverlening',
                'Mij voor Dienstverlening',
            ],
            'onderneming' => [
                'onderneming Jansen',
                'ond Jansen',
            ],
            'Onderneming' => [
                'Onderneming Jansen',
                'Ond Jansen',
            ],
            'organisatie' => [
                'organisatie voor Onderwijs',
                'org voor Onderwijs',
            ],
            'Organisatie' => [
                'Organisatie voor Onderwijs',
                'Org voor Onderwijs',
            ],

            'secretariaat' => [
                'secretariaat Bestuur',
                'secr Bestuur',
            ],
            'Secretariaat' => [
                'Secretariaat Bestuur',
                'Secr Bestuur',
            ],
            'sector' => [
                'sector Publieke Dienstverlening',
                'sect Publieke Dienstverlening',
            ],
            'Sector' => [
                'Sector Publieke Dienstverlening',
                'Sect Publieke Dienstverlening',
            ],
            'vestiging' => [
                'vestiging Zuid',
                'vest Zuid',
            ],
            'Vestiging' => [
                'Vestiging Zuid',
                'Vest Zuid',
            ],
            'multiple terms preserve casing' => [
                'Afdeling administratie Kantoor Amsterdam',
                'Afd adm Knt Amsterdam',
            ],
            'case insensitive uppercase word' => [
                'AFDELING Vergunningen',
                'Afd Vergunningen',
            ],
            'does not abbreviate inside word' => [
                'Bedrijfsvereniging Nederland',
                'Bedrijfsvereniging Nederland',
            ],
            'does not abbreviate partial word' => [
                'Hoofdkantoor Amsterdam',
                'Hoofdkantoor Amsterdam',
            ],
        ];
    }

    #[DataProvider('provideAbbreviatedOrganizationTerms')]
    public function testDetectsAbbreviatedOrganizationTerms(string $word): void
    {
        $abbreviator = new OrganizationTermAbbreviator();

        $this->assertTrue($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideAbbreviatedOrganizationTerms(): iterable
    {
        return [
            'adm' => ['adm'],
            'Afd' => ['Afd'],
            'bedr' => ['bedr'],
            'Bur' => ['Bur'],
            'ctr' => ['ctr'],
            'Dnst' => ['Dnst'],
            'dir' => ['dir'],
            'Div' => ['Div'],
            'Fil' => ['Fil'],
            'grp' => ['grp'],
            'Inst' => ['Inst'],
            'Knt' => ['Knt'],
            'loc' => ['loc'],
            'Mij' => ['Mij'],
            'ond' => ['ond'],
            'Org' => ['Org'],
            'secr' => ['secr'],
            'Sect' => ['Sect'],
            'Vest' => ['Vest'],
        ];
    }

    #[DataProvider('provideUnabbreviatedOrganizationTerms')]
    public function testDoesNotDetectUnabbreviatedOrganizationTerms(string $word): void
    {
        $abbreviator = new OrganizationTermAbbreviator();

        $this->assertFalse($abbreviator->isAbbreviated($word));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnabbreviatedOrganizationTerms(): iterable
    {
        return [
            'administratie' => ['administratie'],
            'afdeling' => ['afdeling'],
            'bedrijf' => ['bedrijf'],
            'kantoor' => ['kantoor'],
            'organisatie' => ['organisatie'],
            'empty string' => [''],
        ];
    }
}

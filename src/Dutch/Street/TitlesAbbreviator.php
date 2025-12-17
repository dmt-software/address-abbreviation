<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

final class TitlesAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~^([^ ]+ )?(lt|luitenant)(-| )generaal ~i' => '$1Lt$3Gen ',
        '~^([^ ]+ )?schout bij nacht ~i' => '$1Sbn ',
        '~^([^ ]+ )?aalmoezenier ~i' => '$1Aalm ',
        '~^([^ ]+ )?luitenant ~i' => '$1Luit ',
        '~^([^ ]+ )?aartsbisschop ~i' => '$1Aartsbiss ',
        '~^([^ ]+ )?madame ~i' => '$1Mad ',
        '~^([^ ]+ )?admiraal ~i' => '$1Adm ',
        '~^([^ ]+ )?majoor ~i' => '$1Maj ',
        '~^([^ ]+ )?bisschop ~i' => '$1Biss ',
        '~^([^ ]+ )?meester ~i' => '$1Mr ',
        '~^([^ ]+ )?burgemeester ~i' => '$1Burg ',
        '~^([^ ]+ )?mejuffrouw ~i' => '$1Mej ',
        '~^([^ ]+ )?commissaris ~i' => '$1Comm ',
        '~^([^ ]+ )?mevrouw ~i' => '$1Mw ',
        '~^([^ ]+ )?deken ~i' => '$1Dkn ',
        '~^([^ ]+ )?minister ~i' => '$1Min ',
        '~^([^ ]+ )?directeur ~i' => '$1Dir ',
        '~^([^ ]+ )?monseigneur ~i' => '$1Mgr ',
        '~^([^ ]+ )?doctor ~i' => '$1Dr ',
        '~^([^ ]+ )?notaris ~i' => '$1Not ',
        '~^([^ ]+ )?doctorandus ~i' => '$1Drs ',
        '~^([^ ]+ )?overste ~i' => '$1Ov ',
        '~^([^ ]+ )?dokter ~i' => '$1Dr ',
        '~^([^ ]+ )?pastoor ~i' => '$1Past ',
        '~^([^ ]+ )?dominee ~i' => '$1Ds ',
        '~^([^ ]+ )?pastor ~i' => '$1Past ',
        '~^([^ ]+ )?fraters? ~i' => '$1Fr ',
        '~^([^ ]+ )?paters? ~i' => '$1Ptr ',
        '~^([^ ]+ )?gebroeders ~i' => '$1Gebr ',
        '~^([^ ]+ )?prelaat ~i' => '$1Prlt ',
        '~^([^ ]+ )?generaal ~i' => '$1Gen ',
        '~^([^ ]+ )?president ~i' => '$1Pres ',
        '~^([^ ]+ )?goeverneur ~i' => '$1Goev ',
        '~^([^ ]+ )?professor ~i' => '$1Prof ',
        '~^([^ ]+ )?gouverneur ~i' => '$1Gouv ',
        '~^([^ ]+ )?rector ~i' => '$1Rect ',
        '~^([^ ]+ )?heer ~i' => '$1Hr ',
        '~^([^ ]+ )?rentmeester ~i' => '$1Rentmr ',
        '~^([^ ]+ )?ingenieur ~i' => '$1Ir ',
        '~^([^ ]+ )?schepen ~i' => '$1Sch ',
        '~^([^ ]+ )?juffrouw ~i' => '$1Juffr ',
        '~^([^ ]+ )?schout ~i' => '$1Sch ',
        '~^([^ ]+ )?kanunnik ~i' => '$1Kan ',
        '~^([^ ]+ )?kapelaan ~i' => '$1Kap ',
        '~^([^ ]+ )?secretaris ~i' => '$1Secr ',
        '~^([^ ]+ )?kapitein ~i' => '$1Kapt ',
        '~^([^ ]+ )?sint ~i' => '$1St ',
        '~^([^ ]+ )?kardinaal ~i' => '$1Kard ',
        '~^([^ ]+ )?veldmaarschalk ~i' => '$1Veldm ',
        '~^([^ ]+ )?kolonel ~i' => '$1Kol ',
        '~^([^ ]+ )?vicaris ~i' => '$1Vic ',
        '~^([^ ]+ )?wethouder ~i' => '$1Weth ',
        '~^([^ ]+ )?zuster ~i' => '$1Z ',
    ];

    private array $lookup;
    private array $replace;

    public function __construct()
    {
        $this->lookup = array_keys(self::REPLACEMENTS);
        $this->replace = array_values(self::REPLACEMENTS);
    }

    /**
     * {@inheritDoc}
     *
     * Abbreviate the first two titles according to the replacements above.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace($this->lookup, $this->replace, $phrase);
    }

    /**
     * @inheritDoc
     */
    public function isAbbreviated(string $word): bool
    {
        if ($word === 'Lt-Gen') {
            return true;
        }

        return in_array($word, array_map(fn ($val) => trim($val, '1$ '), $this->replace));
    }
}
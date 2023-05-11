<?php

namespace App\Models\Helpers;

use App\Models\Character;

class CharacterFiller
{
    public static function fillExistingCharacterWithMassAssignmentArray(Character $character, array $values): Character
    {
        foreach ($values as $key => $value) {
            if(!$character->{$key}) {
                $character->{$key} = $value;
            }
        }
        return $character;
    }
}

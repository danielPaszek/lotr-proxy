<?php

namespace App\Service\TheOneApi;

interface TheOneApiConsts
{
    const API_KEY = 'nhKK9W0NK3xYUBPp-1CK';
    const BASE_URL = 'https://the-one-api.dev/v2/';
    const QUOTES_FETCHED = 1;
    const CATEGORIES = [
            'race' => ['Human', 'Elf', 'Dwarf', 'Hobbit', 'Maiar', 'Orc', 'Dragon', 'Eagle', 'Ainur', 'Half-elven', 'Elves', 'Others'],
            'gender' => ['Male', 'Female'],
            'realm' => ['Rohan', 'Gondor', 'Arthedain', 'Númenor', 'Khazad-dum', 'Shire', 'Doriath']

        ];
}

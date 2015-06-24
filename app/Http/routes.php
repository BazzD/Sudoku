<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',

    /**
     *
     * Omdat deze opdracht maar 1 (index)pagina genereerd en er geen model nodig is, is er voor gekozen ook geen controller te gebruiken.
     * de "view" wordt rechtstreeks vanaf deze route aangeroepen.
     *
     */

    function () {

        $puzzle = makePuzzle();

    /*
     * Een random selectie maken van hokjes die al ingevuld worden. (hier 33 zoals in voorbeeld)
     * Hierbij worden eerst "coordinaten" eruit gehaald die niet gebruikt worden.
     *
     */

    $numbers = array_diff(range(11, 99),range(20,90,10));
    shuffle($numbers);
    $show = array_slice($numbers, 0, 33);


    return view('sudoku',array('puzzle'=>$puzzle,'show'=>$show));


});

function makePuzzle(){


    /*
     * De sudoku wordt opgebouwd per rij ($a). Dan wordt per vakje ($b) gekeken
     * welke nummer nog niet gebruikt zijn in de rij, in de kolom ($columnCandidates) en in de huidige "zone" ($zoneCandidates, een vakje van 3X3).
     *
     *
     * Als een nummer past, wordt het nummer uit drie reeksen gehaald en is het volgende vakje aan de beurt (b++).
     *
     */


    $puzzle = $rowCandidates = $columnCandidates = $zoneCandidates = array();
    $a = 1;
    $rowfail = 0;

    while ($a<10) {


        $puzzle[$a] = $thisRow = array();

        /*
         * een zone (3x3 vakje) heeft ook een x-coordinaat en een y-coordinaat. $a bepaald de ZoneX, en $b bepaald de $zoneY.
         * beiden vormen een unieke index in $tempZoneCandidates.
         */

        $zoneX = round(($a+1)/3);
        $b = 1;


        while ($b < 10) {
            if ($b == 1) {
                $set = range(1,9);
                unset($tempColumnCandidates,$tempZoneCandidates);
            }

            if (!isset($tempColumnCandidates[$b])) {
                if (!isset($columnCandidates[$b])) {
                    $columnCandidates[$b] = range(1, 9);
                }
                $tempColumnCandidates[$b] = $columnCandidates[$b];

            }

            $zoneY = round(($b + 1) / 3);

            if (!isset($tempZoneCandidates[$zoneX . $zoneY])) {
                if (!isset($zoneCandidates[$zoneX . $zoneY])) {
                        $zoneCandidates[$zoneX . $zoneY] = range(1, 9);
                }
                $tempZoneCandidates[$zoneX . $zoneY] = $zoneCandidates[$zoneX . $zoneY];
            }

            $fail = 0;
            while (sizeof($set) && $fail < 10) {
                $index = array_rand($set);
                $x = $set[$index];
                if (in_array($x, $tempZoneCandidates[$zoneX . $zoneY]) && in_array($x, $tempColumnCandidates[$b])) {
                    $thisRow[$b] = $x;
                    unset($set[$index],$tempColumnCandidates[$b][$index],$tempZoneCandidates[$zoneX . $zoneY][$index]);
                    break;
                }
                elseif ($b == 9) break; // als het laatste van de rij nummer niet past, heeft het geen zin om dit nummer nog het langer te blijven proberen.
                $fail++;
            }
            $b++;

        }

        /*
         * Wanneer $thisRow 9 elementen heeft, is het blijkbaar gelukt de rij af te maken en gaan we naar de volgende rij.
         * Als het niet gelukt is proberen we het met een nieuwe rij-reeks. Als het na 100 reeksen nog niet is gelukt,
         * is er blijkbaar eerder in de puzzel een onmogelijkheid gecreerd, dus kunnen we beter helemaal opnieuw beginnen.
         * ($a = 1);
         *
         * (uit de praktijk blijkt dat ongeveer 1 op de 20 de puzzel opnieuw gemaakt moet worden)
         */

        if (sizeof($thisRow) == 9) {
            $puzzle[$a] = $thisRow;
            $columnCandidates = $tempColumnCandidates;
            $zoneCandidates = $tempZoneCandidates;
            $a++;
        }
        else {
            $rowfail++;
        }
        if ($rowfail > 100) {
            unset($columnCandidates,$zoneCandidates);
            $a = 1;
            $rowfail = 0;

        }
    }
    return $puzzle;
}

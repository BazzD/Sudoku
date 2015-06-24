## Sudoku generator

De sudoku wordt opgebouwd per rij. Dan wordt per vakje gekeken welke nummers nog niet gebruikt zijn in de rij,
de kolom en in de huidige "zone" (een vakje van 3X3).

Als een nummer past, wordt het nummer uit drie reeksen gehaald en is het volgende vakje aan de beurt.
Wanneer de nieuwe rij 9 elementen heeft, is het blijkbaar gelukt de rij af te maken en gaan we naar de volgende rij.

Als het niet gelukt is proberen we het met een nieuwe rij-reeks. Als het na 100 reeksen nog niet is gelukt,
is er blijkbaar eerder in de puzzel een onmogelijkheid gecreerd, dus kunnen we beter helemaal opnieuw beginnen.
(Ongeveer 1 op de 20 de puzzels wordt opniew vanaf het begin opgebouwd)

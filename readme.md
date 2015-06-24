## Sudoku generator

 De sudoku wordt opgebouwd per rij ($a). Dan wordt per vakje ($b) gekeken welke nummer nog niet gebruikt zijn in de rij,
 in de kolom ($columnCandidates) en in de huidige "zone" ($zoneCandidates, een vakje van 3X3).
 Als een nummer past, wordt het nummer uit drie reeksen gehaald en is het volgende vakje aan de beurt (b++).

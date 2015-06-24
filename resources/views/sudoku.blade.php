@extends('app')

@section('content')

<table id="tblSudoku"><tbody>


    {{-- tabel wordt rij voor rij opgebouwd--}}
    @foreach($puzzle as $rowIndex => $row)






        {{-- dikkere lijnen om de zones--}}
        <tr class="{{$topBorder = ($rowIndex == 4 || $rowIndex == 7)   ? 'topBorder' : ''}}">

            {{-- per rij worden de kolommen gemaakt --}}
            @foreach($row as $columnIndex => $column)

                {{-- omdat $rowIndex.$columnIndex vaker gebruikt wordt maken we er meteen een id van --}}
                <?php $id = intval($rowIndex.$columnIndex)?>

                {{-- Dikkere lijnen om de zones, en als dit vakje "pre-filled" is dan wordt de td class en de input read-only --}}
                <td class="{{$columnIndex == 4 || $columnIndex == 7   ? 'lftBorder' : ''}}{{in_array($id,$show) ? ' rdonly' : ''}}">

                @if(in_array($id,$show))
                    <input name="cell_{{$id}}" id="cell_{{$id}}" maxlength="1" class="cell" value="{{$column}}" readonly type="text"></td>

                @else
                    {{-- Als het vakje niet pre-filled is wordt de oplossing verstopt in de id van de input. onclick="this.select()" maakt het wijzigen van ingevoerde nummers handiger --}}
                    <input name="cell_{{$id}}" id="cell_{{$id}}-{{$column}}" maxlength="1" class="cell" value="" onclick="this.select()" type="text"></td>

                @endif


            @endforeach

        </tr>

    @endforeach


</tbody></table>

{{-- Buttons hebben een id waarmee ze met Javascript(Jquery) een functie krijgen. (zie public/js/sudoku.js)--}}

<button class="btn btn-primary" id="restart" >Opnieuw beginnen</button>

<button class="btn btn-primary" id="checkSolution" >Controleren</button>

<button class="btn btn-primary" id="showSolution"> Ik geef het op!</button>

<a href="{{url('/')}}" class="btn btn-primary" id="newPuzzle"> Een nieuwe puzzel!</a>

@endsection





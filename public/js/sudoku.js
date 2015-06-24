



$(function() {
    var cheated = false;

      $('#restart').click(function(){
            cheated = false;

        $(":input.cell:not([readonly])").each(function(){

            var el = $(this);
            el.parent().removeClass('correct incorrect');
            el.val('')
        });
    });


    $('#checkSolution').click(function(){
         if(cheated) return alert( 'Helemaal goed natuurlijk ;) ');
         var allFilled,zeroFilled  = true;
         var failed = false;

        $(":input.cell:not([readonly])").each(function(){

            var el = $(this);
            var td = el.parent();
            td.removeClass('correct incorrect');
            if(el.val()){
                zeroFilled = false;
                if(el.val() == el.attr('id').substr(8)) td.addClass('correct');
                else {
                    failed = true;
                    td.addClass('incorrect')
                }
            }
            else allFilled = false;

        });


        if(zeroFilled) alert('Vul eerst de lege vakjes in.');
        else if(!failed && allFilled)alert( 'Wouw! Goed gedaan!! ');
    });

    $('#showSolution').click(function(){
        if(cheated) return;
        cheated = true;
        $(":input.cell:not([readonly])").each(function(){
            var el = $(this);
            var td = el.parent();
            td.removeClass('correct incorrect');
            var correctValue = el.attr('id').substr(8);

            if(el.val() && el.val() == correctValue){
               td.addClass('correct');

            }
            else el.val(correctValue);
        });
    });
});
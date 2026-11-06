let dateKunde =$('#datepickerKunde');
let start = dateKunde.find('.res_start');
let end = dateKunde.find('.res_end');
dateKunde.datepicker({
    format: "dd.mm.yyyy",
    showClear: true,
    todayBtn: "linked",                     // Heute Button anzeigen
    clearBtn: true,                     // LoeschButton anzeigen
    language: "de",                     // deutsches Sprachformat
    todayHighlight: true,               // Heute hervorheben
    //showMeridian: true,                 // 24h zu 12h Format
   // daysOfWeekDisabled: "[0,6]",        // Tage deaktivieren - 0= Sonntag, 1=Montag, 2= Dienstag, 3=Mittwoch, 4= Donnerstag, 5= Freitag, 6= Sonnabend
    daysOfWeekHighlighted: "[0,6]",       // Tage hervorheben - 0= Sonntag, 1=Montag, 2= Dienstag, 3=Mittwoch, 4= Donnerstag, 5= Freitag, 6= Sonnabend
    orientation: "bottom auto",
    startDate: new Date(),
    autoclose: true,                    // automatisch Fenster nach Eingabe schliessen
    calendarWeeks: true                 // Wochennummern anzeigen
});
start.change('show', function(){
    let date = start.datepicker('getDate');
    date = moment(date).add(2, 'days').toDate();
    end.datepicker('setStartDate', date);
    end.datepicker('setDate', date);
});


/*
$('.input-group.date.anreise').formValidation({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    todayHighlight: true,
    orientation: "bottom auto",
    startDate: new Date(),
    language: "de",
    autoclose: true,
    calendarWeeks: true
});
$('.input-group.date.abreise').formValidation({
    format: "dd-mm-yyyy",
    todayHighlight: true,
    orientation: "bottom auto",
    startDate: '+1d',
    language: "de",
    autoclose: true,
    calendarWeeks: true
});*/

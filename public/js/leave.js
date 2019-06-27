var date = new Date();
date.setDate(date.getDate());

let dateFormat = 'dd/mm/yyyy';
let startDate = $('.start-date');
let endDate = $('.end-date');
let fullDaySelector = $('.fullDaySelector');
let periodBoxSelector = $('.periodBoxSelector');
let hoursBoxSelector = $('.hoursBoxSelector');

fullDaySelector.hide();
periodBoxSelector.hide();
hoursBoxSelector.hide();

// get the non working days
var center=$(".center_id").val();
console.log(center);
if(center==3){
    $('.start-date').datepicker({
    
        format: dateFormat,    
        daysOfWeekDisabled: [5, 6],
            
    }).on('changeDate', function () {
        showDays();
    });
    $('.end-date').datepicker({
        format: dateFormat,    
        daysOfWeekDisabled: [5, 6]
    
    }).on('changeDate', function () {
        showDays();
    })

}else{
    $('.start-date').datepicker({
    
        format: dateFormat,    
        daysOfWeekDisabled: [0, 6],
    }).on('changeDate', function () {
        showDays();
    });
    $('.end-date').datepicker({
        format: dateFormat,    
        daysOfWeekDisabled: [0, 6]
    
    }).on('changeDate', function () {
        showDays();
    })
}
// get the non working days
// $('.start-date').datepicker({
    
//     format: dateFormat,    
//     daysOfWeekDisabled: [0, 6],
//     beforeShowDay: function(currentDate){
//         var day=currentDate.getDay();
//         var center=$(".center_id").val();
//         console.log(center);
//         // var days=$(".days").val();
//         // console.log(days);
//         // var day_id=$(".day_id").val();
//         // console.log(day_id);
//         if(center == 3 ){
//             return [daysOfWeekDisabled: [5, 6]];
//         }else {
//             return true;
//         }
        
//     }
// }).on('changeDate', function () {
//     showDays();
// });

// $('.end-date').datepicker({
//     format: dateFormat,    
//     daysOfWeekDisabled: [0, 6]

// }).on('changeDate', function () {
//     showDays();
// })

// $('#hourStart').timepicker();
// $('#hourEnd').bootstrapMaterialDatePicker({ date: false });


$('.start-date, .end-date, #daySelector, #periodSelector, #hoursSelector, #leave-type').on('change', endDateChange);



function endDateChange() {

    let oneDaySummary = '<i class="ti-info-alt"></i> ' + 'You are taking ' + $('#leave-type :selected').text() +
        ' on ' + startDate.val() + '. ' + $('#daySelector :selected').text() + '.';
    let oneDaySummaryWithPeriod = '<i class="ti-info-alt"></i> ' + 'You are taking '  + $('#leave-type :selected').text() +
        ' on ' + startDate.val() + ' for ' + $('#daySelector :selected').text() + '. I will be absent in the ' + $(
            '#periodSelector :selected').text() + '.';

    let daySummary = '<i class="ti-info-alt"></i> ' + 'You are taking ' + $('#leave-type :selected').text() +
        ' from ' + startDate.val() + ' until ' + endDate.val() + '.';

    let oneDaySummaryWithHours = '<i class="ti-info-alt"></i> ' + $('#leave-type :selected').text() +
        ' on ' + startDate.val() + ' for ' + '. I will be absent from ' + $(
            '#hourStart').val() + ' until ' + $(
            '#hourEnd').val();

    if (startDate.val() == endDate.val()) {

        $('.fullDaySelector').show();

        $('.summary').empty().append(oneDaySummary);
        initializeDatepicker();

        if ($('#daySelector').val() == 1) {
            $('.periodBoxSelector').show();
            $('.hoursBoxSelector').hide();
            $('.summary').empty().append(oneDaySummaryWithPeriod);
            $('#num_nights').hide();
        } else if ($('#daySelector').val() == 3) {
            $('.periodBoxSelector').hide();
            $('.hoursBoxSelector').show();
            $('.summary').empty().append(oneDaySummaryWithHours);
            $('#num_nights').show();
        } else {
            $('.periodBoxSelector').hide();
            $('.summary').empty().append(oneDaySummary);
            $('#num_nights').show();
        }

    } else {

        $('.fullDaySelector').hide();
        $('.summary').empty().append(daySummary);
    }
}

function showDays() {

    var start = moment($('.start-date').datepicker('getDate'), dateFormat);
    var end = moment($('.end-date').datepicker('getDate'), dateFormat);

    if (start.isValid() && end.isValid()) {
        var duration = moment.duration(end.diff(start));
    }
    let total1 = duration.days() + 1;
     // Subtract two weekend days for every week in between
     var weeks = Math.floor(total1 / 7);
     let total = total1 - (weeks * 2);
 
     // Handle special cases
     var startDay = start.days();
     var endDay = end.days();
          
     // Remove weekend not previously removed.   
     if (startDay - endDay > 1){     
         total  = total - 2;   
     }   
    
    let normalMessage = `You're taking ${total} ${pluralize('day',total)} leave`;
    let moreThan10DaysMessage = `Holy smoke! You're taking ${total} ${pluralize('day',total)} leave`;

    total > 10 ? $('#num_nights').empty().append(moreThan10DaysMessage) : $('#num_nights').empty().append(normalMessage);

}

function initializeDatepicker() {
    startDate.datepicker();
    endDate.datepicker();
}

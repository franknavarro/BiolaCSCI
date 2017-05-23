/*************************************************************

If Browser Doesn't Support Datetime then this is our fallback implementation

Recieved From: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local

*************************************************************/

// define variables
var nativePicker = document.querySelector('.nativeDateTimePicker');
var fallbackPicker = document.querySelector('.fallbackDateTimePicker');

var legitDateTimePicker = document.getElementById("dueDate");

var yearSelect = document.querySelector('#year');
var monthSelect = document.querySelector('#month');
var daySelect = document.querySelector('#day');
var hourSelect = document.querySelector('#hour');
var minuteSelect = document.querySelector('#minute');
var todSelect = document.querySelector("#TOD");

// hide fallback initially
fallbackPicker.style.display = "none";

// test whether a new date input falls back to a text input or not
var test = document.createElement('input');
test.type = 'datetime-local';
// if it does, run the code inside the if() {} block
if(test.type === 'text') {
  // hide the native picker and show the fallback
  nativePicker.style.display = 'none';
    legitDateTimePicker.readOnly = true;
  fallbackPicker.style.display = 'block';

  // populate the days and years dynamically
  // (the months are always the same, therefore hardcoded)
  populateDays(monthSelect.value);
  populateYears();
  populateHours();
  populateMinutes();
    
    updateDateTimeField();
}

function populateDays(month) {
  // delete the current set of <option> elements out of the
  // day <select>, ready for the next set to be injected
  while(daySelect.firstChild){
    daySelect.removeChild(daySelect.firstChild);
  }

  // Create variable to hold new number of days to inject
  var dayNum;

  // 31 or 30 days?
  if(month == 1 | month == 3 | month == 5 | month == 7 | month == 8 | month == 10 | month == 12) {
    dayNum = 31;
  } else if(month == 4 | month == 6 | month == 9 | month == 11) {
    dayNum = 30;
  } else {
  // If month is February, calculate whether it is a leap year or not
    var year = yearSelect.value;
    (year - 2016) % 4 === 0 ? dayNum = 29 : dayNum = 28;
  }

  // inject the right number of new <option> elements into the day <select>
  for(i = 1; i <= dayNum; i++) {
    var option = document.createElement('option');
    option.textContent = i;
    daySelect.appendChild(option);
  }

  // if previous day has already been set, set daySelect's value
  // to that day, to avoid the day jumping back to 1 when you
  // change the year
  if(previousDay) {
    daySelect.value = previousDay;

    // If the previous day was set to a high number, say 31, and then
    // you chose a month with less total days in it (e.g. February),
    // this part of the code ensures that the highest day available
    // is selected, rather than showing a blank daySelect
    if(daySelect.value === "") {
      daySelect.value = previousDay - 1;
    }

    if(daySelect.value === "") {
      daySelect.value = previousDay - 2;
    }

    if(daySelect.value === "") {
      daySelect.value = previousDay - 3;
    }
  }
}

function populateYears() {
  // get this year as a number
  var date = new Date();
  var year = date.getFullYear();

  // Make this year, and the 100 years after it available in the year <select>
  for(var i = 0; i <= 100; i++) {
    var option = document.createElement('option');
    option.textContent = year+i;
    yearSelect.appendChild(option);
  }
}

function populateHours() {
  // populate the hours <select> with the 24 hours of the day
  for(var i = 0; i <= 11; i++) {
    var option = document.createElement('option');
    option.textContent = (i < 9) ? ("0" + (i+1)) : i+1;
    hourSelect.appendChild(option);
  }
}

function populateMinutes() {
  // populate the minutes <select> with the 60 hours of each minute
  for(var i = 0; i <= 59; i++) {
    var option = document.createElement('option');
    option.textContent = (i < 10) ? ("0" + i) : i;
    minuteSelect.appendChild(option);
  }
}

function updateDateTimeField() {
    var month = monthSelect.value;
    var day = daySelect.value;
    var year = yearSelect.value;
    var hour = parseInt(hourSelect.value);
    var minute = minuteSelect.value;
    var tod = todSelect.value;
    
    var newDateString = year + "-";
    newDateString += (month < 10) ? ("0" + month) : month;
    newDateString += "-";
    newDateString += (day < 10) ? ("0" + day) : day;
    newDateString += "T";
    newDateString += (tod === "PM" && hour < 12) ? (hour + 12) : (tod === "AM" && hour == 12) ? "00" : (hour < 10) ? ("0" + hour) : hour;
    newDateString += ":";
    newDateString += minute;
    
    legitDateTimePicker.value = newDateString;
    
}

//preserve day selection
var previousDay;

// when the month or year <select> values are changed, rerun populateDays()
// in case the change affected the number of available days
yearSelect.onchange = function() {
  populateDays(monthSelect.value);
    previousDay = daySelect.value;
    updateDateTimeField();
}

monthSelect.onchange = function() {
  populateDays(monthSelect.value);
    previousDay = daySelect.value;
    updateDateTimeField();
}

// update what day has been set to previously
// see end of populateDays() for usage
daySelect.onchange = function() {
  previousDay = daySelect.value;
    updateDateTimeField();
}

hourSelect.onchange = function() {
    updateDateTimeField();
}
minuteSelect.onchange = function() {
    updateDateTimeField();
}
todSelect.onchange = function() {
    updateDateTimeField();
}
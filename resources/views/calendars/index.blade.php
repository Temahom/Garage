@extends('layout.index')
  
@section('content')
<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="response">
        <div id="calendar">
            <h2>Calendrier</h2>
        </div>
    </div>
</div>
@endsection

@section('styles')
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
 
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

<script>
$(document).ready(function () {
var SITEURL = "{{url('/')}}";
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
var calendar = $('#calendar').fullCalendar({
editable: true,
events: SITEURL + "/fullcalendar",
displayEventTime: true, 
editable: true,
eventRender: function (event, element, view) {
if (event.allDay === 'true') {
event.allDay = true; 
} else {
event.allDay = false;
}
},
selectable: true,
selectHelper: true,
select: function (start, end, allDay) {
var title = prompt('Event Title:');
if (title) {
var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
$.ajax({
url: SITEURL + "/fullcalendar/create",
// data: 'title=' + title + '&amp;start=' + start + '&amp;end=' + end,
data: 'title=' + title + '&start=' + start + '&end=' + end,
//type: "POST",
type: "GET",
success: function (data) {
displayMessage("Added Successfully");
}
});
calendar.fullCalendar('renderEvent',
{
title: title,
start: start,
end: end,
allDay: allDay
},
true
);
}
calendar.fullCalendar('unselect');
},
eventDrop: function (event, delta) {
var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
$.ajax({
url: SITEURL + '/fullcalendar/update',
//data: 'title=' + event.title + '&amp;start=' + start + '&amp;end=' + end + '&amp;id=' + event.id,
data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
type: "POST",
success: function (response) {
displayMessage("Updated Successfully");
}
});
},
eventClick: function (event) {
var deleteMsg = confirm("Do you really want to delete?");
if (deleteMsg) {
$.ajax({
type: "POST",
url: SITEURL + '/fullcalendar/delete',
//data: "&amp;id=" + event.id,
data: "&id=" + event.id,
success: function (response) {
if(parseInt(response) > 0) {
$('#calendar').fullCalendar('removeEvents', event.id);
displayMessage("Deleted Successfully");
}
}
});
}
}
});
});
function displayMessage(message) {
$(".response").html("<div class='success'>"+message+"</div>");
setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>

@endsection
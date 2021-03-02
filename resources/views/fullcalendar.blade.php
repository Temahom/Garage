@extends('layout.index')
 
@section('content')

<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
=======
>>>>>>> 015d39689f956fe1950505fcf1b93033a3188ecd
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js" integrity="sha512-vTlIpCig7Yl48kFM3fyxWwW7t+cf+U7Bi22g/o2D4hbGKXnN//6hNZYtIZKSmXQJ5BTdr1jMBz6BUZV030LmuQ==" crossorigin="anonymous"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


</head>
<<<<<<< HEAD
<body>
  
<div class="container">
    <h1>Laravel FullCalender Tutorial Example - ItSolutionStuff.com</h1>
    <div class="response">
    <div id='calendar'></div>
=======


<div class="row">
  <div class="col-lg-12 margin-tb" style="width: 80%">
      <div class="pull-left">
        <h1>Calendrier des RV</h1>
      </div>
  </div>
  <div id='calendar' style="width: 98%"></div>
>>>>>>> 015d39689f956fe1950505fcf1b93033a3188ecd
</div>

   

<script>

$(document).ready(function () {
var SITEURL = "{{ url('/') }}";
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var calendar = $('#calendar').fullCalendar({
                   
                    editable: true,
                    events: SITEURL + "/fullcalendar",
                    displayEventTime: false,
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

                        var title = prompt('Nom d\'événement:');

                        if (title) {

                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");

                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

                            $.ajax({

                                url: SITEURL + "/fullcalendarAjax",

                                data: {

                                    title: title,

                                    start: start,

                                    end: end,

                                    type: 'add'

                                },

                                type: "POST",

                                success: function (data) {

                                    displayMessage("Evénement ajouté avec succès !!!");

  

                                    calendar.fullCalendar('renderEvent',

                                        {

                                            id: data.id,

                                            title: title,

                                            start: start,

                                            end: end,

                                            allDay: allDay

                                        },true);

  

                                    calendar.fullCalendar('unselect');
                                    

                                }

                            });

                        }

                    },

                    eventDrop: function (event, delta) {

                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");

                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

  

                        $.ajax({

                            url: SITEURL + '/fullcalendarAjax',

                            data: {

                                title: event.title,

                                start: start,

                                end: end,

                                id: event.id,

                                type: 'update'

                            },

                            type: "POST",

                            success: function (response) {

                                displayMessage("Evénement modifié");

                            }

                        });

                    },

                    eventClick: function (event) {

                        var deleteMsg = confirm("Voulez vous supprimer l'événement ?");

                        if (deleteMsg) {

                            $.ajax({

                                type: "POST",

                                url: SITEURL + '/fullcalendarAjax',

                                data: {

                                        id: event.id,

                                        type: 'delete'

                                },

                                success: function (response) {

                                    calendar.fullCalendar('removeEvents', event.id);

                                    displayMessage("Evénement supprimé avec succès !!!");

                                }

                            });

                        }

                    }

 

                });

 

});

 

function displayMessage(message) {

    toastr.success(message, 'Rendez-vous');

} 

</script>
  
@endsection
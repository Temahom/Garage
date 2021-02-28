
<template>
<div class="container">
       <full-calendar :event-sources="eventSources"></full-calendar>
       </div>
</template>
<script>
    export default{
  data() {
    return {
      eventSources: [
        {
          events(start, end, timezone, callback) {
            axios.get('http://localhost:8000/events').then(response => {
              callback(response.data.events)
            })
          },
          color: 'yellow',
          textColor: 'black',
        }
      ]
    }
  }
    }
</script>
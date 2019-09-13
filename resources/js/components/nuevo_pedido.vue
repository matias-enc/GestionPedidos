<template>
  <form-wizard title="" subtitle="" @on-complete="onComplete"
  color="#007bff"
  :start-index="0">
     <tab-content title="Fecha"
                  icon="far fa-calendar">

     </tab-content>
     <tab-content title="Additional Info"
                  icon="far fa-calendar-check">
       My second tab content
     </tab-content>
     <tab-content title="Last step"
                  icon="ti-check">
       Yuhuuu! This seems pretty damn simple
     </tab-content>
 </form-wizard>

</template>

<script>

  export default {
     methods: {
      onComplete: function(){
          alert('Yay. Done!');
       }
      },
        props:{
          title: {
            type: String,
            default: ''
        }
      }
  }
</script>

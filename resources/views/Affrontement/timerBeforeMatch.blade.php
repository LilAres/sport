<div class="text-center">
    <h6>Temps restant avant le début du match</h6>
    <!-- Display the countdown timer in an element -->
    <h2 id="timerBeforeMatch"></h2>
</div>

<script>
    // Timer si le match n'est pas encore commencé

    // Set the date we're counting down to
    var countDownDate = new Date("{{$match->date}}").getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
    
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element with id="demo"
      document.getElementById("timerBeforeMatch").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      if(distance <= 0){
        window.reload();
      }
    
    }, 1000);
</script>
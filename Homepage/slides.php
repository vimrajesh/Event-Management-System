<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Image Slider | With Manual Buttons and Autoplay Navigation Visibility</title>
    
<style>
  <?php include "slidestyle.css" ?>
</style>
  </head>
  <body>

    <!-- <div class="img-slider">
      
      <div class="slide active">
        <img src="images/1.jpeg"  width="500px" height="500px" alt="">
      </div>
      <div class="slide">
        <img src="images/2.jpeg"  width="500px" height="500px" alt="">
      </div>
      <div class="slide">
        <img src="images/3.jpeg"  width="500px" height="500px" alt="">
      </div> 
      <div class="slide">
        <img src="images/4.jpeg"  width="500px" height="500px" alt="">
      </div>
      <div class="slide">
        <img src="images/5.jpeg" width="500px" height="500px" alt="">  
      </div>
      <div class="navigation">
        <div class="btn active"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
      </div>
    </div> -->
    <div class="img-slider">
    <?php
    $connect=mysqli_connect('localhost','root','','event_management_nitc');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $query1=mysqli_query($connect,"select e.Picture 
        from events as e where e.Event_Date >= CURDATE() order by e.Event_Date limit 7") or die("Error: " . mysqli_error($connect));
        $count=0;
        
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[0] = "../".$row1[0];
          // echo $row1[0];
          if($count==0)
          {
            $count=1;
            echo '<div class="slide active">';
            
    ?>
        <img src="<?php echo $row1[0]; ?>" width="500px" height="500px" alt="">
        <?php
            echo '</div>';
          } 
          else
          {
            echo '<div class="slide">';
    ?>
            <img src="<?php echo $row1[0]; ?>" width="500px" height="500px" alt="">
        <?php
            echo '</div>';

          }
                   
        }
        
    }
    $connect->close();
?>
      <div class="navigation">
        <div class="btn active"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
      </div>
    </div>

    <script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;

    // Javascript for image slider manual navigation
    var manualNav = function(manual){
      slides.forEach((slide) => {
        slide.classList.remove('active');

        btns.forEach((btn) => {
          btn.classList.remove('active');
        });
      });

      slides[manual].classList.add('active');
      btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
      });
    });

    // Javascript for image slider autoplay navigation
    var repeat = function(activeClass){
      let active = document.getElementsByClassName('active');
      let i = 1;

      var repeater = () => {
        setTimeout(function(){
          [...active].forEach((activeSlide) => {
            activeSlide.classList.remove('active');
          });

        slides[i].classList.add('active');
        btns[i].classList.add('active');
        i++;

        if(slides.length == i){
          i = 0;
        }
        if(i >= slides.length){
          return;
        }
        repeater();
      }, 10000);
      }
      repeater();
    }
    repeat();
    </script>

  </body>
</html>
                           
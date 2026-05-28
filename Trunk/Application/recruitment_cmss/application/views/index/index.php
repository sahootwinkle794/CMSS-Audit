  <div id="zoomcontent" >
  <section style="margin: 0; padding: 0;" >
   <!--  <?php include('pages/menu.php') ?>
   -->
    <?php include('pages/pages.php') ?>
    </section>

      <!-- footer -->    
 </div>

        
      <script>
        $(document).ready( function() {
          $('#myCarousel').carousel({
            interval:   4000
          });

          var clickEvent = false;
          $('#myCarousel').on('click', '.nav a', function() {
            clickEvent = true;
            $('.nav li').removeClass('active');
            $(this).parent().addClass('active');		
          }).on('slid.bs.carousel', function(e) {
            if(!clickEvent) {
              var count = $('.nav').children().length -1;
              var current = $('.nav li.active');
              current.removeClass('active').next().addClass('active');
              var id = parseInt(current.data('slide-to'));
              if(count == id) {
                $('.nav li').first().addClass('active');	
              }
            }
            clickEvent = false;
          });
        });
      </script>
      <!-- animation page -->
  
     <!--  <script src="js/anim.js"></script> 
      <script>
        function openCity(cityName) {
          var i;
          var x = document.getElementsByClassName("city");
          for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";  
         }
         document.getElementById(cityName).style.display = "block";  
       }
     </script> -->

     <script>
var x = document.querySelector('.skipToContent');
var y = document.querySelector('.getFocus');
x.addEventListener('click', function(e) {
  e.preventDefault()
  y.scrollIntoView()
});
</script>

<script>
var x = document.querySelector('.skipToLink');
var y = document.querySelector('.getFocus');
x.addEventListener('click', function(e) {
  e.preventDefault()
  y.scrollIntoView()
});
</script>

<script>
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
    $("#flip2").click(function(){
        $("#panel2").slideToggle("slow");
    });
});

</script>   

<script>
  var $affectedElements = $("p"); // Can be extended, ex. $("div, p, span.someClass")

// Storing the original size in a data attribute so size can be reset
$affectedElements.each( function(){
  var $this = $(this);
  $this.data("orig-size", $this.css("font-size") );
});

$("#btn-increase").click(function(){
  changeFontSize(1);
})

$("#btn-decrease").click(function(){
  changeFontSize(-1);
})

$("#btn-orig").click(function(){
  $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , $this.data("orig-size") );
   });
})

function changeFontSize(direction){
    $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , parseInt($this.css("font-size"))+direction );
    });
}
</script> 
<script type="text/javascript">
  /*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});
 /*Scroll to top when arrow up clicked END*/
</script>


 <script>
        <!-- Hide from old browsers
        var TRange = null;
        var dupeRange = null;
        var TestRange = null;
        var win = null;
        var nom = navigator.appName.toLowerCase();
        var agt = navigator.userAgent.toLowerCase();
        var is_major   = parseInt(navigator.appVersion);
        var is_minor   = parseFloat(navigator.appVersion);
        var is_ie      = (agt.indexOf("msie") != -1);
        var is_ie4up   = (is_ie && (is_major >= 4));
        var is_not_moz = (agt.indexOf('netscape')!=-1)
        var is_nav     = (nom.indexOf('netscape')!=-1);
        var is_nav4    = (is_nav && (is_major == 4));
        var is_mac     = (agt.indexOf("mac")!=-1);
        var is_gecko   = (agt.indexOf('gecko') != -1);
        var is_opera   = (agt.indexOf("opera") != -1);


        //  GECKO REVISION

        var is_rev=0
        if (is_gecko) {
            temp = agt.split("rv:")
            is_rev = parseFloat(temp[1])
        }
        var frametosearch = self;


        function search(whichform, whichframe) {

            //  TEST FOR IE5 FOR MAC (NO DOCUMENTATION)

            if (is_ie4up && is_mac) return;

            //  TEST FOR NAV 6 (NO DOCUMENTATION)

            if (is_gecko && (is_rev <1)) return;

            //  TEST FOR Opera (NO DOCUMENTATION)

            if (is_opera) return;

            //  INITIALIZATIONS FOR FIND-IN-PAGE SEARCHES

            if(whichform.findthis.value!=null && whichform.findthis.value!='') {

                str = whichform.findthis.value;
                win = whichframe;
                var frameval=false;
                if(win!=self)
                {

                    frameval=true;  // this will enable Nav7 to search child frame
                    win = parent.frames[whichframe];

                }
            }

            else return;  //  i.e., no search string was entered

            var strFound;

            //  NAVIGATOR 4 SPECIFIC CODE

            if(is_nav4 && (is_minor < 5)) {

                strFound=win.find(str); 
            }

            if (is_gecko && (is_rev >= 1)) {

                if(frameval!=false) win.focus(); // force search in specified child frame
                strFound=win.find(str, false, false, true, false, frameval, false);
                if (is_not_moz)  whichform.findthis.focus();
            }

            if (is_ie4up) {
                if (TRange!=null) {

                    TestRange=win.document.body.createTextRange();
                    if (dupeRange.inRange(TestRange)) {

                        TRange.collapse(false);
                        strFound=TRange.findText(str);
                        if (strFound) {
                            //the following line added by Mike and Susan Keenan, 7 June 2003
                            win.document.body.scrollTop = win.document.body.scrollTop + TRange.offsetTop;
                            TRange.select();
                        }


                    }

                    else {

                        TRange=win.document.body.createTextRange();
                        TRange.collapse(false);
                        strFound=TRange.findText(str);
                        if (strFound) {
                            //the following line added by Mike and Susan Keenan, 7 June 2003
                            win.document.body.scrollTop = TRange.offsetTop;
                            TRange.select();
                        }
                    }
                }

                if (TRange==null || strFound==0) {
                    TRange=win.document.body.createTextRange();
                    dupeRange = TRange.duplicate();
                    strFound=TRange.findText(str);
                    if (strFound) {
                        //the following line added by Mike and Susan Keenan, 7 June 2003
                        win.document.body.scrollTop = TRange.offsetTop;
                        TRange.select();
                    }
                }

            }

            if (!strFound) alert ("String '"+str+"' not found!") // string not found
        }
        // -->
    </script>
<script>
    document.getElementById("time").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
    hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
    ampm = d.getHours() >= 12 ? 'pm' : 'am',
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
return days[d.getDay()]+' '+months[d.getMonth()]+' '+d.getDate()+' '+d.getFullYear()+' '+hours+':'+minutes+ampm;
}
</script>



   

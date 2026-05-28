<style type="text/css">
  .navactive1{
   color:#fff;
    
    
  }
  
.f-nav{  /* To fix main menu container */
    z-index: 1560;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
}
#main-menu-container {
    text-align: center; /* Assuming your main layout is centered */
}
#main-menu {
    display: inline-block;
    width: 100%; /* Your menu's width */
}



</style>

    <nav class="navbar navbar-default navbar-static-top" style="background: transparent; padding-left: 0;">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li <?php if(isset($_REQUEST['p'])){if(($_REQUEST['p']=="home")){ echo 'class="navactive1"'; } else {}};?>><a href="?p=home" > Home &nbsp; | &nbsp;</a></li>
 
 

      <li <?php if(isset($_REQUEST['page'])){if(($_REQUEST['page']) == 1){ echo 'class="navactive1"'; } else {}};?>><a href="?p=content&page=1"> About OSTT &nbsp; | &nbsp;</a></li>

<li <?php if(isset($_REQUEST['page'])){if(($_REQUEST['page']) == 2){ echo 'class="navactive1"'; } else {}};?>><a href="?p=content&page=2"> Rules &amp; Regulations &nbsp; | &nbsp;</a></li>


              <li><a href="?p=organisation"> Organisation &nbsp; | &nbsp;</a></li>

             <li <?php if(isset($_REQUEST['page'])){if(($_REQUEST['page']) == 4){ echo 'class="navactive1"'; } else {}};?>><a href="?p=content&page=4">PIO &nbsp; | &nbsp;</a></li>

               <li <?php if(isset($_REQUEST['page'])){if(($_REQUEST['page']) == 5){ echo 'class="navactive1"'; } else {}};?>><a href="?p=content&page=5">RTI &nbsp; | &nbsp;</a></li>

                <li><a href="?p=contact">Contact Us</a></li>


    </ul>
</div>

</nav>



<script type="text/javascript">
  // Dropdown Menu Fade    
jQuery(document).ready(function () {
    $(".dropdown").hover(

    function () {
        $('.dropdown-menu', this).stop().fadeIn("fast");
    },

    function () {
        $('.dropdown-menu', this).stop().fadeOut("fast");
    });
});
</script>

<script type="text/javascript">
  $("document").ready(function($){
    var nav = $('#main-menu-container');

    $(window).scroll(function () {
        if ($(this).scrollTop() > 125) {
            nav.addClass("f-nav");
        } else {
            nav.removeClass("f-nav");
        }
    });
});
</script>



  <?php 
  	//echo $this->session->userdata('institute_code');die();
  	$data = $this->uri->uri_to_assoc(); 
    $ins1 =$data['ins'];
    $ins = encrypt_decrypt('decrypt',$ins1);
   /* echo $ins1;
    die();*/
  ?>
<div class="left">
<div class="item" id="homeButton" style="cursor: pointer;">
<span class="glyphicon glyphicon-th-large"></span>
    Home
</div>
<!--<div class="item">
<span class="glyphicon glyphicon-th-list"></span>
    Dashboard</div>-->
<!--<div class="item" onclick="PaymentBrochurePdf()"  style="cursor: pointer;">
<span class="glyphicon glyphicon-log-out"></span>
    Payment Manual</div>-->
<!--<div class="item" onclick="AdvertisementPdf();"  style="cursor: pointer;">
<span class="glyphicon glyphicon-log-in"></span>
    Advertisement</div> 
<div class="item" onclick="broucherPdf();"  style="cursor: pointer;">
<span class="glyphicon glyphicon-random"  ></span>
    Brochure</div>
<div class="item" onclick="ImportantDatesPdf();"  style="cursor: pointer;">
<span class="glyphicon glyphicon-remove"></span>
    Important Dates</div>  -->  
</div>

<style type="text/css">
  
.left, .right {
        float:left;
        height:auto;
        padding-left: 0;
    }
    
.left {
        background-color: #20505f;
        display: inline-block;
        white-space: nowrap;
        width: 50px;
        transition: width 1s ;\
        position: absolute;

    }

.right {
        background: #fff;
        width: 350px;
        transition: width 1s;
        border-style:solid;
        border-color:#ccc;
        border-width:1px;
        
    }    

.left:hover {
        width: 250px;
    }    
    
.item:hover {
        background-color:#36a3c5;
        }
        
.left .glyphicon {
        margin:15px;
        width:20px;
        color:#fff;
    }
    
.right .glyphicon {
        color:#a9a9a9;
    }
span.glyphicon.glyphicon-refresh{
    font-size:17px;
    vertical-align: middle !important;
    }
    
.item {
        height:50px;
        overflow:hidden;
        color:#fff;
    }
.title {
        background-color:#eee;
        border-style:solid;
        border-color:#ccc;
        border-width:1px;
        box-sizing: border-box;
    }
.search:hover {
        border-color:#4aa9fb;
        border-width:1px;
    }
.search {
    padding:3px 8px 3px !important;
    }
input[type=search] {
    padding: 10px 0px 10px;
  border: 0px solid #fff;
  background: #eee;
  -webkit-appearance: none;
    width:90%;
    float:none;
}
input[type=search]:focus {
    outline:none;
    }
.type{
    height: 47px;;
    }
.date{
    background-color:#f7f7f7
    }
.docdate {
    vertical-align:bottom !important;
    }
.distr {
    margin: 0 0 5px;
    font-size: 12px;
    }
.ndoc {
    margin: 0 0 5px;
    }
.storage {
    margin: 0;
    color: #aaa !important;
    font-size: 12px;
    }
</style>

<div class="modal fade" id="datee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #00008B;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b> IMPORTANT DATES</b></h4>
          </div>
          <div class="modal-body" style="height: 490px;">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Starting of online publication of Application forms</h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4 style="color: #0054ff;padding-right:10px;padding-right:20px;    margin-left: -15px; font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>05.04.2018</b></h4>
            </div>
          </div>
          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Last date of receipt of Application form</h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>26.05.2018</b></h4>
            </div>
          </div>
          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Last date of receipt of Application form from North Eastern States, J&K & Andaman & Nicobar Islands</h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>02.06.2018</b></h4>
            </div>
          </div>
          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Last Date of upload of Admit Cards in Institute website</h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>13.06.2018</b></h4>
            </div>
          </div>
          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Date of Entrance Test</h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>02.07.2018</b></h4>
            </div>
          </div>
          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Declaration of Result (Tentative)</h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>28.07.2018</b></h4>
            </div>
          </div>
          
          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b> Date of 1st Counseling </b></h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>26.09.2018</b></h4>
            </div>
          </div>

          <div class="row">
                <div class="col-md-1">
                  <span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
                </div>
            <div class="col-md-6">
              <h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b> Session begins</b></h4>
            </div>
            <div class="col-md-1">
              <h4 style="color: #0054ff;">:</h4>
            </div>
            <div class="col-md-4">
              <h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>03.10.2018</b></h4>
            </div>
          </div>
            </div>
        </div>
      </div>
    </div> 
</div>

<div class="modal fade" id="modalbrouchure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #496cad;color: white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="color: white;" id="myModalLabel">BROCHURE</h4>
        </div>
        <div class="modal-body" id="divInstruction">
          <iframe id="frame" src="" width="100%" height="300">
          
          </iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>

  $("#homeButton").click(function () { 
      window.location='<?php echo base_url(); ?>apply/institute_page/ins/<?=$ins1?>';
  });
  function broucherPdf(){
	 //window.open('<?php echo BASE_ADM_URL?>/<?php echo $ins?>/Brochure.pdf','_blank');	
	 window.open('#','_self');	
  }
  function ImportantDatesPdf(){
	 //window.open('<?php echo BASE_ADM_URL?>/<?php echo $ins?>/Important_Dates.pdf','_blank');		
	 window.open('#','_self');	
  }
  function AdvertisementPdf(){
	 window.open('#','_self');	
  }
    
</script>
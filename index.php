<?php


function email_notification_footer_html($HOST,$email,$emailtype,$emailcode = null){
    $email_body = "            <div class = 'emailfooter' style = 'clear:both; font-size: 12px;color: #999999;text-align: center;/*width: 90%;margin-left: auto;margin-right: auto;clear: both;*/margin-top:20px'>
                                   <div class='rml_links_wrapper'>
                                       <a style = 'text-decoration:none' href='" . $HOST . "termsofservice?ref=ea'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Terms of Service</span>
                                       </a>
                                        |
                                       <a style = 'text-decoration:none' href='" . $HOST . "communityguidelines?ref=ea'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Community Guidelines</span>
                                       </a>
                                        |
                                       <a style = 'text-decoration:none' href='" . $HOST . "privacy?ref=ea'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Privacy Policy</span>
                                       </a>
                                        |
                                       <a style = 'text-decoration:none' href='" . $HOST . "sendfeedback?ref=ea'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Feedback</span>
                                       </a>
                                        |
                                       <a style = 'text-decoration:none' href='" . $HOST . "support?ref=ea'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Help Center</span>
                                       </a>";
    if($emailtype == 'useractivityemail'){
        $email_body .= "                    |
                                       <a style = 'text-decoration:none' href='" . $HOST . "settings/email'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Unsubscribe</span>
                                       </a>";
    }else if($emailtype == 'copyrightactivateaccountemail'){
        $email_body .= "                    |
                                       <a style = 'text-decoration:none' href='" . $HOST . "removefalseaccount?e=". $email ."&ec=". $emailcode ."'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Not my account</span>
                                       </a>";
    }else if($emailtype == 'useractivateaccountemail'){
        $email_body .= "                    |
                                       <a style = 'text-decoration:none' href='" . $HOST . "activate?e=" . $email . "&ec=" . $emailcode ."'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Not my account</span>
                                       </a>";
    }else if($emailtype == 'recoveraccountemail'){
        $email_body .= "                    |
                                       <a style = 'text-decoration:none' href='" . $HOST . "reportactivity?e=" . $email . "&rc=" . $emailcode . "'>
                                           <span class='rml_links' style = 'text-align: center; font-size: 12px; color: #438BC5;'>Report Activity</span>
                                       </a>";
    }
    $email_body .= "               </div>
                                   <span style = 'font-size: 12px;color: #999999;'>&#169;".$GLOBALS['physicaladdress'][0]." 2021, ".$GLOBALS['physicaladdress'][1].", ".$GLOBALS['physicaladdress'][2]."</span>
                                   <br>
                                   <span style = 'font-size: 12px;color: #999999;'>This is an automatically generated message  @ " . gmdate("Y-m-d H:i:s", time()) . " (GMT). Please do not send any emails to this address.</span>
                                </div>";

    return $email_body;


}
function email($to, $subject, $body, $from_name, $from_address, $replyto_name = null, $replyto_address = null, $returnpath_name = null, $returnpath_address = null)
{
    if ($replyto_name == null) {
        $replyto_name = $from_name;
    }
    if ($replyto_address == null) {
        $replyto_address = $from_address;
    }
    if ($returnpath_name == null) {
        $returnpath_name = $from_name;
    }
    if ($returnpath_address == null) {
        $returnpath_address = $from_address;
    }
    $headers = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=iso-8859-1' . "\r\n"
        . 'From: ' . $from_name . ' <' . $from_address . '>' . "\r\n"
        . 'Reply-To: ' . $replyto_name . ' <' . $replyto_address . '>' . "\r\n"
        . 'Return-Path: ' . $returnpath_name . ' <' . $returnpath_address . '>' . "\r\n"
        . "X-Priority: 1\r\n"
        . 'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $body, $headers, "-f " . $from_address);
}
function send_archive_download_mail($invitations){
    $HOST=$GLOBALS['RMLHOST'];
    $subject = 'Download link for your Ranx data';
    for($i = 0; $i<sizeof($invitations);$i++){
        $receiver_name = $invitations[$i]['name'];
        $email = $invitations[$i]['email'];
        $archivename = $invitations[$i]['archivename'];
        $email_body = "
        <html>
            <head>
                <style type='text/css'>
                * {
                    -webkit-text-size-adjust: none;
                    -moz-text-size-adjust: none;
                    font-family: 'Roboto', sans-serif;
                 }
                 body {
                    overflow-x: hidden;
                 }
                a{
                    text-decoration: none;
                }
                .downloadbutton:hover{
                    cursor:pointer;
                     background-color: #7abafa;
                 }
                .downloadbutton:active{
                    cursor:pointer;
                     background-color: #549ae0;
                 } 
                .rml_links:hover {
                    text-decoration: underline;
                }
                </style>
            </head>
            <body> 
                <div class = 'emailbodycontainerwrapper' style = 'background: #eeeeee;width: 100%; border-radius: 0.40em; -webkit-border-radius: 0.40em; -moz-border-radius: 0.40em; overflow-x: hidden;'>
                    <div class = 'emailbodycontainer' style = 'display:inline-block;width:92%;background-color: #FFFFFF; margin: 2%; padding: 2%; border-radius: 0.25em; -webkit-border-radius: 0.25em; -moz-border-radius: 0.25em; overflow-x: hidden'>
                        <div class = 'rmllogocontainer'>    
                            <a href='" . $HOST . "home?ref=ea'>
                                <img class='ranxlogo' src='".$HOST."images/ranxfinallogo.png' alt='Ranx.com' style = 'margin-bottom:20px;display: block; position: relative; height: auto; width: 75%; max-width: 450px;float: right; color: #000000; cursor: pointer; text-align: right;'>
                            </a>
                        </div>
                        <div class = 'emailbodydiv' style = 'line-height:22px; display: block;position: relative;float: left;width: 96%;padding: 2%;font-size: 14px;background-color: #f9f9f9;color:#666666;'>
                            <div class = 'emailgreetings' style = 'font-family: Roboto, sans-serif;color: #666666;margin-bottom: 20px;font-size: 14px;font-weight: bold'>Hello " .$receiver_name. ",</div>";

        $email_body .= "         <div class = 'notification_holder' style = 'font-family: Roboto, sans-serif;float: left;display: block;position: relative;width: 100%;margin-bottom: 10px;'>
                                <span>A copy of your data at Ranx has been created for you to access. To download the file, please click the link below: </span>
                                <div class = 'downloaddatabuttonwrapper' style = 'text-align: center;width: 160px;height: 40px;-webkit-border-radius: 1.40em;border-radius: 1.40em;background-color: #5dabf9;overflow: hidden;clear:both;margin: 30px auto;'>
                                    <a  href= '".$HOST."archivedatadownload/archives/".$archivename."'>
                                         <div class='downloadbutton' style = 'color: #ECFFF2;width:100%;height:100%'>
                                              <span class='downloadbuttontext' style  = 'display:inline-block;text-align: center;font-size: 18px;margin-top:8px;font-weight:normal;color:#ffffff'>Download Data</span>
                                         </div>
                                    </a>
                                </div>                 
                                <span style = 'display:block;float: left;margin-top:20px;margin-bottom:20px;clear:both'>Thank you,
                                <br>
                                Ranx Team.
                                </span>
                                <span style = 'line-height:16px;font-size:12px; margin-top: 20px; text-align: center;float:left;clear: both;color:#999999'>
                                    This message was sent to <a style = 'color:#999999;font-size:12px;text-decoration: none'>$email</a> 
                                    You are receiving this mail because you have signed in as a user of <a class= 'rml_links' href='" . $HOST . "index?ref=en' style = 'color:#438BC5;font-size:12px;/*text-decoration: none*/'>Ranx</a>. If you have any concerns or questions about how we treat and use your data, please contact <a  class= 'rml_links' href = 'mailto:dataprotection@rankmylist.com' style = 'color:#438BC5;font-size:12px;/*text-decoration: none*/'>dataprotection@rankmylist.com</a>.
                                </span>
                            </div>";
        $emailtype = 'others';
        $email_body .= email_notification_footer_html($HOST,$email,$emailtype);
        $email_body .= "
                        </div>
                    </div>
                </div>
            </body>
        </html>";
//        echo $email_body;
        email($email, $subject,$email_body, 'Ranx', 'noreply@ranx.com');
    }
}

$navs=['Agency','Portfolio','Procing','Page','Blog','Contact'];
function display_title_para_and_btn_html($title,$description,$buttontext,$total,$htag,$ptagcolor,$fontColorgray,$buttonBgColor=''){
    if($total===1){
//        $fontColorgray='text-dark';
        $totalNeeded='<div class="headinformationholder">
                          <div class="showtotalcounts"><span class="text-purple">12K+</span> DAILY STANDUPS</div>
                          <div class="showtotalcounts"><span class="text-purple">10K+</span> USER STORIES</div>
                          <div class="showtotalcounts"><span class="text-purple">1M+</span> COMMITS</div>
                      </div>';
    }else{
//        $fontColorgray='text-white';
        $totalNeeded="";
    }
    $aa='<div class="cardbg card-body">
              <'.$htag.' class="card-title '.$fontColorgray.'">'.$title.'</'.$htag.'>
              <p class="'.$ptagcolor.' card-text ">'.$description.'</p>
              '.$totalNeeded. showBtn($buttonBgColor,$buttontext).'
          </div>';
    return $aa;
}
function showBtn($buttonBgColor,$buttontext,$btntxtsize='',$btnposition=''){
    $btn=' <a href="#" class="'.$buttonBgColor.' '. $btntxtsize.' '.$btnposition.' btn ">'.$buttontext.'</a>';
    return $btn;
}

function moreFeature_option_show($morefeatureOptionArray){
    foreach ($morefeatureOptionArray as $moreFeature){
        $aa='<div class="morefeatures">
                <i class="morefeatureicon fa-thin fa-plus"></i>
                <p class="p-bottom p-sm-font-size">'.$moreFeature.'</p>
            </div>';
        echo $aa;
    }
}
function show_site_activities_info($whoeactivity,$numberCount,$bgcolor){
    $activities='<div class="total-customer '.$bgcolor.'">
                    <span class="customer-text">'.$whoeactivity.'</span>
                    <span class="customer-number-text">'.$numberCount.'+</span>
                </div>';
   echo $activities;
}


/*$str='[{"name":"eggs","price":1},{"name":"rice","price":4.04},{"name":"coffee","price":9.99}]';
$jsonData=json_decode($str, true);

usort($jsonData, function($a, $b) {
    return $a['price'] <=> $b['price'];
});
print_r($jsonData);*/

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>webappick project</title>
<!--    Font awesom cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    />
      <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container">
        <div class="top_container top-content-bg">

            <div class="headcontentcontainer">
              <nav class="navbar navbar-expand-lg navbar-light">
                  <a class="navbar-brand text-light" href="#">Kabbo</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav ml">
                          <?php foreach ($navs as $nav){?>
                              <li class="nav-item active "><a class="nav-link text-light" href="#"><?php echo $nav?> </a></li>
                          <?php }?>
                          <li class="nav-item active text-white cursor-pointer">
                              <i class="notification-i-p fa-solid fa-bucket"></i>
                          </li>
                          <li class="nav-item active text-white cursor-pointer">
                              <i class="search-i-padding fa-solid fa-magnifying-glass"></i>
                          </li>
                      </ul>
                      <form class=" text-white form-inline my-2 my-lg-0">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                          </svg>
                      </form>
                  </div>
              </nav>
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 pt-3">
<!--                  <div class="headinfoholderleft text-black pb-3">-->
                      <?php
                      $title="Easy business department management in proper way";
//                      $title="বাজার গেলাম";
                      $description="Trusted by more than 700k+ happy people all over the world. Empower your business with our awesome plugins.";
                      $buttontext="GET STARTED";
                      $buttonBgColor='button-bg-color-white';
                      $isNeedTotal=0;
                      $htag='h3';
                      $p_tag_color='p-text-size';
                      echo display_title_para_and_btn_html($title,$description,$buttontext,$isNeedTotal,$htag,$p_tag_color,'text-white',$buttonBgColor);?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 pt-3">
<!--                  <div class="headinfoholderright">-->
                      <img alt="group discussion image" class="discussionimg" src="img/discussionimg.jpg">
                  </div>
              </div>

          </div>
        </div>

        <div class="top_container bg-light">
            <div class="contant-container">
                <div class="blogpostholder">

                    <div class="service-section">
                        <div class="row p-5 ">
                            <div class="col-md-5 col-sm-12 pl-0">
                                <div class="row p-0">
                                    <div class="col-6 pl-0 ">
                                        <?php
                                        show_site_activities_info('Customers','200K','custimarcount-bg');
                                        show_site_activities_info('Total Invest','15M','investmentcount-bg');
                                        ?>
                                    </div>
                                    <div class="col-6 pt-5 pl-0">
                                        <?php
                                        show_site_activities_info('Happy Client','90K','happyclientcount-bg');
                                        show_site_activities_info('Project Done','25M','projectdonecount-bg');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <div class="btnholder"><?php echo showBtn('button-bg-color-white','Archive');?></div>
                                <?php
                                $title="Create plan and innovate collaborate";
                                $description="A Great Plugin and good support. Works like a charm with providers in Greece like Skroutz and best-buy. The dev.";
                                $buttontext="ARCHIVE MORE";
                                $isNeedTotal=1;
                                $buttonBgColor='btn-text-color';
                                $htag='h4';
                                $p_tag_color='p-color-gray';
                                echo display_title_para_and_btn_html($title,$description,$buttontext,$isNeedTotal,$htag,$p_tag_color,'text-dark',$buttonBgColor);?>
                            </div>
                        </div>
                    </div>

                    <div class="service-section">
                        <div class="title">
                            <h4 class="titletext">We are fantacy we have got you covered on</h4>
                            <?php echo showBtn('button-bg-color-white','LEARN MORE','btn-text-size');?>
                        </div>
                        <div class="services-holder-box">
                            <div class="row ">
                                <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
<!--                                    <div class="circle circle-bg-green"></div>-->
                                    <i class="bg-success-dim-icon-1 text-white rounded p-2 m-2 fa-1x fa-solid fa-gem"></i>
                                    <h6 class="font-weight-bold">Facility management</h6>
                                    <p class="p-sm-font-size">Trusted by more than 700k+ happmpower your business with our awesome plugins your business with our awesome plugins</p>
                                    <?php
                                        $moreFeatureOptions1=["Knowledge base","Django & djangoCMS","iOS app development"];
                                        moreFeature_option_show($moreFeatureOptions1);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
                                    <i class="bg-success-dim-icon-2 text-white rounded p-2 m-2 fa-1x fa-solid fa-gem"></i>
                                    <h6 class="font-weight-bold">Pixel perfect</h6>
                                    <p class="p-sm-font-size">Your business with our awesome plugins Trusted by more than 700k+ happmpower your business with our awesome plugins</p>
                                    <?php
                                        $moreFeatureOptions2=["Javascript development","Djargo & djargoCMS","Ios app development"];
                                        moreFeature_option_show($moreFeatureOptions2);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
                                    <i class="bg-success-dim-icon-3 text-white rounded p-2 m-2 fa-1x fa-solid fa-gem"></i>
                                    <h6 class="font-weight-bold">Create web solution</h6>
                                    <p class="p-sm-font-size">With our awesome plugins Trusted by more than Trusted by more than 700k+ happmpower your business with our awesome plugins</p>
                                    <?php
                                        $moreFeatureOptions3=["Javascript development","Djargo & djargoCMS","Ios app development"];
                                        moreFeature_option_show($moreFeatureOptions3);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="creatingWorkspace">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <p class="">Creative Agency</p>
                                <?php
                                $title="Easy business department management in proper way";
                                //                      $title="বাজার গেলাম";
                                $description="Over the world Trusted by more all over the world. Empower your than happy people all over the world. Empower your business with our awesome plugins by more than the world. Empower your.";
                                $buttontext="Read Success Story";
                                $buttonBgColor='button-bg-color-parple';
                                $isNeedTotal=0;
                                $htag='h6';
                                $p_tag_color='p-text-size1';
                                echo display_title_para_and_btn_html($title,$description,$buttontext,$isNeedTotal,$htag,$p_tag_color,'text-gray',$buttonBgColor);?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="workplacerightside"><img alt="group workplace image" class="workplaceimg" src="img/workplaceimg.jpg"></div>
                            </div>
                        </div>
                    </div>

                    <div class="creatingWorkspace">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 pt-3">
                                <div class="leftservicesnav">
                                    <p class="text-purple btn-text-size-10" >OUR SERVICES</p>
                                    <h4 class="pb-4">Experience design agency in Kabbo</h4>
                                    <?php echo showBtn('button-bg-color-white','LOAD MORE','btn-text-size-10');?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 pt-3">
                                <div class="ourservices">
                                    <div class="circle circle-bg-pink"></div>
                                    <i class="circle-content-bg text-danger rounded p-2 m-2 fa-1x fa-solid fa-box-tissue"></i>
                                    <h6 class="services-h-tag-position font-weight-bold services-p-text-decoration pt-2">Interface Design</h6>
                                    <p class="btn-text-size-10 services-p-text-decoration">Awesome plugins more than your business with our awesome Trusted by more than your business with our awesome plugin</p>
                                </div>
                                <div class="ourservices">
                                        <div class="circle circle-bg-green"></div>
                                        <i class="circle-content-bg circle-icon-text-green rounded p-2 m-2 fa-1x fa-solid fa-box-tissue"></i>
                                        <h6 class="services-h-tag-position font-weight-bold services-p-text-decoration pt-2">Business Analysis</h6>
                                        <p class="btn-text-size-10 services-p-text-decoration">Business with our awesome plugin Awesome plugins more than your business with our awesome Trusted by more than your </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 pt-3">
                                <div class="ourservices">
                                        <div class="circle circle-bg-pink"></div>
                                        <i class="circle-content-bg text-danger rounded p-2 m-2 fa-1x fa-solid fa-box-tissue"></i>
                                        <h6 class="services-h-tag-position font-weight-bold services-p-text-decoration pt-2">Creative Wen Solution</h6>
                                        <p class="btn-text-size-10 services-p-text-decoration">Trusted by more than your business with our awesome plugin Awesome plugins more than your business with our awesome </p>
                                </div>
                                <div class="ourservices">
                                    <div class="circle circle-bg-gray"></div>
    <!--                                <i class="circle-content-bg text-danger rounded p-2 m-2 fa-1x fa-solid fa-box-tissue"></i>-->
                                    <i class="circle-content-bg circle-icon-text-gray rounded p-2 m-2 fa-1x fa-solid fa-leaf"></i>
                                    <h6 class="services-h-tag-position font-weight-bold services-p-text-decoration pt-2">Design & Development</h6>
                                    <p class="btn-text-size-10 services-p-text-decoration">han your business with our  Trusted by more awesome plugin Awesome plugins more than your business with our awesome </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-0 creatingWorkspace">

                    <div class="service-section">
                        <div class="row">
                    <?php for($i=0;$i<3;$i++){?>
                        <div class="col-lg-4 col-md-4 col-sm-12 pt-3">
                            <div class="pannelmember">
                                <div class="profileimage"></div>
                                <h6 class="text-align-center font-weight-bold btn-text-size pt-2"><?php echo $pannelmember[$i]["name"]?></h6>
                                <p class="text-align-center btn-text-size-10 text-purple"><?php echo $pannelmember[$i]["designation"]?></h6></p>
                            </div>
                        </div>
                    <?php }?>
                </div>
                    </div>

                </div>
                </div>

                <div class="creatingWorkspace">
                    <h2 class="agencytasktexttitle">We have done lot of </br>Agency task</h2>
                    <div class="row">
                        <?php for($i=0;$i<3;$i++){?>
                            <div class="p-2 col-lg-4 col-md-4 col-sm-12 pt-3">
                                <div class="agencytasks rounded"></div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="loadmoreagencytask">
                        <div class="agencytaskmorebtn">Agency More Task</div>
                    </div>

                    <div class="creatingWorkspace">
                            <p class="text-purple text-align-center p-sm-font-size ">TESTIMONIAL</p>
                            <h3 class="text-align-center">What Our Core Client Say?</h3>
                            <div class="testmonial-description-box">
                                <p class="btn-text-size-10 text-align-center font-color-gray testimonial-p">Our opportunity has empowered local national and global brands to go their business and achieve a competitive achievement </p>
                                <h6 class="text-center btn-text-size ont-weight-bold">Mahfuz Riad</h6>
                                <p class="text-purple btn-text-size text-center">UI Designer &CEO</p>
                            </div>
                    </div>

                    <div class="creatingWorkspace">
                        <h2 class="agencytasktexttitle">Our Blog Posts</h2>
                        <div class="blogpostholder">
                            <div class="row">
                            <?php for($i=0;$i<3;$i++){?>
                            <div class="p-2 col-lg-4 col-md-4 col-sm-12 pt-3">
                                <a  href="#">
                                    <div class="blogpostcontainer">
                                        <div class="blogposts">
                                            <div class="blogpostsimg"></div>
                                            <div class="dateholder"><span class="data">24</span> </br>Sep</div>
                                            <div class="blogpostsinfo">
                                                <h6 class="blogpostsinfotitletext font-side-weight">A good content strategy can help can engage your consumer </h6>
                                                <p class="blogpostsinfotitletext btn-text-size-8">Awesome plugin Awesome plugins more than your business with our awesome Trusted .</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php }?>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
        <!--<div class="imgholder">
            <img class="d-block m-auto border mg-fluid rounded-circle" src="img/discussionimg.jpg">
        </div>-->
    </div>

    <div class="footer">
        <?php include 'footer.php';?>
    </div>
    <!-- <script src="css/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

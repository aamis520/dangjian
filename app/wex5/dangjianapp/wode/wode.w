<?xml version="1.0" encoding="utf-8"?>

<div xmlns="http://www.w3.org/1999/xhtml" class="main13" component="$UI/system/components/justep/window/window"
  design="device:mobile;" xid="window">  
  
     <div component="$UI/system/components/justep/model/model" class="body_top" xid="model" style="top:85px;left:10px;height:auto;">
     </div>  
   
     <div component="$UI/system/components/justep/panel/panel" class="panel panel-default x-card x-has-iosstatusbar"
                  xid="panel1" style="background-color:transparent;">
 <!--  底部按钮上边content bgn-->
         <div xid="div28" class="tb-user">
             <div component="$UI/system/components/justep/titleBar/titleBar" class="x-titlebar" xid="titleBar1" style="background-color:#FF0000;"> 
                <div class="x-titlebar-left"><a href="javascript:history.go(-1)" component="$UI/system/components/justep/button/button" class="btn btn-link btn-only-icon" label="button" xid="backBtn" icon="icon-chevron-left" style="float:left;width:26px;">
                     <i xid="i1" class="icon-chevron-left mgl10" style="float:left;"></i>
                     <span xid="span3"></span></a>
                </div> 
                <div class="x-titlebar-title tb-searchBox" xid="div1" bind-click="searchBtnClick"> 
                  </div>  
                <div class="x-titlebar-right reverse" xid="div5"> 
                </div> 
              </div> 
             <div class="top_two bgred" dir="rtl"> 
                  <img bind-attr-src="avatarURL" alt="" xid="image2"></img>
             </div>
             <div class="top_three bgred white fs16" dir="rtl">
                  <p><span bind-text="myName">无名</span></p>
             </div>
             <div class="top_five bgred" dir="rtl"></div>
         </div>
             
         <ul class="list-group" xid="ul1" style="height:250px;"> 
             <a href="../wode/lianxiren/lianxiren.w"> 
             <li class="list-group-item" xid="li1" style="color:#333;">我的联系人
             </li>
             </a>
			           
			 <a href="../wode/qunzu/qunzu.w">  
             <li class="list-group-item" xid="li2" style="color:#333;">我的群组
             </li> 
             </a>
			           
			 <a href="../wode/ziliao/ziliao.w">   
             <li class="list-group-item" xid="li3" style="color:#333;">我的资料
             </li>
             </a>
			           
			 <a href="../wode/shenqing/shenqing.w">  
             <li class="list-group-item" xid="li3" style="color:#333;">我的申请
             </li>
             </a>
			           
			 <a href="../wode/shenpi/shenpi.w">  
             <li class="list-group-item" xid="li3" style="color:#333;">我的审批
             </li>
             </a>
			           
			 <a href="../wode/shoucang/shoucang.w">  
             <li class="list-group-item" xid="li7" style="color:#333;">我的收藏
             </li>
             </a>
         </ul>    
		 <div class="jiange_one" xid="jiange_one">
		 </div> 
		 <ul class="list-group" xid="ul1" style="height:40px;"> 	           
			 <a href="../wode/guanyu/guanyu.w">  
            	 <li class="list-group-item" xid="li7" style="color:#333;">关于
           	     </li>
             </a>
         </ul>    
		 <div class="jiange_one" xid="jiange_one">
		 </div> 
		 <ul class="list-group" xid="ul1" style="height:20px;">
		      <a component="$UI/system/components/justep/button/button" class="btn x-black btn-only-label btn-block"
		        label="退出" xid="exitBtn" onClick="btnExit"> 
		        <i xid="i4"/>  
		        <span xid="span4">退出</span> 
		      </a>  
         </ul>  
   
	</div>  
        	
</div>


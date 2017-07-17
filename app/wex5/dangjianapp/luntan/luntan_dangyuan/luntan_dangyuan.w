<?xml version="1.0" encoding="utf-8"?>

<div xmlns="http://www.w3.org/1999/xhtml" class="main13" component="$UI/system/components/justep/window/window"
  design="device:mobile;" xid="window">  
  <div component="$UI/system/components/justep/panel/panel" class="x-panel x-full"> 
 <!--  底部按钮上边content bgn-->
    <div class="x-panel-content tb-trans"> 
      <div component="$UI/system/components/justep/contents/contents" class="x-contents x-full"
        active="0" xid="contents2" swipe="false" wrap="false" slidable="false"> 
        <div class="x-contents-content x-cards" xid="homeContent">
          <div component="$UI/system/components/justep/panel/panel" class="x-panel x-full x-has-iosstatusbar"> 
            
            <div class="x-panel-top" xid="top1">
            <!-- titlebar bgn-->
              <div component="$UI/system/components/justep/titleBar/titleBar" class="x-titlebar" xid="titleBar1" style="background-color:#FF0000;"> 
                <div class="x-titlebar-left"><a href="../../shouye/shouye.w" component="$UI/system/components/justep/button/button" class="btn btn-link btn-only-icon" label="button" xid="backBtn" icon="icon-chevron-left">
                     <i xid="i1" class="icon-chevron-left mgl10"></i>
                     <span xid="span3"></span></a>
                </div> 
                <div class="x-titlebar-title tb-searchBox" xid="div1" bind-click="searchBtnClick"> 
                  <span><![CDATA[论坛]]></span>  
                </div>  
                <div class="x-titlebar-right reverse" xid="div5"> 
                </div> 
              </div> 
              <div xid="body_two" class="body_two">
			           <a href="../luntan_quan/luntan_quan.w">
			           <div class="body_two_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <p xid="span2" style="color:#333;font-size:16px;line-height:45px;">党建圈</p>
			           </div>
			           </a>
			           
			           <a href="../luntan_dangyuan/luntan_dangyuan.w">
			           <div class="body_two_two"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <p xid="span2" style="color:#FF0000;font-size:16px;line-height:45px;">党员论坛</p>
			           </div>
			           </a>
			           
			           <a href="../luntan_zhengwen/luntan_zhengwen.w">
			           <div class="body_two_three"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <p xid="span2" style="color:#333; font-size:16px; line-height:45px;">征文论坛</p>
			           </div>
			           </a>
			           
			           <a href="../luntan_suiyue/luntan_suiyue.w">
			           <div class="body_two_four"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <p xid="span2" style="color:#333; font-size:16px; line-height:45px;">流金岁月</p>
			           </div>
			           </a>
			           
			   </div>
              <!-- titlebar end -->
            </div>
            
            
			       
            <div class="x-panel-content  x-scroll-view" xid="content3" style="bottom: 0px;"> 
             <!-- 滚动区 -->
              <div class="x-scroll" component="$UI/system/components/justep/scrollView/scrollView"
                xid="scrollView"> 
                
                
                
                <div class="x-content-center x-pull-down container" xid="div16" style="height:95px;"> 
                  <i class="x-pull-down-img glyphicon x-icon-pull-down" xid="i9"/>  
                  <span class="x-pull-down-label" xid="span17">下拉刷新...</span> 
                </div>  
                
                <!-- 内容区 -->
                <div class="dangjianframe" xid="div17"> 
                <!-- banner bgn--> 
                    <div component="$UI/system/components/justep/panel/panel"
                    class="panel panel-default x-card" xid="panel1">
                    </div>  
                  <!-- banner end -->
				  <!-- 页面bgn-->     
			        <div xid="body_three" class="dangjianframe">
			           
			           <div component="$UI/dangjianapp/common/dangjianframe/dangjianframe" class="dangjianframe"/>
			           
			       </div>
			       
			       
			       
			       <!-- 页面end -->              
                  </div>  
                  
                  <!-- 内容区end -->
              </div>

			
               
             <!--  滚动区 end-->
            </div> 
          </div> <!-- ddfad -->
        </div>  
      </div> 
    </div> 
  <!--   底部按钮上边content end -->
    <!-- 底部按钮 bgn-->
         <div class="x-panel-bottom" xid="bottom1" height="55"> 
      <div component="$UI/system/components/justep/button/buttonGroup" class="btn-group btn-group-justified x-card"
        tabbed="true" xid="buttonGroup1" style="height:55px;"> 
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="首页" xid="homeBtn" icon="icon-home" href="../../shouye/shouye.w"> 
          <i xid="i1" class="icon-home icon"/>  
          <span xid="span1">首页</span> 
        </a>  
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="培训" xid="microBtn" icon="icon-document-text" href="../../peixun/peixun.w"> 
          <i xid="i2" class="icon-document-text"/>  
          <span xid="span2">培训</span> 
        </a>  
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top active"
          label="党建圈" xid="microBtn" icon="icon-radio-waves" href="../../luntan/luntan_quan/luntan_quan.w"> 
          <i xid="i2" class="icon-radio-waves icon"/>  
          <span xid="span2">党建圈</span> 
        </a> 
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="通知" xid="foundBtn" icon="icon-email" href="../../tongzhi/tongzhi_huifu/tongzhi_huifu.w"> 
          <i xid="i3" class="icon icon-email"/>  
          <span xid="span3">通知</span> 
        </a>  
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="我的" xid="userBtn" icon="icon-person" href="../../wode/wode.w"> 
          <i xid="i5" class="icon icon-person"/>  
          <span xid="span5">我的</span> 
        </a> 
      </div> 
    </div> 
    <!-- 底部按钮end -->
  </div> 
</div>

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
                  <span><![CDATA[在线学习]]></span>  
                </div>  
                <div class="x-titlebar-right reverse" xid="div5"> 
                </div> 
              </div> 
              <div xid="body_two" class="body_two">
			           <a href="../zaixianxuexi_dangke/zaixianxuexi_dangke.w">
			           <div class="body_two_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <p xid="span2" style="color:#FF0000;font-size:16px;line-height:45px;">党课培训</p>
			           </div>
			           </a>
			           
			           <a href="../zaixianxuexi_rudang/zaixianxuexi_rudang.w">
			           <div class="body_two_two"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <p xid="span2" style="color:#333; font-size:16px; line-height:45px;">入党培训</p>
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
    <!-- 底部按钮end -->
  </div> 
</div>

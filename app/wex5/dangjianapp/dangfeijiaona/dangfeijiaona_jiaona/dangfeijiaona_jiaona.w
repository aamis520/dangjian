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
                <div class="x-titlebar-left"><a href="javascript:history.go(-1)" component="$UI/system/components/justep/button/button" class="btn btn-link btn-only-icon" label="button" xid="backBtn" icon="icon-chevron-left">
                     <i xid="i1" class="icon-chevron-left mgl10"></i>
                     <span xid="span3"></span></a>
                </div> 
                <div class="x-titlebar-title tb-searchBox" xid="div1" bind-click="searchBtnClick"> 
                  <span><![CDATA[党费缴纳]]></span>  
                </div>  
                <div class="x-titlebar-right reverse" xid="div5"> 
                </div> 
              </div> 
              <!-- titlebar end -->
            </div>
            
            <div class="x-panel-content  x-scroll-view" xid="content3" style="bottom: 0px;"> 
             <!-- 滚动区 -->
              <div class="x-scroll" component="$UI/system/components/justep/scrollView/scrollView"
                xid="scrollView" style="background-color:#FFFFFF;"> 
                
                <div class="x-content-center x-pull-down container" xid="div16"> 
                  <i class="x-pull-down-img glyphicon x-icon-pull-down" xid="i9"/>  
                  <span class="x-pull-down-label" xid="span17">下拉刷新...</span> 
                </div>  
                
                <!-- 内容区 -->
                <div class="dangjianframe" xid="div17" align="left"> 
                <!-- banner bgn-->
                  <div component="$UI/system/components/justep/panel/panel"
                    class="panel panel-default x-card" xid="panel1">
                  </div>
                  <div class="body_one" xid="body_one">
                  		<div class="body_two" xid="body_two">
                  			<div xid="body_two_one" class="body_two_one">
                  			</div>
                  			<div xid="body_two_two" class="body_two_two">
				   				<img src="$UI/dangjianapp/dangfeijiaona/dangfeijiaona_jiaona/dangfeijiaona_jiaona_zhifubao/img/zhifubao_logo.png"></img>
				   			</div>
				   			<div xid="body_two_three" class="body_two_three">
				   				<p>支付宝</p>
				   			</div>
                 	    </div>
                 	    
                 	    <div class="body_three" xid="body_three">
                 	    	<div class="body_three_one" xid="body_three_one" style="float:left;">
                 	    	</div>
                 	   		<div class="body_three_two" xid="body_three_two" style="background-color:#B0B0B0;float:left;">
                 	    	</div>
                 	    </div>
                 	    
                 	    <div class="body_four" xid="body_four">
                 	    	<div xid="body_four_one" class="body_four_one">
				   			</div>
				   			<div xid="body_four_two" class="body_four_two">
				   				<img src="$UI/dangjianapp/dangfeijiaona/dangfeijiaona_jiaona/dangfeijiaona_jiaona_weixin/img/weixin_logo.png"></img>
				   			</div>
				   			<div xid="body_four_three" class="body_four_three">
				   				<p>微信</p>
				   			</div>
                 	    </div>
                  </div>
                    
                      
                  
                  
                  <!-- banner end -->
				  <!-- 页面bgn-->     
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

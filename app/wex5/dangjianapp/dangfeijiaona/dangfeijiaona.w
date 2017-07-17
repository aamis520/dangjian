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
                <div class="x-titlebar-left"><a href="../shouye/shouye.w" component="$UI/system/components/justep/button/button" class="btn btn-link btn-only-icon" label="button" xid="backBtn" icon="icon-chevron-left">
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
                xid="scrollView"> 
                
                <div class="x-content-center x-pull-down container" xid="div16"> 
                  <i class="x-pull-down-img glyphicon x-icon-pull-down" xid="i9"/>  
                  <span class="x-pull-down-label" xid="span17">下拉刷新...</span> 
                </div>  
                
                <!-- 内容区 -->
                <div class="dangjianframe" xid="div17" > 
                <!-- banner bgn-->
                  <div component="$UI/system/components/justep/panel/panel"
                    class="panel panel-default x-card" xid="panel1">
                    <div component="$UI/system/components/bootstrap/carousel/carousel"
                      class="x-carousel carousel" xid="carousel1" auto="true" style="height:150px;"> 
                      
                      <div class="x-contents carousel-inner" role="listbox"
                        component="$UI/system/components/justep/contents/contents"
                        active="0" slidable="true" wrap="true" swipe="true" xid="contentsImg" routable="false"> 
                        
                        <div class="x-contents-content" xid="content2">
                          <img  src="$UI/dangjianapp/sanhuiyike/img/98127398123.png" alt="" xid="image13" bind-click="openPageClick"
                            class="tb-img1" pagename="./detail.w" style="height:150px;"/> 
                        </div>
                      </div> 
                    </div> 
                  </div>  
                  <!-- banner end -->
				  <!-- 页面bgn-->     
			       <div xid="body_two" class="body_two">
			           <a href="../dangfeijiaona/dangfeijiaona_guiding/dangfeijiaona_guiding.w">
			           <div class="body_two_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/dangfeijiaona/img/dangfeiguiding.png" alt="" xid="image15"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">党费规定</p>
			           </div>
			           </a>
			           
			           <a href="../dangfeijiaona/dangfeijiaona_xinxi/dangfeijiaona_xinxi.w">
			           <div class="body_two_two"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/dangfeijiaona/img/jiaofeixinxi.png" alt="" xid="image16"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">缴费信息</p>
			           </div>
			           </a>
			           
			           <a href="../dangfeijiaona/dangfeijiaona_jiaona/dangfeijiaona_jiaona.w">
			           <div class="body_two_three"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/dangfeijiaona/img/dangfeijiaona.png" alt="" xid="image17"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">党费缴纳</p>
			           </div>
			           </a>
			       </div>
			       
			       <div class="body_gonggao" style="background-color:#FFFFFF; line-height:40px;">
			            <img src="$UI/dangjianapp/shouye/img/dangqi20px.png" alt="" xid="image7" style="margin:-4px 0 0 8px;" ></img>
			            <span style="font-size:16px;"><b>党费规定</b></span>
			       </div>
			       
			       <div component="$UI/dangjianapp/common/dangjianframe/dangjianframe" class="dangjianframe"/>
			       
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

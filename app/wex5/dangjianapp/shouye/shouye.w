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
            
            <div class="x-panel-content  x-scroll-view" xid="content3" style="bottom: 0px;"> 
             <!-- 滚动区 -->
              <div class="x-scroll" component="$UI/system/components/justep/scrollView/scrollView"
                xid="scrollView"> 
                
                <div class="x-content-center x-pull-down container" xid="div16"> 
                  <i class="x-pull-down-img glyphicon x-icon-pull-down" xid="i9"/>  
                  <span class="x-pull-down-label" xid="span17">下拉刷新...</span> 
                </div>  
                
                <!-- 内容区 -->
                <div class="x-scroll-content" xid="div17"> 
                <!-- banner bgn-->
                  <div component="$UI/system/components/justep/panel/panel"
                    class="panel panel-default x-card" xid="panel1">
                    <div component="$UI/system/components/bootstrap/carousel/carousel"
                      class="x-carousel carousel" xid="carousel1" auto="true" style="height:150px;"> 
                      
                      <div class="x-contents carousel-inner" role="listbox"
                        component="$UI/system/components/justep/contents/contents"
                        active="0" slidable="true" wrap="true" swipe="true" xid="contentsImg" routable="false"> 
                        
                        <div class="x-contents-content" xid="content2">
                          <img  src="$UI/dangjianapp/shouye/img/lunbotu_two.png" alt="" xid="image13" bind-click="openPageClick"
                            class="tb-img1" pagename="./detail.w" style="height:150px;"/> 
                        </div>
                      </div> 
                    </div> 
                  </div>  
                  <!-- banner end -->
				  <!-- 页面bgn-->     
			       <div xid="body_one" class="body_one">
			           <a href="../sanhuiyike/sanhuiyike.w">
			           <div class="body_one_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/sanhuiyike.png" alt="" xid="image7"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">三会一课</p>
			           </div>
			           </a>
			           
			           <a href="../liangxueyizuo/liangxueyizuo.w">
			           <div class="body_one_two"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/liangxueyizuo.png" alt="" xid="image8"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">两学一做</p>
			           </div>
			           </a>
			           
			           <a href="../dangfeijiaona/dangfeijiaona.w">
			           <div class="body_one_three"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/dangfeijiaona.png" alt="" xid="image9"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">党费缴纳</p>
			           </div>
			           </a>
			           
			           <a href="../zaixianxuexi/zaixianxuexi.w">
			           <div class="body_one_four"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/zaixianxuexi.png" alt="" xid="image9"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">在线学习</p>
			           </div>
			           </a>
			       </div>
			       
			       
			       <div class="body_gonggao" style="background-color:#FFFFFF; line-height:40px;">
			            <img src="$UI/dangjianapp/shouye/img/dangqi20px.png" alt="" xid="image7" style="margin:-4px 0 0 8px;" ></img>
			            <span style="font-size:16px;"><b>通知公告</b></span>
			       </div>
			       
			       
			       <div xid="body_gonggao_all" class="body_gonggao_all">
			           <a href="../dangweitongzhi/dangweitongzhi.w">
			           <div class="body_gonggao_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/dangweitongzhi.png" alt="" xid="image7"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">党委通知</p>
			           </div>
			           </a>
			           
			           <a href="../jiweitongzhi/jiweitongzhi.w">
			           <div class="body_gonggao_two"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/jiweitongzhi.png" alt="" xid="image8"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">纪委通知</p>
			           </div>
			           </a>
			           
			           <a href="../zhibutongzhi/zhibutongzhi.w">
			           <div class="body_gonggao_three"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/zhibutongzhi.png" alt="" xid="image9" dir="rtl"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">支部通知</p>
			           </div>
			           </a>
			       </div>
			       
			       
			       <div class="body_zuzhi" style="background-color:#FFFFFF; line-height:40px;">
			            <img src="$UI/dangjianapp/shouye/img/dangqi20px.png" alt="" xid="image7" style="margin:-4px 0 0 8px;" ></img>
			            <span style="font-size:16px;"><b>党员管理</b></span>
			       </div>
			       
			       <div xid="body_zuzhi_top" class="body_zuzhi_top">
			           <a href="../zuzhishenghuo/zuzhishenghuo.w">
			           <div class="body_zuzhi_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/zuzhishenghuo.png" alt="" xid="image15" dir="ltr"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">组织生活</p>
			           </div>
			           </a>
			           
			           <a href="../dangjianxuanchuan/dangjianxuanchuan.w">
			           <div class="body_zuzhi_two"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/dangjianxuanchuan.png" alt="" xid="image16"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">党建宣传</p>
			           </div>
			           </a>
			           
			           <a href="../pinpaidangjian/pinpaidangjian.w">
			           <div class="body_zuzhi_three"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/pinpaidangjian.png" alt="" xid="image17"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">品牌党建</p>
			           </div>
			           </a>
			           
			           <a href="../sixiangjiaoliu/sixiangjiaoliu.w">
			           <div class="body_zuzhi_four"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/sixiangjiaoliu.png" alt="" xid="image17"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">思想交流</p>
			           </div>
			           </a>
			       </div>
			       
			       <div xid="body_zuzhi_bottom" class="body_zuzhi_bottom">
			           <a href="../lianjie/lianjie_yaowen/lianjie_yaowen.w">
			           <div class="body_zuzhi_five"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/lianjiezuofeng.png" alt="" xid="image15"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">廉洁作风</p>
			           </div>
			           </a>
			           
			           <a href="../dangyuanluntan/dangyuanluntan.w">
			           <div class="body_zuzhi_six"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/dangyuanluntan.png" alt="" xid="image16"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">党员论坛</p>
			           </div>
			           </a>
			           
			           <a href="../zhengwenluntan/zhengwenluntan.w">
			           <div class="body_zuzhi_seven"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/zhengwenluntan.png" alt="" xid="image17"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">征文论坛</p>
			           </div>
			           </a>
			           
			           <a href="../lituixiudangyuan/lituixiudangyuan_zhengce/lituixiudangyuan_zhengce.w">
			           <div class="body_zuzhi_eight"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/lituixiudangyuan.png" alt="" xid="image17"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">离退休党员</p>
			           </div>
			           </a>
			       </div>
			       
			       <div class="body_zhengce" style="background-color:#FFFFFF; line-height:40px;">
			            <img src="$UI/dangjianapp/shouye/img/dangqi20px.png" alt="" xid="image7" style="margin:-4px 0 0 8px;" ></img>
			            <span style="font-size:16px;"><b>政策解读</b></span>
			       </div>
			       
			       <div xid="body_zhengce_all" class="body_zhengce_all">
			           <a href="../zhengcejiedu/zhengcejiedu.w">
			           <div class="body_zhengce_one"  style="float:left;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/zhengcejiedu.png" alt="" xid="image10"></img>
			                <p xid="span2" style="color:#333; font-size:16px;">政策解读</p>
			           </div>
			           </a>
			           
			           <a href="../guojiajianchatizhigaige/guojiajianchatizhigaige.w">
			           <div class="body_zhengce_two"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/guojiajianchatizhigaige.png" alt="" xid="image11"></img>
			                <span xid="span2" style="color:#333; font-size:16px; line-height:60px;">国家监察体制改革</span>
			           </div>
			           </a>
			           
			           <a href="../zhongyaohuiyibaogaojiedu/zhongyaohuiyibaogaojiedu.w">
			           <div class="body_zhengce_three"  style="float:right;text-align:center;background-color:#FFFFFF;">
			                <img src="$UI/dangjianapp/shouye/img/zhongyaohuiyibaogaojiedu.png" alt="" xid="image11"></img>
			                <span xid="span2" style="color:#333; font-size:16px; line-height:60px;">重要会议报告解读</span>
			           </div>
			           </a>
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
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top active"
          label="首页" xid="homeBtn" icon="icon-home" target="homeContent" autoLoad="true"> 
          <i xid="i1" class="icon-home icon"/>  
          <span xid="span1">首页</span> 
        </a>  
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="培训" xid="microBtn" icon="icon-document-text" href="../peixun/peixun.w" autoLoad="true"> 
          <i xid="i2" class="icon-document-text"/>  
          <span xid="span2">培训</span> 
        </a>  
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="党建圈" xid="microBtn" icon="icon-radio-waves" href="../luntan/luntan_quan/luntan_quan.w" autoLoad="true"> 
          <i xid="i2" class="icon-radio-waves icon"/>  
          <span xid="span2">党建圈</span> 
        </a> 
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="通知" xid="foundBtn" icon="icon-email" href="../tongzhi/tongzhi_huifu/tongzhi_huifu.w" autoLoad="true"> 
          <i xid="i3" class="icon icon-email"/>  
          <span xid="span3">通知</span> 
        </a>  
        <a component="$UI/system/components/justep/button/button" class="btn btn-link btn-icon-top"
          label="我的" xid="userBtn" icon="icon-person" href="../wode/wode.w" autoLoad="true"> 
          <i xid="i5" class="icon icon-person"/>  
          <span xid="span5">我的</span> 
        </a> 
      </div> 
    </div> 
    <!-- 底部按钮end -->
  </div> 
</div>

<?xml version="1.0" encoding="utf-8"?>

<div xmlns="http://www.w3.org/1999/xhtml" class="main13" component="$UI/system/components/justep/window/window"
  design="device:mobile;" xid="window">  

  <div component="$UI/system/components/justep/model/model" xid="model" style="height:auto;left:13px;top:202px;" onLoad="modelLoad"/>

  <div component="$UI/system/components/justep/data/data" autoLoad="false" xid="userData" idColumn="username" autoNew="true">
  	<column label="username" name="username" type="String" xid="default1"></column>
  	<column label="password" name="password" type="String" xid="default2"></column>
  </div> 
  <span component="$UI/system/components/justep/messageDialog/messageDialog" xid="messageDialog" style="left:9px;top:351px;"></span>
  
  <div component="$UI/system/components/justep/panel/panel" class="x-panel x-full x-card"
    xid="panel2"> 
    <div class="x-panel-top" xid="top1"> 
      <div component="$UI/system/components/justep/titleBar/titleBar" class="x-titlebar center-block"
        xid="titleBar1" title="请您登录"> 
        <div class="x-titlebar-title" xid="div3">请您登录</div>  
      </div> 
    </div>  
    <div class="x-panel-content  x-cards container" xid="content1"> 
      <div xid="div1" class="list-group"> 
        <div class="list-group-item"> 
          <div class="input-group" xid="div7"> 
            <span class="input-group-addon" xid="span2"> 
              <i class="icon-ios7-contact"/> 
            </span>  
            <input component="$UI/system/components/justep/input/input" class="form-control x-inputText" xid="username" 
            	placeHolder="手机号/用户名" bind-ref="userData.ref('username')"/>
          </div> 
        </div>  
        <div class="list-group-item" xid="div6"> 
          <div class="input-group" xid="div8"> 
            <span class="input-group-addon" xid="span3"> 
              <i class="icon-unlocked" xid="i3"/> 
            </span>  
            <input component="$UI/system/components/justep/input/password" class="form-control x-inputText" xid="password" 
            	placeHolder="密码" bind-ref="userData.ref('password')"/>
          </div> 
        </div> 
      </div>  
      <a component="$UI/system/components/justep/button/button" class="btn list-group x-black btn-only-label btn-block"
        label="登录" xid="loginBtn" onClick="btnCheckUserLogin"> 
        <i xid="i4"/>  
        <span xid="span4">登录</span> 
      </a>  
    </div> 
  </div> 
</div>
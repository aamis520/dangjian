<iframe
	id="iframepage" 
	src=<?php echo getwpsearchurl().'&s='.$_GET['s'] ?>
	onreadystatechange="updateFrameHeight()" 
	onload="updateFrameHeight()"
	scrolling=no name="iframepage" frameborder="0" width="100%">
</iframe>

<script type="text/javascript">
		function updateFrameHeight() {
			var ifm= document.getElementById("iframepage");
			var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
			if(ifm != null && subWeb != null) {
				ifm.height = subWeb.body.scrollHeight;
			}
		}

		var ifm= document.getElementById("iframepage");
		if( ifm ) {
			startInit('iframepage', 200);
		}

		var browserVersion = window.navigator.userAgent.toUpperCase();
		var isOpera = browserVersion.indexOf("OPERA") > -1 ? true : false;
		var isFireFox = browserVersion.indexOf("FIREFOX") > -1 ? true : false;
		var isChrome = browserVersion.indexOf("CHROME") > -1 ? true : false;
		var isSafari = browserVersion.indexOf("SAFARI") > -1 ? true : false;
		var isIE = (!!window.ActiveXObject || "ActiveXObject" in window);
		var isIE9More = (! -[1, ] == false);
		function reinitIframe(iframeId, minHeight) {
			try {
				var iframe = document.getElementById(iframeId);
				var bHeight = 0;
				if (isChrome == false && isSafari == false)
					bHeight = iframe.contentWindow.document.body.scrollHeight;

				var dHeight = 0;
				if (isFireFox == true)
					dHeight = iframe.contentWindow.document.documentElement.offsetHeight + 2;
				else if (isIE == false && isOpera == false)
					dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
				else if (isIE == true && isIE9More) {//ie9+
					var heightDeviation = bHeight - eval("window.IE9MoreRealHeight" + iframeId);
					if (heightDeviation == 0) {
						bHeight += 3;
					} else if (heightDeviation != 3) {
						eval("window.IE9MoreRealHeight" + iframeId + "=" + bHeight);
						bHeight += 3;
					}
				}
				else//ie[6-8]、OPERA
					bHeight += 3;

				var height = Math.max(bHeight, dHeight);
				if (height < minHeight) height = minHeight;
				iframe.style.height = height + "px";
			} catch (ex) { }
		}

		function startInit(iframeId, minHeight) {
			eval("window.IE9MoreRealHeight" + iframeId + "=0");
			window.setInterval("reinitIframe('" + iframeId + "'," + minHeight + ")", 100);
		}
</script>
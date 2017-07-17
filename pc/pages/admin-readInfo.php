<?php
	//$ret = mycurl($myglobalconfig->{'wpserver'}."wp-admin/admin-ajax.php?action=mypostsummary);
?>

<div class="row">
	<div class="col-sm-12">
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">文章分类统计</h3>
			</div>
			<div class="panel-body">	
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						var dataSource = [
							{ year: "一月份", sep1: 546, sep2: 332, sep3: 227, sep4: 546, sep5: 1332, sep6: 227, sep7: 46, sep8: 32 },
							{ year: "二月份", sep1: 705, sep2: 417, sep3: 283, sep4: 1546, sep5: 232, sep6: 327, sep7: 246, sep8: 1332 },
							{ year: "三月份", sep1: 856, sep2: 513, sep3: 361, sep4: 346, sep5: 732, sep6: 427, sep7: 346, sep8: 332 },
							{ year: "四月份", sep1: 1294, sep2: 614, sep3: 471, sep4: 646, sep5: 132, sep6: 527, sep7: 546, sep8: 232 },
							{ year: "五月份", sep1: 321, sep2: 721, sep3: 623, sep4: 576, sep5: 1332, sep6: 627, sep7: 646, sep8: 532 },
							{ year: "六月份", sep1: 730, sep2: 1836, sep3: 1297, sep4: 846, sep5: 932, sep6: 727, sep7: 846, sep8: 832 },
							{ year: "七月份", sep1: 728, sep2: 935, sep3: 982, sep4: 646, sep5: 732, sep6: 827, sep7: 1046, sep8: 632 },
							{ year: "八月份", sep1: 721, sep2: 1027, sep3: 1189, sep4: 246, sep5: 832, sep6: 927, sep7: 1446, sep8: 532 },
							{ year: "九月份", sep1: 704, sep2: 1110, sep3: 1416, sep4: 146, sep5: 632, sep6: 1027, sep7: 1546, sep8: 932 },
							{ year: "十月份", sep1: 680, sep2: 1178, sep3: 1665, sep4: 546, sep5: 732, sep6: 1127, sep7: 1846, sep8: 1132 },
							{ year: "十一月份", sep1: 650, sep2: 1231, sep3: 1937, sep4: 446, sep5: 932, sep6: 1227, sep7: 1546, sep8: 1232 },
							{ year: "十二月份", sep1: 650, sep2: 1231, sep3: 1937, sep4: 946, sep5: 899, sep6: 1327, sep7: 1246, sep8: 1532 },
						];
						
						$("#bar-3").dxChart({
							dataSource: dataSource,
							commonSeriesSettings: {
								argumentField: "year"
							},
							series: [
								{ valueField: "sep1", name: "廉洁作风", color: "red" },
								{ valueField: "sep2", name: "两学一做", color: "orange" },
								{ valueField: "sep3", name: "三会一课", color: "yellow" },
								{ valueField: "sep4", name: "通知公告", color: "green" },
								{ valueField: "sep5", name: "组织生活", color: "blue" },
								{ valueField: "sep6", name: "党费缴纳", color: "pink" },
								{ valueField: "sep7", name: "政策解读", color: "lightgreen" },
								{ valueField: "sep8", name: "党建学习", color: "lightblue" }
							],
							argumentAxis:{
								grid:{
									visible: false
								},
								title:"月份"
							},
							tooltip:{
								enabled: true
							},
							title: "2016年文章阅读量统计",
							legend: {
								verticalAlignment: "bottom",
								horizontalAlignment: "center"
							},
							commonPaneSettings: {
								border:{
									visible: true,
									right: false
								}	   
							}
						});
					});
				</script>
				<div id="bar-3" style="height: 1000px; width: 100%;"></div>
			</div>
		</div>
			
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">文章分类统计</h3>
			</div>
			<div class="panel-body">	
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						var dataSource = [
							{ country: "廉洁作风", jan: 6, feb: 38, mar: 36, apr: 36, may: 45,jun:37  },
							{ country: "两学一做", jan: 9, feb: 38, mar: 36, apr: 36, may: 45,jun:37 },
							{ country: "三会一课", jan: 2, feb: 38, mar: 36, apr: 36,  may: 45,jun:37},
							{ country: "通知公告", jan: 5, feb: 38, mar: 36, apr: 36,  may: 45,jun:37},
							{ country: "组织生活", jan: 11, feb: 38, mar: 36, apr: 36,may: 45,jun:37  },
							{ country: "党费缴纳", jan: 12, feb: 38, mar: 36, apr: 36, may: 45,jun:37 },
							{ country: "政策解读", jan: 14, feb: 38, mar: 36, apr: 36, may: 45,jun:37 },
							{ country: "党建学习", jan: 7, feb: 38, mar: 36, apr: 36,  may: 45,jun:37}
						];
						
						$("#bar-5").dxChart({
							rotated: true,
							pointSelectionMode: "multiple",
							dataSource: dataSource,
							commonSeriesSettings: {
								argumentField: "country",
								type: "stackedbar",
								selectionStyle: {
									hatching: {
										direction: "left"
									}
								}
							},
							series: [
								{ valueField: "jan", name: "一月份", color: "green" },
								{ valueField: "feb", name: "二月份", color: "lightblue" },
								{ valueField: "mar", name: "三月份", color: "pink" },
								{ valueField: "apr", name: "四月份", color: "orange" },
								{ valueField: "may", name: "五月份", color: "#9294e5" },
								{ valueField: "jun", name: "六月份", color: "#ddd" },
							],
							title: {
								text: "2016年上半年文章阅读量统计"
							},
							legend: {
								verticalAlignment: "bottom",
								horizontalAlignment: "center"
							},
							pointClick: function(point) {
								point.isSelected() ? point.clearSelection() : point.select();
							}
						});
					});
				</script>
				<div id="bar-5" style="height: 650px; width: 100%;"></div>
			</div>
		</div>
			
	</div>
</div>			
			

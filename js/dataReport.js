/*******数据上报*******/

function dataReport(reportData){
	reportData['appkey'] = 'prms';
	var reportString = JSON.stringify(reportData);
	console.log(reportString);
			
	var url = 'http://hds.fangfangxy.cn/Data/report?data='+encodeURIComponent(reportString);
	$.ajax(url, {  
        data: {},  
        dataType: 'jsonp',  
        crossDomain: true,  
        success: function(data) {			
			
			console.log(data);
		}
	});
}

var reportData = new Object();

reportData['eventName'] = 'page_view';
reportData['params'] = new Object();
reportData['params']['url'] = window.location.href.split("?")[0];
reportData['params']['title'] = document.title;

dataReport(reportData);
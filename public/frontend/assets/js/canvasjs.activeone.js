window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: false,
	animationEnabled: true,
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: 3, name: "Natural", exploded: true },
			{ y: 0, name: "Poaching" },
			{ y: 2, name: "In Fighting" },
			{ y: 34, name: "Others" },
			
		]
	}]
});

chart.render();
}


function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
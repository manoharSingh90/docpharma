    google.charts.load('current', {
        'packages': ['corechart']
    });
			
				////////////////////////////////////////////////
    //////LINE CHART	
    ///////////////////////////////////////////////
  google.charts.setOnLoadCallback(drawTrendlines);

function drawTrendlines() {
 var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          ['4 Sep',  1000],
          ['5 Sep',  1170],
          ['6 Sep',  660],
          ['7 Sep',  990],
          ['8 Sep',  1030],
          ['9 Sep',  710],
          ['10 Sep',  60],

        ]);

    var options = {
        legend: {
            position: 'none'
        },
        backgroundColor: 'none',
								pointSize:8,
        colors: ['#7ecbff'],
        chartArea: {
            top: "2%",
            left: "6%",
            height: "80%",
            width: "92%"
        },
        hAxis: {
            title: '',
            titleTextStyle: {
                color: '#999',
                fontSize: 0,
                italic: false
            },
            gridlines: {
                color: '#ddd',
            },
            textStyle: {
                color: '#999',
                fontSize: 13,
                italic: false
            },
        },
        vAxis: {
            title: 'Quantity Dispensed',
            titleTextStyle: {
									      fontName: 'Roboto',
                color: '#666',
                fontSize: 14,
                italic: false
            },
            gridlines: {
                color: '#ddd',
            },
            textStyle: {
                color: '#999',
                fontSize: 13,
                italic: false
            },
            viewWindow: {
                min: 0,
            },
            minValue: 6
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('linechart_01'));
    chart.draw(data, options);

}




////////////////////////////////////////////////
//////PIE CHART
///////////////////////////////////////////////
google.charts.setOnLoadCallback(drawdistrictChartpie01);

function drawdistrictChartpie01() {
    var data = google.visualization.arrayToDataTable([
        ['Type', 'Percentage'],
        ['Tablets', 33],
        ['Capsules', 30],
        ['Tubes', 20],
        ['Syrups', 10],
        ['Injections', 4],
        ['Others', 3],

    ]);

    var chart = new google.visualization.PieChart(document.getElementById('piechart_01'));

    var options = {
        title: '',
        tooltip: {
            trigger: 'selection',
            textStyle: {
                fontSize: 14
            }
        },
        backgroundColor: 'none',
        legend: 'none',

        colors: ['#002a96', '#004bf6', '#4293ff', '#4563ff', '#2f03ec', '#4192fe'],
        chartArea: {
            top: "10%",
            height: "80%",
            width: "80%"
        }
    };

    chart.draw(data, options);
}
				
				
    
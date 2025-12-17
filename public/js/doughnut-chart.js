/*==== doughnut chart =====*/
var ctx = document.getElementById("doughnut-chart");
Chart.defaults.global.defaultFontFamily = 'Arial';
Chart.defaults.global.defaultFontSize = 14;
Chart.defaults.global.defaultFontStyle = '500';
Chart.defaults.global.defaultFontColor = '#233d63';

// Ganti data sesuai progress: Quiz-Ungu, Schedule-Orange, Lessons-Biru
var chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [ 10, 5, 20 ], // ganti sesuai value PHP jika mau
            backgroundColor: ["#7E3CF9", "#F68A03", "#F25C5C"], 
            hoverBorderWidth: 5,
            hoverBorderColor: "#eee",
            borderWidth: 3
        }],
        labels: [
            "Quiz",
            "Schedule",
            "Lessons"
        ]
    },
    options: {
        responsive: true,
        tooltips: {
            xPadding: 15,
            yPadding: 15,
            backgroundColor: '#2e3d62'
        },
        legend: {
            display: false
        },
        cutoutPercentage: 60,
        plugins: {
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em Arial";
                ctx.textBaseline = "middle";

                // Hitung total dan persentase
                var dataset = chart.data.datasets[0].data;
                var total = dataset.reduce((a,b) => a+b, 0);
                var percentage = total > 0 ? Math.round((dataset[0] + dataset[1] + dataset[2]) / total * 100) : 0;

                var text = percentage + "%",
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;

                ctx.fillStyle = '#233d63';
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }
    }
});

var myLegendContainer = document.getElementById("legend");
// generate HTML legend
myLegendContainer.innerHTML = chart.generateLegend();
// bind onClick event to all LI-tags of the legend
var legendItems = myLegendContainer.getElementsByTagName('li');
for (var i = 0; i < legendItems.length; i += 1) {
    legendItems[i].addEventListener("click", legendClickCallback, false);
}

function legendClickCallback(event) {
    event = event || window.event;

    var target = event.target || event.srcElement;
    while (target.nodeName !== 'LI') {
        target = target.parentElement;
    }
    var parent = target.parentElement;
    var chartId = parseInt(parent.classList[0].split("-")[0], 10);
    var chart = Chart.instances[chartId];
    var index = Array.prototype.slice.call(parent.children).indexOf(target);
    var meta = chart.getDatasetMeta(0);
    var item = meta.data[index];

    if (item.hidden === null || item.hidden === false) {
        item.hidden = true;
        target.classList.add('hidden');
    } else {
        target.classList.remove('hidden');
        item.hidden = null;
    }
    chart.update();
}

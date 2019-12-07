function dataChart(year = 2019)
{
    let data = this.value;
    let time = parseInt($(this).data('id'));
    let url = "/admin/chart";
    $.ajax({
        url: url,
        method: "GET",
        data: {
            year: year
        },
        success: function (response) {

            var objData = {
                type: "column",
                indexLabel: "{y}",
                indexLabelFontStyle: "italic",
                indexLabelBackgroundColor: "LightBlue",
            };
            objData.dataPoints = [
                { label: "Jan", y: Number(response['1']) },
                { label: "Feb", y: Number(response['2']) },
                { label: "Mar", y: Number(response['3']) },
                { label: "Apr", y: Number(response['4']) },
                { label: "May", y: Number(response['5']) },
                { label: "Jun", y: Number(response['6']) },
                { label: "Jul", y: Number(response['7']) },
                { label: "Aug", y: Number(response['8']) },
                { label: "Sep", y: Number(response['9']) },
                { label: "Oct", y: Number(response['10']) },
                { label: "Nov", y: Number(response['11']) },
                { label: "Dec", y: Number(response['12']) }
            ];

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light1", // "light2", "dark1", "dark2"
                animationEnabled: true, // change to true
                title:{
                    text: "Book statistics created"
                }
            });
            chart.options.data = [];
            chart.options.data.push(objData);
            chart.render();
        }
    });
}

window.onload = function () {
    dataChart();
}

$(document).on('change', '.year', function () {
    let year = $(this).val();
    dataChart(year);
});

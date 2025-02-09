define(['local_quickstats/lib/chart.umd'], function(Chart) {
    return {
        init: function (params) {
            const data = JSON.parse(params);
            new Chart(
                document.getElementById('chart'),
                {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.year),
                        datasets: [
                            {
                                label: 'User count by day',
                                data: data.map(row => row.count)
                            }
                        ]
                    }
                }
            );
        }
    };
});

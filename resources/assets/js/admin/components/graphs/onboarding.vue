<template>
    <div id="div-graph-onboarding" style="min-width: 310px; height: 600px; margin: 0 auto"></div>
</template>

<script>
    var oChart = {
        aChartSeries: [],

        drawGraph: function () {

            var options = {
                chart: {
                    type: 'spline',
                    renderTo: 'div-graph-onboarding'
                },
                title: {
                    text: 'Application Registration Performance'
                },
                subtitle: {
                    text: 'weekly statistics of the year'
                },
                xAxis: {
                    title: {
                        text: 'Onboard steps '
                    },
                    type: 'category',
                    labels: {
                        overflow: 'justify'
                    }
                },

                yAxis: {
                    title: {
                        text: 'Retention %'
                    },
                    max: 100,
                    minorGridLineWidth: 0,
                    gridLineWidth: 0,
                    alternateGridColor: null,
                    plotBands: [{
                        from: 0,
                        to: 20,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: '',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {
                        from: 20,
                        to: 40,
                        color: 'rgba(0, 0, 0, 0)',
                        label: {
                            text: '',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {
                        from: 40,
                        to: 60,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: '',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {
                        from: 60,
                        to: 80,
                        color: 'rgba(0, 0, 0, 0)',
                        label: {
                            text: '',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {
                        from: 80,
                        to: 100,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: '',
                            style: {
                                color: '#606060'
                            }
                        }
                    }]
                },
                tooltip: {
                    valueSuffix: ' %'
                },
                plotOptions: {
                    spline: {
                        lineWidth: 4,
                        states: {
                            hover: {
                                lineWidth: 5
                            }
                        },
                        marker: {
                            enabled: false
                        }
                    }
                },
                series: this.aChartSeries,
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            };

            new Highcharts.Chart(options);
        }

    }


    export default {
        mounted() {
            axios.get("/admin/graph/onboarding")
                .then(function (response) {
                        oChart.aChartSeries = response.data;
                        oChart.drawGraph();
                    }
                )
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
</script>
$(function () {
    'use strict'

    $('.connectedSortable').sortable({
        placeholder: 'sort-highlight',
        connectWith: '.connectedSortable',
        handle: '.card-header, .nav-tabs',
        forcePlaceholderSize: true,
        zIndex: 999999
    })
    $('.connectedSortable .card-header').css('cursor', 'move')

    $('#mapa').vectorMap({
        map: 'brazil_br',
        backgroundColor: 'rgba(54, 162, 235, 1)',
        regionStyle: {
            initial: {
                fill: 'rgba(255, 255, 255, 0.7)',
                'fill-opacity': 1,
                stroke: 'rgba(0,0,0,.2)',
                'stroke-width': 1,
                'stroke-opacity': 1
            }
        },
        series: {
            regions: [{
                scale: ['#ffffff', '#0154ad'],
                normalizeFunction: 'polynomial'
            }]
        }
    })

    // gráfico clientes

    var graficoCliente = document.getElementById('grafico-clientes');
    var totalClientsElement = document.getElementById('totalClients');
    var userClientsElement = document.getElementById('userClients');
    var maxValueElement = document.getElementById('maxValue');
    var totalCadastrosSiteElement = document.getElementById('totalCadastrosSite');
    var totalCadastrosUserElement = document.getElementById('totalCadastrosUser');

    if (graficoCliente && totalClientsElement && userClientsElement && maxValueElement && totalCadastrosSiteElement && totalCadastrosUserElement) {
        var totalClients = totalClientsElement.value;
        var userClients = userClientsElement.value;
        var maxValue = maxValueElement.value;
        var totalCadastrosSite = totalCadastrosSiteElement.value;
        var totalCadastrosUser = totalCadastrosUserElement.value;

        var dadosGraficoClientes = {
            labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            datasets: [
                {
                    label: `Total: ${totalCadastrosSite}`,
                    borderColor: "#4A5568",
                    data: JSON.parse(totalClients),
                    fill: false,
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                },
                {
                    label: `Usuário: ${totalCadastrosUser}`,
                    borderColor: "#c90032",
                    data: JSON.parse(userClients),
                    fill: false,
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(201, 0, 50, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(201, 0, 50, 1)'
                },
            ]
        }

        var optionsGraficoClientes = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
            },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: maxValue,
                            stepSize: 1
                        },
                        gridLines: {
                            display: true,
                            color: "rgba(0, 0, 0, 0.05)"
                        },
                    },
                ],
            },
        }

        new Chart(graficoCliente, {
            type: 'line',
            data: dadosGraficoClientes,
            options: optionsGraficoClientes
        })
    }

    // gráfico funcionários

    var graficoFuncionarios = document.getElementById('grafico-funcionarios');
    var atualizadosElement = document.getElementById('atualizados');
    var pendentesElement = document.getElementById('pendentes');
    var progressoElement = document.getElementById('progresso');

    if (graficoFuncionarios && atualizadosElement && pendentesElement && progressoElement) {
        var atualizados = atualizadosElement.value;
        var pendentes = pendentesElement.value;
        var progresso = progressoElement.value;

        var dadosGraficoFuncionarios = {
            labels: [
                'Atualizados',
                'Em Progresso',
                'Pendentes',
            ],
            datasets: [
                {
                    
                    data: [atualizados, progresso, pendentes],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                }
            ]
        }
        var optionsGraficoFuncionarios = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(graficoFuncionarios, {
            type: 'pie',
            data: dadosGraficoFuncionarios,
            options: optionsGraficoFuncionarios
        })
    }
})

$('#calendar').datetimepicker({
    format: 'L',
    inline: true,
    locale: 'pt-br'
})
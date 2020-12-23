// custom.js
/***
René Martinez Araujo
ver 1.3 25 de Mayo 2018 @ift
min version custom.min.js

Aquí estan todas las funciones especiales de la calculadora

***/
/* Variables o arreglos inciales */
var tic, tiempoMenu, dataEstado, dataHogares, dataHabitantes, dataT_telefonia_movil, dataT_banda_ancha_movil, dataP_telefonia_fija, dataP_banda_ancha_fija, dataP_equipos_computo, dataEstadoNac, dataHogaresNac, dataHabitantesNac, dataT_telefonia_movilNac, dataT_banda_ancha_movilNac, dataP_telefonia_fijaNac, dataP_banda_ancha_fijaNac, dataP_equipos_computoNac, TicVal, EdoSelVal, SexSelVal, EdadSelVal, EduSelVal, NivelGeoPerfilSelVal, Grph_edadVals, OcupSelVal, IngresoSelVal, Grph_ingresoVals, Grph_ocupacionVals, Grph_educacionVals, chartOptions, TdemoEdo, TdemoNac, VisitaVal, dataEdades, Ingresos, Ocupacion, Educacion, perfilData, ListaGeo, ListaSex, filtroGeo, numeroValorPerfil, numeroValorMujeres, numeroValorHombres, numeroValorIngresoMenor, numeroValorIngresoMedio, numeroValorIngresoMayor, teclaApretada, BloqueoEdad, BloqueoEducacion, BloqueoOcupacion;
Ingresos = [];
ListaGeo = [];
ListaSex = [];
array_XlsPerfil = [];
array_XlsPoblacion = [];
array_XlsIngreso = [];
array_XlsEducacion = [];
array_XlsOcupacion = [];
array_XlsEdad = [];
array_XlsDemograficos = [];
array_XlsTeledensidades = [];
BloqueoEdad=34;
var Perfilentero=1;
/*Controla el tiempo de despliegue de los menus*/
var menuTime = 400;
/* Funciones */

function introducion(){
	'use strict';
	introJs('.intro').onchange(function(targetElement) {
		//console.log(targetElement.id);
		/*if(targetElement.id==='tics_group'){
			$('.header-bottom').slideUp();
		}*/
    	if(targetElement.id==='uso_computadora'){
			$('#uso_computadora').click();
		}
	}).start();
	introJs.fn.onexit(function() {
  		window.scrollTo(0, 0);
	});
	introJs.fn.oncomplete(function() {
		window.scrollTo(0, 0);
	});
}
function sortProperties(obj) {
    // convert object into array
    var sortable = [];
    for (var key in obj)
        if (obj.hasOwnProperty(key))
            sortable.push([key, obj[key]]); // each item is an array in format [key, value]

    // sort items by value
    sortable.sort(function(a, b) {
        return a[1] - b[1];
    });
    return sortable;
}

function porciento(numero) {
    'use strict';
    numero = numero * 100;
    return numero;
}

function redondeo(numero) {
    'use strict';
    numero = Math.round(numero);
    return numero;
}

function floatCero(numero) {
    'use strict';
    numero = parseFloat(numero).toFixed(0);
    return numero;
}

function floatUno(numero) {
    'use strict';
    numero = parseFloat(numero).toFixed(1);
    return numero;
}

function float(numero) {
    'use strict';
    numero = parseFloat(numero).toFixed(2);
    return numero;
}

var bloqueoMenus=function(){
	'use strict';
	//console.log('Bloqueo edad= '+BloqueoEdad+' Bloqueo eduacacion= '+BloqueoEducacion+' Bloqueo Ocuapacion= '+BloqueoOcupacion);
	$('.submenu-item').removeClass('disiabled');
	if(BloqueoEdad===34){
		$('.submenu-item').eq(44).addClass('disiabled');
		$('.submenu-item').eq(45).addClass('disiabled');
		$('.submenu-item').eq(48).addClass('disiabled');
		$('.submenu-item').eq(49).addClass('disiabled');
	}
	if(BloqueoEdad===35){
		$('.submenu-item').eq(45).addClass('disiabled');
	}
	if(BloqueoEducacion===45){
		$('.submenu-item').eq(34).addClass('disiabled');
		$('.submenu-item').eq(35).addClass('disiabled');
	}
	if(BloqueoEducacion===44){
		$('.submenu-item').eq(34).addClass('disiabled');
	}
	if(BloqueoOcupacion===48 || BloqueoOcupacion===49){
		$('.submenu-item').eq(34).addClass('disiabled');
	}
};

var exportaPDF = function() {
    'use strict';
    array_XlsPerfil = [];
    array_XlsPoblacion = [];
    /*Datos que se exportan al execel del perfil de usuario*/
    array_XlsPerfil[0] = $('#perfil_tt').text();
    array_XlsPerfil[1] = Dir.Estados[EdoSelVal].Nombre;
    var Ngeo = $('#geo-perfil').find('.component-main-text').text();
    Ngeo = Ngeo.replace(/,/g, ":");
    array_XlsPerfil[2] = Ngeo;
    $('.perfil-label-result').each(function() {
        var valor = $(this).text();
        valor = valor.trim();
        if (valor === 'Menos de $12,063.00') {
            valor = "Menos de $12:063.00";
        }
        if (valor === 'Entre $12,063.00 y $23,140.00') {
            valor = "Entre $12:063.00 y $23:140.00";
        }
        if (valor === 'Más de $23,140.00') {
            valor = "Más de $23:140.00";
        }
        array_XlsPerfil.push(valor);
    });
    array_XlsPerfil[8] = numeroValorPerfil;

    var datosPerfil = array_XlsPerfil.toString();

    array_XlsPoblacion[0] = $('#geo-graficas').find('.component-main-text').text();
    array_XlsPoblacion[1] = $('#sex-graficas').find('.component-main-text').text();
    array_XlsPoblacion[2] = numeroValorHombres;
    array_XlsPoblacion[3] = numeroValorMujeres;

    var datosPoblacion = array_XlsPoblacion.toString();
    var datosIngreso = array_XlsIngreso.toString();
    var datosEducacion = array_XlsEducacion.toString();
    var datosOcupacion = array_XlsOcupacion.toString();
    var datosEdad = array_XlsEdad.toString();

    array_XlsDemograficos[0] = TdemoEdo.Habitantes;
    array_XlsDemograficos[1] = TdemoEdo.Hogares;
    array_XlsDemograficos[2] = TdemoNac.Habitantes;
    array_XlsDemograficos[3] = TdemoNac.Hogares;
    var datosDemograficos = array_XlsDemograficos.toString();

    array_XlsTeledensidades[0] = TdemoEdo.P_equipos_computo;
    array_XlsTeledensidades[1] = TdemoEdo.P_banda_ancha_fija;
    array_XlsTeledensidades[2] = TdemoEdo.P_telefonia_fija;
    array_XlsTeledensidades[3] = TdemoEdo.T_banda_ancha_movil;
    array_XlsTeledensidades[4] = TdemoEdo.T_telefonia_movil;

    array_XlsTeledensidades[5] = TdemoNac.P_equipos_computo;
    array_XlsTeledensidades[6] = TdemoNac.P_banda_ancha_fija;
    array_XlsTeledensidades[7] = TdemoNac.P_telefonia_fija;
    array_XlsTeledensidades[8] = TdemoNac.T_banda_ancha_movil;
    array_XlsTeledensidades[9] = TdemoNac.T_telefonia_movil;
    var datosTeledensidad = array_XlsTeledensidades.toString();
    var edoAbr = Dir.Estados[EdoSelVal].Abr;
    var perImg = $('#perfil-result-img').attr('src');
    perImg = perImg.split('/');
    perImg = perImg[1].replace('svg', 'png');
    window.open('php/downloadpdf.php?datosPerfil=' + datosPerfil + '&datosDemograficos=' + datosDemograficos + '&datosTeledensidad=' + datosTeledensidad + '&datosPoblacion=' + datosPoblacion + '&datosIngreso=' + datosIngreso + '&datosEducacion=' + datosEducacion + '&datosOcupacion=' + datosOcupacion + '&datosEdad=' + datosEdad + '&datoEdo=' + edoAbr + '&perImg=' + perImg);

};

/*Mada el php que va exportar el excel*/
var exportaExcel = function() {
    'use strict';
    array_XlsPerfil = [];
    array_XlsPoblacion = [];
    /*Datos que se exportan al execel del perfil de usuario*/
    array_XlsPerfil[0] = $('#perfil_tt').text();
    array_XlsPerfil[1] = Dir.Estados[EdoSelVal].Nombre;
    var Ngeo = $('#geo-perfil').find('.component-main-text').text();
    Ngeo = Ngeo.replace(/,/g, ":");
    array_XlsPerfil[2] = Ngeo;
    $('.perfil-label-result').each(function() {
        var valor = $(this).text();
        valor = valor.trim();
       if (valor === 'Menos de $12,063.00') {
            valor = "Menos de $12:063.00";
        }
        if (valor === 'Entre $12,063.00 y $23,140.00') {
            valor = "Entre $12:063.00 y $23:140.00";
        }
        if (valor === 'Más de $23,140.00') {
            valor = "Más de $23:140.00";
        }
        array_XlsPerfil.push(valor);
    });
    array_XlsPerfil[8] = numeroValorPerfil;
    var datosPerfil = array_XlsPerfil.toString();
    array_XlsPoblacion[0] = $('#geo-graficas').find('.component-main-text').text();
    array_XlsPoblacion[1] = $('#sex-graficas').find('.component-main-text').text();
    array_XlsPoblacion[2] = numeroValorHombres;
    array_XlsPoblacion[3] = numeroValorMujeres;

    var datosPoblacion = array_XlsPoblacion.toString();
    var datosIngreso = array_XlsIngreso.toString();
    var datosEducacion = array_XlsEducacion.toString();
    var datosOcupacion = array_XlsOcupacion.toString();
    var datosEdad = array_XlsEdad.toString();

    array_XlsDemograficos[0] = TdemoEdo.Habitantes;
    array_XlsDemograficos[1] = TdemoEdo.Hogares;
    array_XlsDemograficos[2] = TdemoNac.Habitantes;
    array_XlsDemograficos[3] = TdemoNac.Hogares;
    var datosDemograficos = array_XlsDemograficos.toString();

    array_XlsTeledensidades[0] = TdemoEdo.P_equipos_computo;
    array_XlsTeledensidades[1] = TdemoEdo.P_banda_ancha_fija;
    array_XlsTeledensidades[2] = TdemoEdo.P_telefonia_fija;
    array_XlsTeledensidades[3] = TdemoEdo.T_banda_ancha_movil;
    array_XlsTeledensidades[4] = TdemoEdo.T_telefonia_movil;

    array_XlsTeledensidades[5] = TdemoNac.P_equipos_computo;
    array_XlsTeledensidades[6] = TdemoNac.P_banda_ancha_fija;
    array_XlsTeledensidades[7] = TdemoNac.P_telefonia_fija;
    array_XlsTeledensidades[8] = TdemoNac.T_banda_ancha_movil;
    array_XlsTeledensidades[9] = TdemoNac.T_telefonia_movil;
    var datosTeledensidad = array_XlsTeledensidades.toString();
    $.ajax({
        type: 'POST',
        url: 'php/exporta_excel.php',
        data: {
            'datosPerfil': datosPerfil,
            'datosPoblacion': datosPoblacion,
            'datosIngreso': datosIngreso,
            'datosEducacion': datosEducacion,
            'datosOcupacion': datosOcupacion,
            'datosEdad': datosEdad,
            'datosDemograficos': datosDemograficos,
            'datosTeledensidad': datosTeledensidad
        },
        timeout: 10000,
        beforeSend: function() {},
        success: function(result) {
            var href = window.location.href;
            var dir = href.substring(0, href.lastIndexOf('/')) + "/";
            var file = dir + '/' + result;
            window.location = file;
        },
        error: function() {
            //alert('no');
        }
    });
};
var Resultados_demograficos = function() {
    'use strict';
    /*Resultado Tabla Demográficos Estado*/
    $('.data-cne').text(TdemoEdo.Estado);
	$('.data-cne-geo').text("en "+TdemoEdo.Estado);
    //alert('x');
    $('#geo-perfil').find('.component-main-text').text(Dir.Estados[EdoSelVal].Nivel_geo.Ciudades);

    $('#geo-graficas').find('.component-main-text').text(Dir.Estados[EdoSelVal].Nivel_geo.Estatal);

    if ($('#EdoSelVal').val() === "e09") {
        $('#geo-graficas.geo-component').find('.component-main-text').text(Dir.Estados[EdoSelVal].Nivel_geo.Estatal);
    }

    $('.data-cicon').html(Dir.iconsEdos[EdoSelVal]);
    $('.dataHabitantes').text($.number(TdemoEdo.Habitantes));
    $('.dataHogares').text($.number(TdemoEdo.Hogares));
    $('.P_equipos_computo_EdoRes').text($.number(TdemoEdo.P_equipos_computo));
    $('.P_banda_ancha_fija_EdoRes').text($.number(TdemoEdo.P_banda_ancha_fija));
    $('.P_telefonia_fija_EdoRes').text($.number(TdemoEdo.P_telefonia_fija));
    $('.T_banda_ancha_movil_EdoRes').text($.number(TdemoEdo.T_banda_ancha_movil));
    $('.T_telefonia_movil_EdoRes').text($.number(TdemoEdo.T_telefonia_movil));

    if (VisitaVal === "0") {
        /*Resultado Tabla Demográficos Nacionales*/
        $('.dataHabitantesNac').text($.number(TdemoNac.Habitantes));
        $('.dataHogaresNac').text($.number(TdemoNac.Hogares));
        $('.P_equipos_computo_NacRes').text($.number(TdemoNac.P_equipos_computo));
        $('.P_banda_ancha_fija_NacRes').text($.number(TdemoNac.P_banda_ancha_fija));
        $('.P_telefonia_fija_NacRes').text($.number(TdemoNac.P_telefonia_fija));
        $('.T_banda_ancha_movil_NacRes').text($.number(TdemoNac.T_banda_ancha_movil));
        $('.T_telefonia_movil_NacRes').text($.number(TdemoNac.T_telefonia_movil));
    }

};
var Resultados_sexo = function() {
    'use strict';
   
};
var Resultados_perfil = function() {
    'use strict';
	var restante=Perfilentero-numeroValorPerfil;
	var mainVal=porciento(numeroValorPerfil).toFixed(1);
	var restVal=porciento(restante).toFixed(1);
    require(
        [
            'echarts',
            'echarts/chart/pie',
			'echarts/chart/funnel'
        ],


        // Charts perfil setup
        function(grphPerfil) {
            // Initialize chart
            // ------------------------------
            var myChart = grphPerfil.init(document.getElementById('grphPerfil'));
			 // Top text label
            var labelTop = {
                normal: {
					color: '#447DB1',
                    label: {
                        show: false,
                        position: 'center',
                        textStyle: {
							color: '#000',
                            fontWeight: 200,
                            fontSize: 30
                        }
                    }
                }
            };

            // Format bottom label
            var labelFromatter = {
                normal: {
                    label: {
                        formatter: function (params) {
                            return ((100 -params.value).toFixed(1)) + '%';
                        },
						textStyle: {
                            baseline: 'middle',
                            fontWeight: 400,
                            fontSize: 30,
							color: '#000',
							fontFamily:'Montserrat'
                        }
                    }
                }
            };

            // Bottom text label
            var labelBottom = {
                normal: {
                    color: '#eee',
                    label: {
                        show: true,
                        position: 'center',
                        textStyle: {
                            baseline: 'middle'
                        }
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    color: 'rgba(0,0,0,0)'
                }
            };
			var radius = ['85%', '100%'];

            // Chart Perfil Options
            // ------------------------------
            chartOptions = {
				series: [
                    {
                        type: 'pie',
                        center: ['50%','40%'],
                        radius: radius,
                        itemStyle: labelFromatter,
                        data: [
                            {name: 'Other', value: restVal, itemStyle: labelBottom},
                            {name: 'Perfil', value: mainVal,itemStyle: labelTop}
                        ]
                    }
                ]

            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);
        }
    );
};
var Resultado_Edades = function() {
    'use strict';
    /* Gráfica Edad */
    /*Datos Edad */
    Grph_edadVals = {
        xAxis_data: ['6-12', '13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65 mas'],
        series_data: [dataEdades[0], dataEdades[1], dataEdades[2], dataEdades[3], dataEdades[4], dataEdades[5], dataEdades[6], dataEdades[7]]
    };
    require(
        [
            'echarts',
            'echarts/chart/bar'
        ],


        // Chart Edad setup
        function(grphEdad) {

            // Initialize chart
            // ------------------------------
            var myChart = grphEdad.init(document.getElementById(arr_ContenedoresGraficas[3]));

            // Chart Options
            // ------------------------------
            chartOptions = {
                // Setup grid
                grid: {
                    x: 0,
                    x2: 20,
                    y: '20%',
                    y2: 30,
                    containLabel: true,
                    borderWidth: 'none'
                },
                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    padding: Chart_StyleToolTip.padding,
                    textAlign: 'center',
                    //formatter: 'Rango de edad: {b}<br/>{a}: {c}%',
                    formatter: function(v) {
                        var ttipcons = '<div class="tool-tip-center"> ' + (v[0][1]) + ' años' + '<br>' + (redondeo(porciento(v[0][3])) + '%</div>');
                        return ttipcons;
                    },
                    axisPointer: {
                        type: 'none'
                    },
                    textStyle: {
                        fontFamily: Chart_StyleToolTip.fontFamily,
                        fontSize: Chart_StyleToolTip.fontSize,
                        fontWeight: Chart_StyleToolTip.fontWeight,
                        textAlign: 'center'
                    }
                },



                title: {
                    text: arr_titulosGraficas[3],
                    //subtext: 'Open source information',
                    x: 'left',
                    textStyle: {
                        fontFamily: Chart_StyleTitle.fontFamily,
                        fontSize: Chart_StyleTitle.fontSize,
                        fontWeight: Chart_StyleTitle.fontWeight
                    }
                },


                // Enable drag recalculate
                calculable: false,
                // Add custom colors
                color: [sliceColor.colVal2],
                // Horizontal axis

                xAxis: [{
                    type: 'category',
                    data: Grph_edadVals.xAxis_data,

                    axisTick: {
                        show: true,
                        alignWithLabel: true
                    },
                    splitLine: {
                        show: false
                    },
                    axisLabel: {
                        textStyle: {
                            fontFamily: 'Monserrat',
                            fontSize: 9,
                            fontWeight: 'normal',
                            color: '#000'
                        }
                    },

                }],

                // Vertical axis

                yAxis: [{
                    type: 'value',
                    splitLine: {
                        show: false
                    },
                    splitArea: {
                        show: false
                    }
                }],

                // Add series
                series: [{
                    name: 'porcentaje',
                    type: 'bar',
                    data: Grph_edadVals.series_data,

                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                textStyle: {
                                    fontFamily: 'Monserrat',
                                    fontSize: 10,
                                    fontWeight: 'normal',
                                    color: '#000'
                                },
                                //formatter: '{c}%',
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                }
                            }
                        },
                    }
                }]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);

        }
    );
};
var Resultado_Ingresos = function() {
    'use strict';
    /*Datos ingreso mensual en el hogar*/
    Grph_ingresoVals = {
        dato1: {
            etiqueta: Ingresos[0][0],
            valor: float(Ingresos[0][1]),
            icono: Ingresos[0][2]
        },
        dato2: {
            etiqueta: Ingresos[1][0],
            valor: float(Ingresos[1][1]),
            icono: Ingresos[1][2]
        },
        dato3: {
            etiqueta: Ingresos[2][0],
            valor: float(Ingresos[2][1]),
            icono: Ingresos[2][2]
        }
    };
    /* Gráfica Ingreso */
    require(
        [
            'echarts',
            'echarts/chart/pie'
        ],


        // Charts Ingreso mensual setup
        function(grphIngreso) {
            // Initialize chart
            // ------------------------------
            var myChart = grphIngreso.init(document.getElementById(arr_ContenedoresGraficas[0]));

            // Chart Ingreso mensual Options
            // ------------------------------
            chartOptions = {

                // Add title
                title: {
                    text: arr_titulosGraficas[0],
                    //subtext: 'Open source information',
                    x: 'left',
                    textStyle: {
                        fontFamily: Chart_StyleTitle.fontFamily,
                        fontSize: Chart_StyleTitle.fontSize,
                        fontWeight: Chart_StyleTitle.fontWeight
                    }
                },
                // Add legend
                legend: {
                    orient: 'vertical',
                    x: '45%',
                    y: '15%',
                    itemHeight: 30,
                    itemWidth: 30,
                    itemGap: 10,
                    data: [

                        {
                            name: Grph_ingresoVals.dato1.etiqueta,
                            icon: Grph_ingresoVals.dato1.icono,
                        },
                        {
                            name: Grph_ingresoVals.dato2.etiqueta,
                            icon: Grph_ingresoVals.dato2.icono
                        },
                        {
                            name: Grph_ingresoVals.dato3.etiqueta,
                            icon: Grph_ingresoVals.dato3.icono
                        }
                    ],
                    textStyle: {
                        fontFamily: pieChart_StyleLegend.fontFamily,
                        fontSize: pieChart_StyleLegend.fontSize,
                        fontWeight: pieChart_StyleLegend.fontWeight
                    },
                    selectedMode: false,
                    cursor: 'normal',

                },
                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    padding: Chart_StyleToolTip.padding,
                    formatter: function(c) {
                        var nombreSerie = c.seriesName;
                        var Label = c.name;
                        var valor = redondeo(porciento(c.value));
                        return nombreSerie + '<br>' + Label + ' ' + valor + '%';
                    },
                    textStyle: {
                        fontFamily: Chart_StyleToolTip.fontFamily,
                        fontSize: Chart_StyleToolTip.fontSize,
                        fontWeight: Chart_StyleToolTip.fontWeight
                    }
                },
                // Add custom colors
                color: [sliceColor.colVal1, sliceColor.colVal2, sliceColor.colVal3, sliceColor.colVal4],

                // Enable drag recalculate
                calculable: false,

                // Add series
                series: [{
                    name: arr_titulosGraficas[0],
                    type: pieChart_settings.type,
                    radius: pieChart_settings.radius,
                    center: pieChart_settings.center,
                    selectedMode: pieChart_settings.selectedMode,
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                position: 'inner',
                                // formatter: '{d}%',
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                },
                                textColor: '#000'
                            },

                            borderColor: pieChart_StyleBorderSlice.borderColor,
                            borderWidth: pieChart_StyleBorderSlice.borderWidth,
                            labelLine: {
                                show: false
                            }
                        },
                        emphasis: {
                            label: {
                                show: true,
                                //formatter: '{d}%'
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                }
                            }
                        }
                    },
                    data: [{
                            value: Grph_ingresoVals.dato1.valor,
                            name: Grph_ingresoVals.dato1.etiqueta
                        },
                        {
                            value: Grph_ingresoVals.dato2.valor,
                            name: Grph_ingresoVals.dato2.etiqueta
                        },
                        {
                            value: Grph_ingresoVals.dato3.valor,
                            name: Grph_ingresoVals.dato3.etiqueta
                        }
                    ]
                }]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);


        }

    );
};
var Resultado_Ocupacion = function() {
    'use strict';
    /*Datos Ocupación */
    Grph_ocupacionVals = {
        dato1: {
            etiqueta: Ocupacion[0][0],
            valor: float(Ocupacion[0][1]),
            icono: Ocupacion[0][2]
        },
        dato2: {
            etiqueta: Ocupacion[1][0],
            valor: float(Ocupacion[1][1]),
            icono: Ocupacion[1][2]
        },
        dato3: {
            etiqueta: Ocupacion[2][0],
            valor: float(Ocupacion[2][1]),
            icono: Ocupacion[2][2]
        },
        dato4: {
            etiqueta: Ocupacion[3][0],
            valor: float(Ocupacion[3][1]),
            icono: Ocupacion[3][2]
        }
    };
    /* Gráfica Ocupación */
    require(
        [
            'echarts',
            'echarts/chart/pie'
        ],


        // Chart Ocupacion setup
        function(grphOcupacion) {
            // Initialize chart
            // ------------------------------
            var myChart = grphOcupacion.init(document.getElementById(arr_ContenedoresGraficas[1]));

            // Chart Ocupacion Options
            // ------------------------------
            chartOptions = {

                // Add title
                title: {
                    text: arr_titulosGraficas[1],
                    //subtext: 'Open source information',
                    x: 'left',
                    textStyle: {
                        fontFamily: Chart_StyleTitle.fontFamily,
                        fontSize: Chart_StyleTitle.fontSize,
                        fontWeight: Chart_StyleTitle.fontWeight
                    }
                },
                // Add legend
                legend: {
                    orient: 'vertical',
                    x: '50%',
                    y: '15%',
                    itemHeight: 20,
                    itemWidth: 20,
                    itemGap: 10,
                    data: [{
                            name: Grph_ocupacionVals.dato1.etiqueta,
                            icon: Grph_ocupacionVals.dato1.icono
                        },
                        {
                            name: Grph_ocupacionVals.dato2.etiqueta,
                            icon: Grph_ocupacionVals.dato2.icono
                        },
                        {
                            name: Grph_ocupacionVals.dato3.etiqueta,
                            icon: Grph_ocupacionVals.dato3.icono
                        },
                        {
                            name: Grph_ocupacionVals.dato4.etiqueta,
                            icon: Grph_ocupacionVals.dato4.icono
                        }
                    ],
                    selectedMode: false,
                    cursor: 'normal',
                    textStyle: {
                        fontFamily: pieChart_StyleLegend.fontFamily,
                        fontSize: pieChart_StyleLegend.fontSize,
                        fontWeight: pieChart_StyleLegend.fontWeight
                    },
                },
                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    padding: Chart_StyleToolTip.padding,
                    formatter: function(c) {
                        var nombreSerie = c.seriesName;
                        var Label = c.name;
                        var valor = redondeo(porciento(c.value));
                        return nombreSerie + '<br>' + Label + ' ' + valor + '%';
                    },
                    textStyle: {
                        fontFamily: Chart_StyleToolTip.fontFamily,
                        fontSize: Chart_StyleToolTip.fontSize,
                        fontWeight: Chart_StyleToolTip.fontWeight
                    }
                },


                // Add custom colors
                color: [sliceColor.colVal1, sliceColor.colVal2, sliceColor.colVal3, sliceColor.colVal4],

                // Enable drag recalculate
                calculable: false,

                // Add series
                series: [{
                    name: arr_titulosGraficas[1],
                    type: pieChart_settings.type,
                    radius: pieChart_settings.radius,
                    center: pieChart_settings.center,
                    selectedMode: pieChart_settings.selectedMode,
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                position: 'inner',
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                },

                            },
                            borderColor: pieChart_StyleBorderSlice.borderColor,
                            borderWidth: pieChart_StyleBorderSlice.borderWidth,
                            labelLine: {
                                show: false
                            }
                        },
                        emphasis: {
                            label: {
                                show: true,
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                },

                            }
                        }
                    },
                    data: [{
                            value: Grph_ocupacionVals.dato1.valor,
                            name: Grph_ocupacionVals.dato1.etiqueta
                        },
                        {
                            value: Grph_ocupacionVals.dato2.valor,
                            name: Grph_ocupacionVals.dato2.etiqueta
                        },
                        {
                            value: Grph_ocupacionVals.dato3.valor,
                            name: Grph_ocupacionVals.dato3.etiqueta
                        },
                        {
                            value: Grph_ocupacionVals.dato4.valor,
                            name: Grph_ocupacionVals.dato4.etiqueta
                        }
                    ]
                }]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);


        }

    );
};
var Resultado_Educacion = function() {
    'use strict';
    /*Datos Eduacion */
    Grph_educacionVals = {
        dato1: {
            etiqueta: Educacion[0][0],
            valor: float(Educacion[0][1]),
            icono: Educacion[0][2]
        },
        dato2: {
            etiqueta: Educacion[1][0],
            valor: float(Educacion[1][1]),
            icono: Educacion[1][2]
        },
        dato3: {
            etiqueta: Educacion[2][0],
            valor: float(Educacion[2][1]),
            icono: Educacion[2][2]
        },
        dato4: {
            etiqueta: Educacion[3][0],
            valor: float(Educacion[3][1]),
            icono: Educacion[3][2]
        }
    };
    /* Gráfica Eduacacion */
    require(
        [
            'echarts',
            'echarts/chart/pie'
        ],

        // Chart Eduacacion setup
        function(grphEducacion) {
            // Initialize chart
            // ------------------------------
            var myChart = grphEducacion.init(document.getElementById(arr_ContenedoresGraficas[2]));

            // Chart Ocupacion Options
            // ------------------------------
            chartOptions = {

                // Add title
                title: {
                    text: arr_titulosGraficas[2],
                    //subtext: 'Open source information',
                    x: 'left',
                    textStyle: {
                        fontFamily: Chart_StyleTitle.fontFamily,
                        fontSize: Chart_StyleTitle.fontSize,
                        fontWeight: Chart_StyleTitle.fontWeight
                    }
                },
                // Add legend
                legend: {
                    orient: 'vertical',
                    x: '50%',
                    y: '15%',
                    itemHeight: 20,
                    itemWidth: 20,
                    itemGap: 10,
                    data: [{
                            name: Grph_educacionVals.dato1.etiqueta,
                            icon: Grph_educacionVals.dato1.icono
                        },
                        {
                            name: Grph_educacionVals.dato2.etiqueta,
                            icon: Grph_educacionVals.dato2.icono
                        },
                        {
                            name: Grph_educacionVals.dato3.etiqueta,
                            icon: Grph_educacionVals.dato3.icono
                        },
                        {
                            name: Grph_educacionVals.dato4.etiqueta,
                            icon: Grph_educacionVals.dato4.icono
                        }
                    ],
                    selectedMode: false,
                    cursor: 'normal',
                    textStyle: {
                        fontFamily: pieChart_StyleLegend.fontFamily,
                        fontSize: pieChart_StyleLegend.fontSize,
                        fontWeight: pieChart_StyleLegend.fontWeight
                    },
                },
                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    padding: Chart_StyleToolTip.padding,
                    formatter: function(c) {
                        var nombreSerie = c.seriesName;
                        var Label = c.name;
                        var valor = redondeo(porciento(c.value));
                        return nombreSerie + '<br>' + Label + ' ' + valor + '%';
                    },
                    textStyle: {
                        fontFamily: Chart_StyleToolTip.fontFamily,
                        fontSize: Chart_StyleToolTip.fontSize,
                        fontWeight: Chart_StyleToolTip.fontWeight,
                    }
                },
                // Add custom colors
                color: [sliceColor.colVal1, sliceColor.colVal2, sliceColor.colVal3, sliceColor.colVal4],


                // Enable drag recalculate
                calculable: false,

                // Add series
                series: [{
                    name: arr_titulosGraficas[2],
                    type: pieChart_settings.type,
                    radius: pieChart_settings.radius,
                    center: pieChart_settings.center,
                    selectedMode: 'single',
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                position: 'inner',
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                }
                            },
                            borderColor: pieChart_StyleBorderSlice.borderColor,
                            borderWidth: pieChart_StyleBorderSlice.borderWidth,
                            labelLine: {
                                show: false
                            }
                        },
                        emphasis: {
                            label: {
                                show: true,
                                formatter: function(c) {
                                    return redondeo(porciento(c.value)) + '%';
                                }
                            }
                        }
                    },
                    data: [{
                            value: Grph_educacionVals.dato1.valor,
                            name: Grph_educacionVals.dato1.etiqueta
                        },
                        {
                            value: Grph_educacionVals.dato2.valor,
                            name: Grph_educacionVals.dato2.etiqueta
                        },
                        {
                            value: Grph_educacionVals.dato3.valor,
                            name: Grph_educacionVals.dato3.etiqueta
                        },
                        {
                            value: Grph_educacionVals.dato4.valor,
                            name: Grph_educacionVals.dato4.etiqueta
                        }
                    ]
                }]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);


        }
    );
};

/*ajax ivan parametros change*/
var dataPerfil = function() {
    'use strict';
    var datos = "data=" + perfilData;
	
    $.ajax({
        type: 'POST',
        url: 'php/valor_estadistica.php',
        data: datos,
        timeout: 10000,
        beforeSend: function() {},
        success: function(result) {
            numeroValorPerfil = result;
			//console.log(result);
            
            $('.perfil-perc-text').text(Math.round(porciento(result)) + ' %');
            Resultados_perfil();
        },
        error: function() {
            //alert('no');
        }
    });
};

/* Funcion de Ajax controla los calculos demograficos*/
var dataDemo = function() {
    'use strict';
    $.ajax({
        type: 'POST',
        url: 'data/dataDemo.min.json',
        dataType: "json",
        timeout: 10000,
        beforeSend: function(result) {

        },
        success: function(result) {
            TdemoEdo = result["dataDemo"][EdoSelVal];
            TdemoNac = result["dataDemo"]["e33"];

            Resultados_demograficos();
            if (VisitaVal === "0") {
                tiempoMenu = setTimeout(function() {
                    $('.secundary-nav-bar-submenu').slideUp('slow');
                }, 200);
            }
        },

        error: function() {
            //alert('no');
        }
    });
};

/* Funcion de Ajax controla los calculos de las gráficas*/
var dataGraficas = function() {
    'use strict';
    $.ajax({
        type: 'POST',
        url: 'data/dataGraficas.min.json',
        dataType: "json",
        timeout: 10000,
        beforeSend: function(result) {},
        success: function(result) {
            /*debe recibir los datos filtrado por nivel geográfico y por sexo*/
            result = result.dataGrph;
            var dataEstadisticas = [];
            var dataSexos = [];
            dataEdades = [];
            var dataIngresos = [];
            Ingresos = [];
            var Sexos = [];
            var dataOcupacion = [];
            Ocupacion = [];
            var dataEducacion = [];
            Educacion = [];
            /* Filtra los datos */
            for (var key in result) {
                if (result[key].Llave === filtroGeo) {
                    dataEstadisticas.push(result[key]);
                }
            }

            /* Datos de gráfica de Sexos */
            for (key in dataEstadisticas) {
                dataSexos.push(dataEstadisticas[key].Hombre, dataEstadisticas[key].Mujer);
            }

            numeroValorHombres = dataSexos[0];
            numeroValorMujeres = dataSexos[1];
			
            /* Datos de gráfica de Barras Edades */
            for (key in dataEstadisticas) {
                dataEdades.push(dataEstadisticas[key]["re6-12"], dataEstadisticas[key]["re13-17"], dataEstadisticas[key]["re18-24"], dataEstadisticas[key]["re25-34"], dataEstadisticas[key]["re35-44"], dataEstadisticas[key]["re45-54"], dataEstadisticas[key]["re55-64"], dataEstadisticas[key]["re65+"]);
            }
            array_XlsEdad = [];
            array_XlsEdad.push(dataEdades[0], dataEdades[1], dataEdades[2], dataEdades[3], dataEdades[4], dataEdades[5], dataEdades[6], dataEdades[7]);
            /* Datos de gráfica de Pie Ingresos */
            for (var key in dataEstadisticas) {
                dataIngresos.push(dataEstadisticas[key]["Ingr_Menor"], dataEstadisticas[key]["Ingr_Medio"], dataEstadisticas[key]["Ingr_Superior"]);
            }
            array_XlsIngreso = [];
            numeroValorIngresoMenor = dataIngresos[0];
            numeroValorIngresoMedio = dataIngresos[1];
            numeroValorIngresoMayor = dataIngresos[2];
            array_XlsIngreso.push(numeroValorIngresoMenor, numeroValorIngresoMedio, numeroValorIngresoMayor);
            Ingresos = {
                "Menos de $12,063.00": dataIngresos[0],
                "Entre $12,063.00 y $23,140.00": dataIngresos[1],
                "Más de $23,140.00": dataIngresos[2],
            };
            Ingresos = sortProperties(Ingresos);
            Ingresos = Ingresos.reverse();

            for (key in Ingresos) {
                var IngVal = Ingresos[key][0];
                if (IngVal === "Menos de $12,063.00") {
                    var icono = imagePath + arr_iconoIngresoMenor[key];
                }
                if (IngVal === "Entre $12,063.00 y $23,140.00") {
                    var icono = imagePath + arr_iconoIngresoMedio[key];
                }
                if (IngVal === "Más de $23,140.00") {
                    var icono = imagePath + arr_iconoIngresoMayor[key];
                }
                Ingresos[key].push(icono);
            }

            /* Datos de gráfica de Pie Ocupacion */
            for (var key in dataEstadisticas) {
                dataOcupacion.push(dataEstadisticas[key]["Hogar"], dataEstadisticas[key]["Estudiante"], dataEstadisticas[key]["Trabaja"], dataEstadisticas[key]["No_Trabaja"]);
            }
            array_XlsOcupacion = [];
            array_XlsOcupacion.push(dataOcupacion[0], dataOcupacion[1], dataOcupacion[2], dataOcupacion[3]);
            Ocupacion = {
                "Hogar": dataOcupacion[0],
                "Estudia": dataOcupacion[1],
                "Trabaja": dataOcupacion[2],
                "No trabaja": dataOcupacion[3],
            };

            Ocupacion = sortProperties(Ocupacion);
            Ocupacion = Ocupacion.reverse();

            for (key in Ocupacion) {
                var OcupaVal = Ocupacion[key][0];
                if (OcupaVal === "Hogar") {
                    var icono = imagePath + arr_iconoHogar[key];
                }
                if (OcupaVal === "Estudia") {
                    var icono = imagePath + arr_iconoEstudiante[key];
                }
                if (OcupaVal === "Trabaja") {
                    var icono = imagePath + arr_iconoTrabaja[key];
                }
                if (OcupaVal === "No trabaja") {
                    var icono = imagePath + arr_iconoNoTrabaja[key];
                }

                Ocupacion[key].push(icono);
            }

            /* Datos de gráfica de Pie Educacion */
            for (var key in dataEstadisticas) {
                dataEducacion.push(dataEstadisticas[key]["edu_Ninguno"], dataEstadisticas[key]["edu_Basico"], dataEstadisticas[key]["edu_Medio_Superior"], dataEstadisticas[key]["edu_Superior"]);
            }
            array_XlsEducacion = [];
            array_XlsEducacion.push(dataEducacion[0], dataEducacion[1], dataEducacion[2], dataEducacion[3]);
            Educacion = {
                "Ninguno": dataEducacion[0],
                "Básico": dataEducacion[1],
                "Media superior": dataEducacion[2],
                "Superior": dataEducacion[3]
            };

            Educacion = sortProperties(Educacion);
            Educacion = Educacion.reverse();



            for (key in Educacion) {
                var EduVal = Educacion[key][0];
                if (EduVal === "Ninguno") {
                    var icono = imagePath + arr_iconoEducacionNinguna[key];
                }
                if (EduVal === "Básico") {
                    var icono = imagePath + arr_iconoEducacionBasica[key];
                }
                if (EduVal === "Media superior") {
                    var icono = imagePath + arr_iconoEducacionMediaSuperior[key];
                }
                if (EduVal === "Superior") {
                    var icono = imagePath + arr_iconoEducacionSuperior[key];
                }

                Educacion[key].push(icono);
            }

            Resultados_sexo();
            Resultado_Edades();
            Resultado_Ingresos();
            Resultado_Ocupacion();
            Resultado_Educacion();
        },

        error: function() {
            //alert('no');
        }
    });
};


var convierte = function(lugar) {
    'use strict';
    $('.component-list').hide();
    $('.geo-component-select').removeClass('selected');
	
    TicVal = $('#TicVal').val();
    EdoSelVal = $('#EdoSelVal').val();
    SexSelVal = $('#SexSelVal').val();
    EdadSelVal = $('#EdadSelVal').val();
    EduSelVal = $('#EduSelVal').val();
    OcupSelVal = $('#OcupSelVal').val();
    IngresoSelVal = $('#IngresoSelVal').val();
    NivelGeoPerfilSelVal = $('#NivelGeoPerfilSelVal').val();
	var city=$('#geo-perfil').find('.component-main-text').text();
    VisitaVal = $('#VisitaVal').val();
	
    filtroGeo = Dir.Estados[EdoSelVal].Nombre+'-Ambos-Estatal';
    perfilData = [];
	
    var edoAbr = Dir.Estados[EdoSelVal].Abr;
    perfilData.push(TicVal, edoAbr, SexSelVal, EdadSelVal, EduSelVal, OcupSelVal, IngresoSelVal, NivelGeoPerfilSelVal);
    var s = "";
    var resImgPerf = "";
    var resImgTic = "";
    if (SexSelVal === 'mujeres') {
        s = 'm';
    } else if (SexSelVal === 'hombres') {
        s = 'h';
    }
    resImgPerf = 'svg/perfil-demo-' + s + '-' + EdadSelVal + '.svg';
    resImgTic = 'svg/' + TicVal + '.svg';
    $('#perfil-result-img').attr('src', resImgPerf);
    $('#tic-result-img').attr('src', resImgTic);
    if (lugar === "estado" || lugar === "inicio") {
        dataDemo();
        dataGraficas();
        dataPerfil();
    } else if (lugar === "tic" || lugar === "sexo" || lugar === "edad" || lugar === "educacion" || lugar === "ocupacion" || lugar === "ingreso") {
        dataPerfil();
		//dataGraficas();

    } else if (lugar === "NivelgeoPerfil") {
        dataPerfil();

    } else if (lugar === "nivelGeo" || lugar === "nivelSexo") {
        var nivelGeo = $('#geo-graficas').find('.component-main-text').text();
        var nivelSexo = $('#sex-graficas').find('.component-main-text').text();
        var Estado = Dir.Estados[EdoSelVal].Nombre;
        var CiudadesEstado = Dir.Estados[EdoSelVal].Nivel_geo.Ciudades;
		var filterConstruct;
		
		nivelSexo.trim();
		if(nivelSexo==="Hombre"){
			//alert('y');
			$('#mujer_sex').hide();
			$('#hombre_sex').show();
		}else if(nivelSexo==="Mujer"){
			$('#hombre_sex').hide();
			$('#mujer_sex').show();
		}else{
			$('#hombre_sex').show();
			$('#mujer_sex').show();
		}
		
		if(nivelGeo==="Nacional"){
			$('.data-cne-geo').text("a nivel Nacional");
		}else if(nivelGeo==="Estatal"){
			$('.data-cne-geo').text("en "+Estado);
		}else if(nivelGeo==="Resto de la entidad"){
			$('.data-cne-geo').text("en "+Estado+" , resto de la entidad");
		}else{
			$('.data-cne-geo').text("en "+CiudadesEstado+", "+Estado);
		}
		
        if (nivelGeo !== "Nacional") {
            filterConstruct = Estado + "-" + nivelSexo + "-" + nivelGeo;
        } else if (nivelGeo === "Nacional") {
            filterConstruct = nivelGeo + "-" + nivelSexo;
        }

        filtroGeo = filterConstruct;

        dataGraficas();
    }
	
	bloqueoMenus();
};


$(function() {
    'use strict';
    TicVal = $('#TicVal').val();
    EdoSelVal = $('#EdoSelVal').val();
    SexSelVal = $('#SexSelVal').val();
    EdadSelVal = $('#EdadSelVal').val();
    EduSelVal = $('#EduSelVal').val();
    OcupSelVal = $('#OcupSelVal').val();
    IngresoSelVal = $('#IngresoSelVal').val();
    VisitaVal = $('#VisitaVal').val();
    NivelGeoPerfilSelVal = $('#NivelGeoPerfilSelVal').val();
    perfilData = [];
	$('#myModal').modal('show');
	$('#inicioGuia').click(function(){
		$('#myModal').modal('hide');
		$('#myModal').on('hidden.bs.modal', function () {
			introducion();
		});
	});
    convierte("inicio");
	$(this).keypress(function(e) {
        if (e.which === 32) {
            return false;
        }
    });
    /* seleccion de tic barra principal */
    $('.main-nav-bar-list-item').each(function(i, e) {
        $(this).on('click', function() {
            tic = $(e).attr('name');
            $('.main-nav-bar-list-item').removeClass('selected');
            $(this).toggleClass('selected');
            $('#perfil_tt').text(tic);
            setTimeout(function() {
                $('.header-bottom').slideDown();
            }, menuTime);
            $('#TicVal').val(e.id);
            $('#VisitaVal').val(1);
            if (e.id === 'uso_computadora') {
                $('.tic-perfil-text').text('utilizar computadora');
            }
            if (e.id === 'uso_internet') {
                $('.tic-perfil-text').text('utilizar Internet');
            }
            if (e.id === 'uso_celular') {
                $('.tic-perfil-text').text('utilizar teléfono celular');
            }
            if (e.id === 'internet_smartphone') {
                $('.tic-perfil-text').text('utilizar Internet mediante smartphone');
            }
            if (e.id === 'compras_internet') {
                $('.tic-perfil-text').text('realizar compras por Internet');
            }
            if (e.id === 'pagos_internet') {
                $('.tic-perfil-text').text('realizar pagos por Internet');
            }
            if (e.id === 'banco_internet') {
                $('.tic-perfil-text').text('realizar operaciones bancarias por Internet');
            }
            if (e.id === 'gobierno_internet') {
                $('.tic-perfil-text').text('interactuar con el gobierno por Internet');
            }
            convierte("tic");

        });

        $(this).on('focusin', function() {
            $(this).on('keyup', function(e) {
                var key = e.keyCode ? e.keyCode : e.which;
				var ntabindex = $(this).attr('tabindex');
				//console.log(key);
                if (key === 13 || key === 32) {
					$(this).click();
                }
				if (key === 37) {
                    teclaApretada = 'right';
					//console.log(ntabindex);
					ntabindex--;
					$('li[tabindex='+ntabindex+']').focus();
				}
				if (key === 39) {
                    teclaApretada = 'left';
					//console.log(ntabindex);
					ntabindex++;
					$('li[tabindex='+ntabindex+']').focus();
				}
                if (key >= 65 && key <= 90) {
                    //console.log(String.fromCharCode(codigo));
                }
				
            });
        });
    });

    $('.secondary-nav-bar-list-item').each(function(i, e) {
        $(this).on('click', function() {
            var identify = e.id;
            //alert(identify);
            var submenu = $(this).children('.secundary-nav-bar-submenu');
            //$(submenu).not().eq(i).hide();

            $('.secondary-nav-bar-list-item').removeClass('selected');
            $(this).toggleClass('selected');
            //alert(i);

            $(submenu).not(':eq(' + i + ')').slideUp();
            if ($(submenu).is(':hidden')) {
                $(submenu).slideDown(menuTime);
            } else {

            }
			
            var op;
            var posLeft = $(this).position().left;
            var anchoSub = $(this).children('.secundary-nav-bar-submenu').width();
            var anchoMenu = $(this).width();
            if (identify === 'estado' || identify === 'sexo' || identify === 'edad' || identify === 'educacion') {
                op = ((posLeft) - (anchoSub / 2)) + (anchoMenu / 2);
                $(this).children('.secundary-nav-bar-submenu').css('left', op + 'px');
            } else if (identify === 'ocupacion') {
                op = ((posLeft) - (anchoSub / 2)) + (anchoMenu / 2) - anchoMenu;
                $(this).children('.secundary-nav-bar-submenu').css('left', op + 'px');
            } else if (identify === 'ingreso') {
                op = ((posLeft) - (anchoSub / 2)) + (anchoMenu / 2) - (anchoMenu + 25);
                $(this).children('.secundary-nav-bar-submenu').css('left', op + 'px');
            }

        });
        $(this).on('mouseleave', function() {
            var submenu = $(this).children('.secundary-nav-bar-submenu');
            $(submenu).slideUp(function() {
                $('.secondary-nav-bar-list-item').eq(i).removeClass('selected');
            });
        });

        $(this).on('mouseenter', function() {
            clearTimeout(tiempoMenu);
        });
		$(this).on('focusin', function() {
            $(this).on('keyup', function(e) {
                var key = e.keyCode ? e.keyCode : e.which;
				var ntabindex = $(this).attr('tabindex');
				//console.log(key);
                if (key === 13 || key === 32) {
					$(this).click();
                }
				if (key === 37) {
                    teclaApretada = 'right';
					//console.log(ntabindex);
					ntabindex--;
					$('li[tabindex='+ntabindex+']').focus();
				}
				if (key === 39) {
                    teclaApretada = 'left';
					//console.log(ntabindex);
					ntabindex++;
					$('li[tabindex='+ntabindex+']').focus();
				}
                if (key >= 65 && key <= 90) {
                    //console.log(String.fromCharCode(codigo));
                }
				
            });
        });
    });

    $('.submenu-item').each(function(i, e) {
        $(this).on('click', function() {
            if ($(this).attr('class').indexOf('disiabled') <= 0) {
                var parentMenu = $(this).closest('.secondary-nav-bar-list-item').attr('id');
                var iconSel = $(this).children('.submenu-icon').html();
                var nameSel = $(this).children('.submenu-label').text();
                $(this).closest('.secundary-nav-bar-submenu').children('.submenu-item').removeClass('selected');
                $(this).addClass('selected');
                $(this).closest('.secondary-nav-bar-list-item').addClass('visited');
                var txtValue = $(this).find('.submenu-label').text();
                txtValue = txtValue.toLowerCase();
                if (parentMenu === 'estado') {
                    var edo = e.id;
                    ListaGeo = [];
                    $('#sex-graficas').find('.component-main-text').text("Ambos");
                    $('#EdoSelVal').val(edo);
                }
                if (parentMenu === 'sexo') {
                    var sexo = e.id;

                    if (txtValue === "mujeres") {
                        txtValue = "Mujer";
                    }
                    if (txtValue === "hombres") {
                        txtValue = "Hombre";
                    }
                    $('.perfil-label-result.sexo').text(txtValue);
                    $('#SexSelVal').val(sexo);
                }
                if (parentMenu === 'edad') {
                    $('.perfil-label-result.edad').text(txtValue + " años");
                    var edad = e.id;
                    $('#EdadSelVal').val(edad);
					BloqueoEdad=i;
                }
                if (parentMenu === 'educacion') {
					txtValue=txtValue.trim();
					if(txtValue==='ninguna'){
						txtValue='Ninguna';
					}
					if(txtValue==='básica'){
						txtValue='Básica';
					}
					if(txtValue==='media superior'){
						txtValue='Media superior';
					}
					if(txtValue==='superior'){
						txtValue='Superior';
					}
                    $('.perfil-label-result.educacion').text(txtValue);
                    var educacion = e.id;
					BloqueoEducacion=i;
                    $('#EduSelVal').val(educacion);
                }
                if (parentMenu === 'ocupacion') {
					txtValue=txtValue.trim();
					if(txtValue==='estudia'){
						txtValue='Estudia';
					}
					if(txtValue==='hogar'){
						txtValue='Hogar';
					}
					if(txtValue==='trabaja'){
						txtValue='Trabaja';
					}
					if(txtValue==='no trabaja'){
						txtValue='No trabaja';
					}
                    $('.perfil-label-result.ocupacion').text(txtValue);
                    BloqueoOcupacion=i;
                    var ocupacion = e.id;
                    $('#OcupSelVal').val(ocupacion);
                }
                if (parentMenu === 'ingreso') {
                    var ingreso = e.id;
					txtValue=txtValue.trim();
					if(txtValue==="menor a $12,063.00"){
						txtValue="Menos de $12,063.00";
					}
					if(txtValue==="$12,063.00 y $23,140.00"){
						txtValue="Entre $12,063.00 y $23,140.00";
					}
					if(txtValue==="mayor a $23,140.00"){
						txtValue="Más de $23,140.00";
					}
                    $('.perfil-label-result.ingreso').text(txtValue);
                    $('#IngresoSelVal').val(ingreso);
                }
                $('#VisitaVal').val(1);
                convierte(parentMenu);
				
            } else {
                //Codigo en caso contrario
                
            }
        });
    });

    $('.geo-component-select').each(function(i, e) {
        var identifica = $(this).closest('.geo-component').attr('id');
        var lista = $(this).closest('.geo-component').find('.component-list');
        var mainText = $(this).closest('.geo-component').find('.component-main-text');

        $(this).closest('.geo-component').on('mouseleave', function() {
            $(this).find('.component-list').slideUp();
            $(this).find('.geo-component-select').removeClass('selected');
        });

        $(this).on('click', function() {
            var myedo = $('#EdoSelVal').val();
            var ciudadesVal = Dir.Estados[myedo].Nivel_geo.Ciudades;
            var restoVal = Dir.Estados[myedo].Nivel_geo.Resto;
            var EstatalVal = Dir.Estados[myedo].Nivel_geo.Estatal;
            var NacionalVal = Dir.Estados[myedo].Nivel_geo.Nacional;

            if (identifica === "geo-perfil") {
                if ($(mainText).text() === ciudadesVal) {
                    $(lista).children('.first-item').text(restoVal);
                } else {
                    $(lista).children('.first-item').text(ciudadesVal);
                }
            }

            if (identifica === "geo-perfil" && myedo !== "e09") {
                $('.geo-component-select').removeClass('selected');
                $(this).addClass('selected');
                $(lista).slideToggle(300, function() {
                    if ($(this).is(':hidden')) {
                        $('.geo-component-select').removeClass('selected');
                    }
                });
            }
            if (identifica === "geo-graficas") {

                $('.geo-component-select').removeClass('selected');
                $(this).addClass('selected');

                if (myedo !== "e09") {

                    
                    $(lista).children('.second-item').css('display','block');
					$(lista).children('.third-item').css('display','block');

                    if (ListaGeo.length > 0) {
                        $(lista).children('.first-item').text(ListaGeo[1]);
                        $(lista).children('.second-item').text(ListaGeo[2]);
                        $(lista).children('.third-item').text(ListaGeo[3]);
                    } else {
                        $(lista).children('.first-item').text(restoVal);
                        $(lista).children('.second-item').text(ciudadesVal);
                        $(lista).children('.third-item').text(NacionalVal);
                    }

                } else if (myedo === "e09") {
					$(lista).children('.second-item').css('display','none');
                    $(lista).children('.third-item').css('display','none');

                    if (ListaGeo.length > 0) {
                        $(mainText).text(ListaGeo[0]);
                        $(lista).children('.first-item').text(ListaGeo[1]);
						
                    } else {
                        $(lista).children('.first-item').text(NacionalVal);
                    }
                }
                $(lista).slideToggle(300, function() {
                    if ($(this).is(':hidden')) {
                        $('.geo-component-select').removeClass('selected');
                    }
                });
            }
        });
        $(lista).children('p').on('click', function() {
            var myedo = $('#EdoSelVal').val();
            var ciudadesVal = Dir.Estados[myedo].Nivel_geo.Ciudades;
            var restoVal = Dir.Estados[myedo].Nivel_geo.Resto;
            var EstatalVal = Dir.Estados[myedo].Nivel_geo.Estatal;
            var NacionalVal = Dir.Estados[myedo].Nivel_geo.Nacional;

            if (identifica === "geo-perfil") {
                if ($(this).text() === restoVal) {
                    $(this).text(ciudadesVal);
                    $(mainText).text(restoVal);
                    $('#NivelGeoPerfilSelVal').val(0);
                } else {
                    $(this).text(restoVal);
                    $(mainText).text(ciudadesVal);
                    $('#NivelGeoPerfilSelVal').val(1);
                }

            }
            if (identifica === "geo-graficas") {
                ListaGeo = [];
                var txtSave = $(mainText).text();
                var txtCurrent = $(this).text();
                $(mainText).text(txtCurrent);
                $(this).text(txtSave);
                ListaGeo.push($(mainText).text());
                $(lista).children('p').each(function() {
                    ListaGeo.push($(this).text());
                });
            }
            $('.geo-component-select').removeClass('selected');
            $(lista).slideUp(300, function() {
                if (identifica === "geo-perfil") {
                    convierte("NivelgeoPerfil");
                } else if (identifica === "geo-graficas") {
                    convierte("nivelGeo");
                }
            });
        });
    });

    $('.sex-component-select').on('click', function() {
        ListaSex = [];
        var lista = $(this).closest('.sex-component').find('.component-list');

        $('.sex-component-select').removeClass('selected');
        $(this).addClass('selected');
        $(lista).slideToggle(300, function() {
            if ($(this).is(':hidden')) {
                $('.sex-component-select').removeClass('selected');
            }
        });
    });
    $('.sex-component').on('mouseleave', function() {
        var lista = $(this).closest('.sex-component').find('.component-list');

        $('.sex-component-select').removeClass('selected');
        $(lista).slideUp(300, function() {
            if ($(this).is(':hidden')) {
                $('.sex-component-select').removeClass('selected');
            }
        });
    });
    $('.sex-component').find('.component-list').children('p').each(function() {
        $(this).on('click', function() {
            var lista = $(this).closest('.sex-component').find('.component-list');
            var mainText = $(this).closest('.sex-component').find('.component-main-text');
            ListaSex = [];
            var txtSave = $(mainText).text();
            var txtCurrent = $(this).text();
            $(mainText).text(txtCurrent);
            $(this).text(txtSave);
            ListaSex.push($(mainText).text());
            $(lista).children('p').each(function() {
                ListaSex.push($(this).text());
            });
            $(lista).slideUp(300, function() {
                convierte("nivelSexo");
            });
        });
    });
    /*Botones exportar a excel y pdf*/
    $('.data-excel, .data-pdf').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation;
        var identity = $(this).attr('class');
        if (identity.indexOf('data-excel') > 0) {
            exportaExcel();
        } else if (identity.indexOf('data-pdf') > 0) {
            exportaPDF();
        }
    });
	
    /* Knob graphic settings */
    
    
    $(window).resize(function() {
       
    });
});
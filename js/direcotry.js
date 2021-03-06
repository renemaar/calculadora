// JavaScript Document
var Dir = {
    iconsEdos: {
        "e33": '&#xe828;',
        "e01": '&#xe800;',//AGS
        "e02": '&#xe801;',
        "e03": '&#xe802;',
        "e04": '&#xe803;',
        "e05": '&#xe804;',
        "e07": '&#xe805;',
        "e06": '&#xe805;',
        "e08": '&#xe808;',
        "e09": '&#xe806;',
        "e10": '&#xe809;',
        "e11": '&#xe80a;',
        "e12": '&#xe80b;',
        "e13": '&#xe80c;',
        "e14": '&#xe80d;',
        "e15": '&#xe80e;',
        "e16": '&#xe80f;',
        "e17": '&#xe810;',
        "e18": '&#xe811;',
        "e19": '&#xe812;',
        "e20": '&#xe813;',
        "e21": '&#xe814;',
        "e22": '&#xe815;',
        "e23": '&#xe816;',
        "e24": '&#xe817;',
        "e25": '&#xe818;',
        "e26": '&#xe819;',
        "e27": '&#xe81a;',
        "e28": '&#xe81b;',
        "e29": '&#xe81c;',
        "e30": '&#xe81d;',
        "e31": '&#xe81e;',
        "e32": '&#xe81f;'
    },
    iconsSexo: {
        sexo: '&#xe829;',
        mujer: '&#xe82e;',
        hombre: '&#xe82f;'
    },
	iconsEdad: {
        edad: '&#xe82a;',
        r6_12: '&#xe830;',
        r13_17: '&#xe831;',
		r18_24: '&#xe832;',
		r25_34: '&#xe833;',
		r35_44: '&#xe834;',
		r45_54: '&#xe835;',
		r55_64: '&#xe836;',
		r65mas: '&#xe837;',
    },
	Estados: {
        "e01":{
			"Nombre": 'Aguascalientes',
			"ShortName": 'Aguascalientes',
			"Abr":"AGS",
			"Nivel_geo":{
				"Ciudades":"Aguascalientes",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e02":{
			"Nombre": 'Baja California',
			"ShortName": 'Baja California',
			"Abr":"BC",
			"Nivel_geo":{
				"Ciudades":"Tijuana, Mexicali y Ensenada",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e03":{
			"Nombre": 'Baja California Sur',
			"ShortName": 'Baja California Sur',
			"Abr":"BCS",
			"Nivel_geo":{
				"Ciudades":"La Paz",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e04":{
			"Nombre": 'Campeche',
			"ShortName": 'Campeche',
			"Abr":"CAM",
			"Nivel_geo":{
				"Ciudades":"Campeche",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e05":{
			"Nombre": 'Chiapas',
			"ShortName": 'Chiapas',
			"Abr":"CHIS",
			"Nivel_geo":{
				"Ciudades":"Tuxtla Gutiérrez y Tapachula",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
		"e06":{
			"Nombre": 'Chihuahua',
			"ShortName": 'Chihuahua',
			"Abr":"CHIH",
			"Nivel_geo":{
				"Ciudades":"Chihuahua y Juárez",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
		"e09":{
			"Nombre": 'Ciudad de México',
			"ShortName": 'Ciudad de México',
			"Abr":"CDMX",
			"Nivel_geo":{
				"Ciudades":"CDMX",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e07":{
			"Nombre": 'Coahuila de Zaragoza',
			"ShortName": 'Coahuila',
			"Abr":"COAH",
			"Nivel_geo":{
				"Ciudades":"Torreón y Saltillo",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e08":{
			"Nombre": 'Colima',
			"ShortName": 'Colima',
			"Abr":"COL",
			"Nivel_geo":{
				"Ciudades":"Colima",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e10":{
			"Nombre": 'Durango',
			"ShortName": 'Durango',
			"Abr":"DUR",
			"Nivel_geo":{
				"Ciudades":"Durango",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e11":{
			"Nombre": 'Guanajuato',
			"ShortName": 'Guanajuato',
			"Abr":"GUA",
			"Nivel_geo":{
				"Ciudades":"León, Celaya e Irapuato",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e12":{
			"Nombre": 'Guerrero',
			"ShortName": 'Guerrero',
			"Abr":"GUE",
			"Nivel_geo":{
				"Ciudades":"Acapulco y Chilpancingo",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e13":{
			"Nombre": 'Hidalgo',
			"ShortName": 'Hidalgo',
			"Abr":"HID",
			"Nivel_geo":{
				"Ciudades":"Pachuca",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
		 "e14":{
			"Nombre": 'Jalisco',
			"ShortName": 'Jalisco',
			"Abr":"JAL",
			"Nivel_geo":{
				"Ciudades":"Guadalajara",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e15":{
			"Nombre": 'México',
			"ShortName": 'México',
			"Abr":"MEX",
			"Nivel_geo":{
				"Ciudades":"Toluca",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e16":{
			"Nombre": 'Michoacán de Ocampo',
			"ShortName": 'Michoacán',
			"Abr":"MICH",
			"Nivel_geo":{
				"Ciudades":"Morelia y Uruapan",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e17":{
			"Nombre": 'Morelos',
			"ShortName": 'Morelos',
			"Abr":"MOR",
			"Nivel_geo":{
				"Ciudades":"Cuernavaca",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e18":{
			"Nombre": 'Nayarit',
			"ShortName": 'Nayarit',
			"Abr":"NAY",
			"Nivel_geo":{
				"Ciudades":"Tepic",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e19":{
			"Nombre": 'Nuevo León',
			"ShortName": 'Nuevo León',
			"Abr":"NLE",
			"Nivel_geo":{
				"Ciudades":"Monterrey",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e20":{
			"Nombre": 'Oaxaca',
			"ShortName": 'Oaxaca',
			"Abr":"OAX",
			"Nivel_geo":{
				"Ciudades":"Oaxaca",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e21":{
			"Nombre": 'Puebla',
			"ShortName": 'Puebla',
			"Abr":"PUE",
			"Nivel_geo":{
				"Ciudades":"Puebla y Tehuacán",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e22":{
			"Nombre": 'Querétaro',
			"ShortName": 'Querétaro',
			"Abr":"QRO",
			"Nivel_geo":{
				"Ciudades":"Querétaro",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e23":{
			"Nombre": 'Quintana Roo',
			"ShortName": 'Quintana Roo',
			"Abr":"QROO",
			"Nivel_geo":{
				"Ciudades":"Cancún",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e24":{
			"Nombre": 'San Luis Potosí',
			"ShortName": 'San Luis Potosí',
			"Abr":"SL",
			"Nivel_geo":{
				"Ciudades":"San Luis Potosí",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e25":{
			"Nombre": 'Sinaloa',
			"ShortName": 'Sinaloa',
			"Abr":"SIN",
			"Nivel_geo":{
				"Ciudades":"Culiacán Rosales y Mazatlán",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e26":{
			"Nombre": 'Sonora',
			"ShortName": 'Sonora',
			"Abr":"SON",
			"Nivel_geo":{
				"Ciudades":"Hermosillo y Ciudad Obregón",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		}, 
        "e27":{
			"Nombre": 'Tabasco',
			"ShortName": 'Tabasco',
			"Abr":"TAB",
			"Nivel_geo":{
				"Ciudades":"Villahermosa",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e28":{
			"Nombre": 'Tamaulipas',
			"ShortName": 'Tamaulipas',
			"Abr":"TAM",
			"Nivel_geo":{
				"Ciudades":"Tampico, Matamoros, Nuevo Laredo y Reynosa",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e29":{
			"Nombre": 'Tlaxcala',
			"ShortName": 'Tlaxcala',
			"Abr":"TLAX",
			"Nivel_geo":{
				"Ciudades":"Tlaxcala",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e30":{
			"Nombre": 'Veracruz de Ignacio de la Llave',
			"ShortName": 'Veracruz',
			"Abr":"VER",
			"Nivel_geo":{
				"Ciudades":"Veracruz, Coatzacoalcos y Xalapa",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e31":{
			"Nombre": 'Yucatán',
			"ShortName": 'Yucatán',
			"Abr":"YU",
			"Nivel_geo":{
				"Ciudades":"Mérida",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e32":{
			"Nombre": 'Zacatecas',
			"ShortName": 'Zacatecas',
			"Abr":"ZAC",
			"Nivel_geo":{
				"Ciudades":"Zacatecas",
				"Resto":"Resto de la entidad",
				"Estatal":"Estatal",
				"Nacional":"Nacional"
			},
		},
        "e33": 'Nacional'
    },
};

/* Es el id de los div contenedores en el archivo html*/
var arr_ContenedoresGraficas = ['grph-Ingreso', 'grph-Ocupacion', 'grph-Educacion', 'grph-Edad'];
/* Arreglo de los Titulos de las gráficas*/
var arr_titulosGraficas = ['Ingreso mensual en el hogar', 'Ocupación', 'Nivel educativo', 'Edad'];

/* El estilo general para los titulos de las gáficas*/
var Chart_StyleTitle = {
    fontFamily: 'Raleway',
    fontSize: 16,
    fontWeight: 'normal',
    fullStyleTitle: function() {
        //return 'fontFamily: '+this.fontFamily+', fontSize: '+this.fontSize+', fontWeight: '+this.fontWeight;
    }
};
//var titleStyle=Chart_StyleTitle.fullStyleTitle();

/* El estilo de las leyendas en las gráficas de pie exlusivamente*/
var pieChart_StyleLegend = {
    fontFamily: 'Raleway',
    fontSize: 10,
    fontWeight: 'normal'
};

var pieChart_settings={
	type: 'pie',
	radius: '70%',
	center: ['20%', '50%'],
	selectedMode: 'single',
};

/* El estilo general para los toolTips de las gáficas*/
var Chart_StyleToolTip = {
    fontFamily: 'Moserrat',
	fontSize: 12,
	fontWeight: 'normal',
	padding:4
};
/* El estilo de el borde en las gráficas de pie exlusivamente*/
var pieChart_StyleBorderSlice = {
    borderColor: '#fff',
    borderWidth: 2
};

/* Arreglo de los colores de las rebanadas en las gráficas de pie*/
var sliceColor = {
    colVal1: '#548235',
    colVal2: '#2e75b6',
    colVal3: '#E66F43',
    colVal4: '#EFCD06'
};
/*var sliceColor = {
    colVal1: '#548235',
    colVal2: '#2e75b6',
    colVal3: '#9dc3e6',
    colVal4: '#a9d18e'
};*/
/*Datos ingreso mensual en el hogar*/
var Grph_ingresoVals = {
    dato1: {
        etiqueta: 'Menos de $12,063.00',
        valor: 38900,
        icono: imagePath + arr_iconoIngresoMenor[0]
    },
    dato2: {
        etiqueta: 'Entre $12,063.00 y $23,140.00',
        valor: 24300,
        icono: imagePath + arr_iconoIngresoMedio[1]
    },
    dato3: {
        etiqueta: 'Más de $23,140.00',
        valor: 1500,
        icono: imagePath + arr_iconoIngresoMayor[2]
    }
};

/*Datos Ocupación */
var Grph_ocupacionVals = {
    dato1: {
        etiqueta: 'Estudiante',
        valor: 2000,
        icono: imagePath + arr_iconoEstudiante[0]
    },
    dato2: {
        etiqueta: 'Hogar',
        valor: 1000,
        icono: imagePath + arr_iconoHogar[1]
    },
    dato3: {
        etiqueta: 'Trabaja',
        valor: 1500,
        icono: imagePath + arr_iconoTrabaja[2]
    },
    dato4: {
        etiqueta: 'No trabaja',
        valor: 1000,
        icono: imagePath + arr_iconoNoTrabaja[3]
    }
};

/*Datos Eduacion */
var Grph_educacionVals = {
    dato1: {
        etiqueta: 'Ninguno',
        valor: 300,
        icono: imagePath + arr_iconoEducacionNinguna[0]
    },
    dato2: {
        etiqueta: 'Básico',
        valor: 200,
        icono: imagePath + arr_iconoEducacionBasica[1]
    },
    dato3: {
        etiqueta: 'Media Superior',
        valor: 100,
        icono: imagePath + arr_iconoEducacionMediaSuperior[2]
    },
    dato4: {
        etiqueta: 'Superior',
        valor: 50,
        icono: imagePath + arr_iconoEducacionSuperior[3]
    }
};



  // Set paths
    // ------------------------------
    require.config({
        paths: {
            echarts: 'js/echarts'
        }
    });
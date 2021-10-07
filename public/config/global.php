<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables
    |--------------------------------------------------------------------------
    |
    | This is a set of variables that are made specific to this application
    | that are better placed here rather than in .env file.
    | Use config('your_key') to get the values.
    |
    */

    'IP' => 'http://178.128.144.208:9091/',
    'paginacion' =>8,
    'dpto'=>7,
    'tipoescenario'=>15,
    'paginacion_movil' =>4,
    'posiciones'=>20,
    'conjunto'=>[123,117],
    'eventoapp'=>[43],
    'noconjunto'=>[54,12,11,8,13,48,3,50,18,19,20,21],
    'fase' =>'clasificatoria', // solo para  ver fase de grupos
    'departamento'=>'A.4 Residencia/DirecciÃ³n',  //campos dinamico de campo_deportista, campos
    'departamento1'=>'Nivel Estudio',
    'parametrofecha'=>'Fecha Nacimiento', // nombre de fecha de nacimiento  para parse int  to data
];

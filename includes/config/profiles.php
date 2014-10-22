<?php

// PERFILES
$PROFILES = array(
    "anonimo",
    "staff_administrador",
    "staff_teco",
    "coordinador_staff_teco",
    "supervisor_teco",
    "gerente_staff_teco",
    "system",
    "supervisor_cc3",
    "agente_tp", //8
    "comisiones_tp"); //9
//Accesos por perfil


$access = array(
    // id - clase - funcion - descripcion
    //0
    array(0,"PAGE", "index", "Pagina inicial"),
    array(1,"PAGE","listins", "Administracion de Listines"),
    array(2,"LISTIN", "insert", "Alta listin"),
    array(3,"LISTIN","LISTIN", "listABM", "Lista de listines"),
    array(4,"LISTIN","delete", "Listin delete"),
    array(5,"LISTIN","update", "Listin update"),
    array(6,"LISTIN","listinSelect", "Listin select"),

    array(7,"PAGE", "division", "Administracion de Direcciones"),
    array(8,"DIVISION","insert", "Alta Direcciones"),
    array(9,"DIVISION","listABM", "Lista de Direcciones"),
    array(10,"DIVISION","delete", "Direcciones delete"),
    array(11,"DIVISION","update", "Direcciones update"),
    array(12,"DIVISION","divisionsSelect", "Direcciones select"),

    array(13,"PAGE", "teams", "Administracion de Equipos"),
    array(14,"TEAM","insert", "Equipo insert"),
    array(15,"TEAM","listABM", "Lista de Equipos"),
    array(16,"TEAM","delete", "Equipo delete"),
    array(17,"TEAM","update", "Equipo update"),
    array(18,"TEAM","teams_typeSelect", "Team select"),

    array(19,"PAGE", "users", "Administracion de Usuarios"),
    array(20,"USER","insert", "Usuario insert"),
    array(21,"USER","listABM", "Lista de usuarios"),
    array(22,"USER","delete", "Usuario delete"),
    array(23,"USER","update", "Usuario update"),
    array(24,"USER","ucontact_Update", "Actualizar datos de contacto"),

    array(25,"PAGE","systems", "Administracion de Sistemas"),
    array(26,"SYSTEM","insert", "Sistema insert"),
    array(27,"SYSTEM","listABM", "Lista de sistemas"),
    array(28,"SYSTEM","delete", "Sistema delete"),
    array(29,"SYSTEM","update", "Sistema update"),
    
    array(30,"PAGE","newtkt", "Nuevo TKT"),
    array(31,"TREE","get_open", "TREE get"),
    array(32,"ACTION","ejecute_action", "Ejecutar accion TKT"),
    array(33,"PAGE","staffhome", "Home Staff"),
    array(34,"USER","user_teamsSelect", "Equipos de usuario"),
    array(35,"TKT","listToTeam", "Lista de tkts filtrada"),
    array(36,"TKT","getH", "Detalle del ticket"),
    array(37,"TREE","getSimilars", "TKT similares"),
    array(38,"TKT","listChilds", "TKT childs"),
    array(39,"PAGE","mytkts", "Mis Tickets"),
    array(40,"TKT","listMy", "Lista mistkts"),
    array(41,"TEAM","teams_usersSelect", "Usuarios de equipo"),
    array(42,"TREE","designer", "Arbol preguntas"),
    array(43,"TKT","listMyClosed","Lista de cerrados propios"),
    array(44,"PAGE","actionhelp", "Ayuda Acciones"),
    
    array(45,"TKT_EXT","getStatus","Consulta BIT"),

    array(46,"TKT","listFromTeam", "Lista tkts equipo"),
    
    array(47,"PAGE","reports", "Reportes"),
    array(48,"TREE","get_filter", "Arbol para filtros"),
     
    
);


/**
 * Relaciones
 */
$relations = array(
    // titulo costo_calculo
    array('tomado_por_usuario',1),
    array('tomado_por_otro_usuario',1),
    array('sin_tomar',0),
    array('en_equipo',2),
    array('generado_por_usuario',1),
    array('generado_por_equipo_de_usuario',2),
    array('equipo_visible',4),
    array('derivado',3),
    array('master_de_tkt_usr',3),
    array('master_de_tkt_equipo',4),
    array('similar_a_uno_del_usr',5),
    array('similar_a_uno_del_equipo',6)
);

?>
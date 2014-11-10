<?php


$access = array(
    // id - clase - funcion - descripcion
    //0
    array(0,"PAGE", "index", "Pagina inicial"),
    array(1,"PAGE","listins", "Administracion de Listines"),
    array(2,"LISTIN", "insert", "Alta listin"),
    array(3,"LISTIN","list",  "Lista de listines"),
    array(4,"LISTIN","delete", "Listin delete"),
    array(5,"LISTIN","update", "Listin update"),
    array(6,"LISTIN","idsel_list", "Listin select"),

    array(7,"PAGE", "divisions", "Administracion de Direcciones"),
    array(8,"DIVISION","insert", "Alta Direcciones"),
    array(9,"DIVISION","list", "Lista de Direcciones"),
    array(10,"DIVISION","delete", "Direcciones delete"),
    array(11,"DIVISION","update", "Direcciones update"),
    array(12,"DIVISION","idsel_list", "Direcciones select"),

    array(13,"PAGE", "teams", "Administracion de Equipos"),
    array(14,"TEAM","insert", "Equipo insert"),
    array(15,"TEAM","list", "Lista de Equipos"),
    array(16,"TEAM","delete", "Equipo delete"),
    array(17,"TEAM","update", "Equipo update"),
    array(18,"TEAM","idsel_listall", "Team select full admin"),

    array(19,"PAGE", "users", "Administracion de Usuarios"),
    array(20,"USER","insert", "Usuario insert"),
    array(21,"USER","list", "Lista de usuarios"),
    array(22,"USER","delete", "Usuario delete"),
    array(23,"USER","update", "Usuario update"),
    array(24,"USER","ucontact_Update", "Actualizar datos de contacto"),

    array(25,"PAGE","systems", "Administracion de Sistemas"),
    array(26,"SYSTEM","insert", "Sistema insert"),
    array(27,"SYSTEM","list", "Lista de sistemas"),
    array(28,"SYSTEM","delete", "Sistema delete"),
    array(29,"SYSTEM","update", "Sistema update"),
    
    array(30,"PAGE","newtkt", "Nuevo"),
    
    array(31,"TKT","get_tree_options", "Opciones del arbol e historicas"),
    
    array(32,"ACTION","ejecute_action", "Ejecutar accion TKT"),
    
    array(33,"PAGE","staffhome", "Inbox"),
    
    array(34,"USER","user_teamsSelect", "Equipos de usuario"),
    
    array(35,"TKT","listToTeam", "Lista de tkts filtrada"),
    array(36,"TKT","getH", "Detalle del ticket"),
    array(37,"TREE","getSimilars", "TKT similares"),
    array(38,"TKT","listChilds", "TKT childs"),
    array(39,"PAGE","mytkts", "Generados"),
    array(40,"TKT","listMy", "Lista mistkts"),
    array(41,"TEAM","teams_usersSelect", "Usuarios de equipo"),
    array(42,"TREE","designer", "Arbol preguntas"),
    array(43,"TKT","listMyClosed","Lista de cerrados propios"),
    array(44,"PAGE","actionhelp", "Ayuda Acciones"),
    
    array(45,"TKT_EXT","getStatus","Consulta BIT"),

    array(46,"TKT","listFromTeam", "Lista tkts equipo"),
    
    array(47,"PAGE","reports", "Reportes"),
    array(48,"TREE","get_filter", "Arbol para filtros"),
    
    array(49,"USER","idsel_domains","Lista de dominios validos"),
    array(50,"USER","idsel_myadmteams","Lista de equipos que administra"),
    array(51,"USER","idsel_profiles","Lista de perfiles validos"),
    
    array(52,"INSTANCE","idsel_listfronts","Lista de fronts validos")
     
    
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

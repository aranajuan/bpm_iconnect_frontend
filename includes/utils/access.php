<?php


$access = array(
    // id - clase - funcion - descripcion
    //0
    array(0,"PAGE", "index", "Inicio"),
    array(1,"PAGE","listins", "Admin_Listines"),
    array(2,"LISTIN", "insert", "Alta listin"),
    array(3,"LISTIN","lister",  "Lista de listines"),
    array(4,"LISTIN","delete", "Listin delete"),
    array(5,"LISTIN","update", "Listin update"),
    array(6,"LISTIN","idsel_list", "Listin select"),

    array(7,"PAGE", "divisions", "Admin_Direcciones"),
    array(8,"DIVISION","insert", "Alta Direcciones"),
    array(9,"DIVISION","lister", "Lista de Direcciones"),
    array(10,"DIVISION","delete", "Direcciones delete"),
    array(11,"DIVISION","update", "Direcciones update"),
    array(12,"DIVISION","idsel_list", "Direcciones select"),

    array(13,"PAGE", "teams", "Admin_Equipos"),
    array(14,"TEAM","insert", "Equipo insert"),
    array(15,"TEAM","lister", "Lista de Equipos"),
    array(16,"TEAM","delete", "Equipo delete"),
    array(17,"TEAM","update", "Equipo update"),
    array(18,"TEAM","idsel_listall", "Team select full admin"),

    array(19,"PAGE", "users", "Admin_Usuarios"),
    array(20,"USER","insert", "Usuario insert"),
    array(21,"USER","lister", "Lista de usuarios"),
    array(22,"USER","delete", "Usuario delete"),
    array(23,"USER","update", "Usuario update"),
    array(24,"USER","ucontact_Update", "Actualizar datos de contacto"), // pendiente

    array(25,"PAGE","systems", "Admin_Sistemas"),
    array(26,"SYSTEM","insert", "Sistema insert"),
    array(27,"SYSTEM","lister", "Lista de sistemas"),
    array(28,"SYSTEM","delete", "Sistema delete"),//usado
    array(29,"SYSTEM","update", "Sistema update"),//usado
    
    array(30,"PAGE","newtkt", "Nuevo"), //usado
    
    array(31,"TKT","get_tree_options", "Opciones del arbol e historicas"), //usado
    
    array(32,"ACTION","ejecute", "Ejecutar accion TKT"), //usado
    
    array(33,"PAGE","staffhome", "Inbox"), //usado
    
    array(34,"USER","idsel_listteams", "Equipos de usuario"), //usado
    
    array(35,"TKT","listteam", "Lista de tkts al equipo filtrada"),//usado
    array(36,"TKT","geth", "Detalle del ticket"), //usado
    array(37,"ACTION","getform", "Obtiene formulario"), //usado
    array(38,"TKT","listChilds", "TKT childs"), //usado
    array(39,"PAGE","mytkts", "Generados"),//usado
    array(40,"TKT","listmy", "Lista mistkts"),//usado
    array(41,"TKT","idsel_userasign", "Usuarios de equipo para asignar"), //usado
    array(42,"TKT","listfiltered", "Lista de tickets de equipos filtrados"), //usado
    array(43,"TKT","listmyclose","Lista de cerrados propios"), //usado
    array(44,"PAGE","actionhelp", "Ayuda"),
    
    array(45,"TKT_EXT","getStatus","Consulta BIT"),

    array(46,"TKT","listmyteams", "Lista tkts generados por equipo"),//usado
    
    array(47,"PAGE","reports", "Reportes"), //usado
    array(48,"TREE","get_filter", "Arbol para filtros"),
    
    array(49,"USER","idsel_domains","Lista de dominios validos"),//usado
    array(50,"USER","idsel_myadmteams","Lista de equipos que administra"),//usado
    array(51,"USER","idsel_profiles","Lista de perfiles validos"),//usado
    
    array(52,"INSTANCE","idsel_listfronts","Lista de fronts validos"),//usado
    array(53,"TKT","downloadfile","Descargar archivo de tkt"), //usado
    array(54,"TKT","listteamclose","Lista de tickets cerrados recientes por el equipo"), //usado
    array(55,"TKT","idsel_teamderive","Lista equipos a los que se puede derivar"), //usado
    array(56,"REPORT","report","Ejecuta reportes"),//usado
    array(57,"TKT","getsimilars","Carga tickets similares a uno no creado"),//usado
    array(58,"TKT","listtouch","Lista tickets que ya no estan en el equipo"),//usado
    array(59,"TKT","getpdf","Exportar a pdf"),//usado
    array(60,"USER","session_clear","Eliminar sesiones de usuario"),//usado
    array(61,"USER","get","Obtener datos del usuario"),//usado
    array(62,"USER","idsel_listreportteams","Lista de equipos que reporta"),//usado
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
    array('generado_por_equipo_de_usuario_dir_propia',2),
    array('generado_equipo_visible',4),
    array('derivado',3),
    array('master_de_tkt_usr',3),
    array('master_de_tkt_equipo',4),
    array('similar_a_uno_del_usr',5),
    array('similar_a_uno_del_equipo',6),
    array('generado_por_equipo_de_usuario_todas_direc',2)
);



?>

var DropOptions = {
    tolerance:"touch",
    hoverClass:"dropHover",
    activeClass:"dragActive"
};

var connector = ["Bezier", {
        curviness:63
    } ];


var connectorStyle = {
    lineWidth:2,
    strokeStyle:'#A4A4A4'
}

var connectorHoverStyle = {
   
}

var paintStyle = {
        width:10, 
        height:10, 
        fillStyle:'#00f'
    
}

var Configs = {
    
    DragOptions : {
        cursor: 'pointer', 
        zIndex:2000
    },
    Container: $('#ALLJ') , 
    PaintStyle : {strokeStyle:'#666'},
    EndpointStyle : {width:20, height:16, strokeStyle:'#666'},
    ConnectionsDetachable:false
};


var EP_LeftQuestion = {
    
    endpoint:"Rectangle",
    anchor:"LeftMiddle",
    paintStyle:paintStyle,
    isSource:true,
    scope:"O Q",
    connectorStyle : connectorStyle,
    connector: connector,
    connectorHoverStyle:connectorHoverStyle,
    isTarget:true,
    maxConnections:-1,		
    dropOptions : DropOptions
    
};

var EP_RightQuestion = {
    endpoint:["Dot", {
        radius:6
    }],
    anchor:"RightMiddle",
    paintStyle:paintStyle,
    isSource:true,
    scope:"Q O",
    connectorStyle:connectorStyle,
    connector: connector,
    connectorHoverStyle:connectorHoverStyle,
    isTarget:true,
    maxConnections:-1,
    dropOptions : DropOptions
    
};


var EP_LeftOption = {
    endpoint:["Dot", {
        radius:6
    }],
    anchor:"LeftMiddle",
    paintStyle:paintStyle,
    isSource:true,
    scope:"Q O",
    connectorStyle:connectorStyle,
    connector:connector,
    connectorHoverStyle:connectorHoverStyle,
    isTarget:true,
    maxConnections:1,
    dropOptions : DropOptions
    
};

var EP_RightOption = {
    endpoint:"Rectangle",
    anchor:"RightMiddle",
    paintStyle:paintStyle,
    isSource:true,
    scope:"O Q",
    connectorStyle : connectorStyle,
    connector: connector,
    connectorHoverStyle:connectorHoverStyle,
    isTarget:true,
    maxConnections:1,       				
    dropOptions : DropOptions
};


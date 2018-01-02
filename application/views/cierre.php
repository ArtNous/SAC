
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/materialize.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/confUI.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.formatter.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/formatter.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dragula.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/webix/webix.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/raphael-2.1.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/justgage.js'); ?>"></script>
<script>
    if(typeof($('select')) == 'object') {
        $('select').material_select();
    }

    var Panel = {
       mostrarOcupacion: opciones => {
        return webix.ui({
            container: opciones.contenedor,
            width: 700,
            height: 250,
            view: 'grouplist',
            data: opciones.datos,
            select: true,
            drag: true,
            templateBack: "<b>#$count#</b> en cola por #value#",
            templateGroup: "#value#",
            templateItem: "Placa: #placa# <span style='float: right'>Tiempo: #tiempo# minutos</span>",
            scheme: {
                $group: obj => {
                    return obj.servicio;
                },
                $sort: {by: "posicion", dir: "asc"}
            }
        });
       }
    }

    function verOrden(){
        $('#manipulacion li').each(function(e,val){
            console.log($(val).find('.cedula').html());
        });
    }

    // Se verifica si el cliente existe, en caso tal, muestra los datos
    // en el formulario y da un aviso que existe.
    var verificarCliente = function(rif){

        $.ajax('<?php echo base_url('cliente/verificarCliente/') ?>' + rif,{
            success: dato => {
                if (dato.msj == 1){
                    $('#Cod').val(dato.CodigoCliente);
                    $('#grupo').val(dato.CodigoGrupo);
                    $('#zona').val(dato.Zona);
                    $('#nombres').val(dato.Nombre);
                    $('#razon').val(dato.RazonSocial);
                    $('#direccion-sel').val(dato.Direccion);
                    $('#nit').val(dato.NIT);
                    $('#tlf').val(dato.Telefonos);
                    $('#estado').val(dato.Estado);
                    $('#ciudad').val(dato.Ciudad);
                    $('#municipio').val(dato.Municipio);
                    $('h4#cliente_existe').text('El cliente existe');

                    $('#grupo option[selected]').prop('selected',false);
                    $('#grupo option[value="'+ dato.CodigoGrupo +'"]').prop('selected',true);
                    $('#grupo').material_select();

                    $('#zona option[selected]').prop('selected',false);
                    $('#zona option[value="'+ dato.Zona +'"]').prop('selected',true);
                    $('#zona').material_select();

                    $('#riva option[selected]').prop('selected',false);
                    $('#riva option[value="'+dato.RegimenIVA+'"]').prop('selected',true);
                    $('#riva').material_select();

                    $('#estado option[selected]').prop('selected',false);
                    $('#estado option[value="'+dato.Estado+'"]').prop('selected',true);
                    $('#estado').material_select();

                    $('#ciudad option[value="'+dato.Ciudad+'"]').prop('selected',true);
                    $('#ciudad').material_select();
                    $('#ciudad option[selected]').prop('selected',false);

                    $('#municipio option[selected]').prop('selected',false);
                    $('#municipio option[value="'+dato.Municipio+'"]').prop('selected',true);
                    $('#municipio').material_select();

                    console.log(dato.Municipio);
                    console.log(dato.Estado);
                    console.log(dato.Ciudad);
                } else {
                    console.log('El cliente no existe');
                }
            },
            error: function (err){
                console.log(err);
            },
            dataType: 'json'
        });   
    }
      
    // ------------------
    
    // Funcion de inicializacion del calendario en la orden de servicio
    var datepicker = $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Hoy',
        clear: 'Borrar',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,
    });
    
    var pickerAPI = datepicker.pickadate('picker');

    // Inicializaciones
    var lista;
    var cola_webix_activos;
    $(document).ready(function() {

        // Elegir la base de datos
        $('select#comboBD').change(e => {
            $.ajax('<?php echo base_url('acciones/cambiarBD'); ?>',{
                data: {bd: $('select#comboBD').val()},
                type: 'POST',
                error: err => {
                    swal('Error','No se pudo cambiar la base de datos.','error');
                },
                success: datos => {
                    swal('Exito','Se cambio la base de datos exitosamente.','success');
                }
            });
        });
        
        if(!(document.getElementById('multicombo-servicios') == null)){
            $('#multicombo-servicios option:first-child').prop('disabled',true);
        }

        // Reportes

        if(!(document.getElementById('reporte1') == null)){
            webix.ui({
                view: 'chart',
                container: 'reporte1',
                type: 'line',
                id: "reporte1",
                width: 400,
                url: '<?php echo base_url('api/reporte_mes'); ?>',
                line:{
                    color:"#1293f8",
                    width:3
                },
                item:{
                    borderColor: "#1293f8",
                    color: "#ffffff"
                },
                xAxis: {
                    template: '#DIA#'
                },
                yAxis: {
                    template: function(obj){
                        return (obj%5?"":obj);
                    },
                    start: 0,
                    end: 30,
                    step: 5
                },
                value: '#CANTIDAD#',
                legend: {
                    values: [
                        {text: 'Servicios', color: 'blue'}
                    ],
                    align: 'right',
                    width: 100,
                    layout: 'y'
                }
            });  

            webix.ui({
                view: 'chart',
                container: 'reporte2',
                type: 'line',
                id: "reporte2",
                width: 400,
                url: '<?php echo base_url('api/reporte_anio'); ?>',
                line:{
                    color:"#1293f8",
                    width:3
                },
                item:{
                    borderColor: "#1293f8",
                    color: "#ffffff"
                },
                xAxis: {
                    template: '#mes#'
                },
                yAxis: {
                    template: function(obj){
                        return (obj%5?"":obj);
                    },
                    start: 0,
                    end: 30,
                    step: 5
                },
                value: '#CANTIDAD#'
            });      

            $('#mes-reporte1').change(function(){
                var servicio = $('#serv-reporte1').val();
                if (servicio == "") return false;
                webix.ajax().post('<?php echo base_url('api/reporte_mes'); ?>', { servicio : servicio, mes: $(this).val() }, function (text, xml, xhr) {
                    // response
                    console.log(text);
                    $$('reporte1').clearAll();
                    $$('reporte1').parse(text);
                });
            });  

            $('#anio-reporte2').change(function(){
                var servicio = $('#serv-reporte2').val();
                if (servicio == "") return false;
                webix.ajax().post('<?php echo base_url('api/reporte_anio'); ?>', { servicio : servicio, anio: $(this).val() }, function (text, xml, xhr) {
                    // response
                    console.log(text);
                    $$('reporte2').clearAll();
                    $$('reporte2').parse(text);
                });
            });     
        }

        if(!(document.getElementById('btnAnularOrden') == null)){
            console.log('Se ve');
            document.getElementById('btnAnularOrden').addEventListener('click', function() {
                console.log('asdas');
                swal("¿Esta seguro que desea anular la orden?.")
                .then((value) => {
                    if(value) {
                        webix.ajax().post("<?php echo base_url('orden/anular'); ?>");
                    }
                });
            });
        }

        $('.modal').modal();
        $('.tooltipped').tooltip({
            delay: 50
        });
        $('select').material_select();
        $('#comboServicioOrden').material_select();

        $('#tlf-sel').formatter({
            pattern: '({{9999}}) {{999}}-{{99}}-{{99}}',
            persistent: true
        });

        // gantt.config.scale_unit = "hour";
        // gantt.config.step = "1";
        // gantt.config.date_scale = "%h:%m";
        // gantt.config.duration_unit = "minute";

        // gantt.init('gantt');

        // Cola general
        if(!(document.getElementById('cola-webix') == null)){
            $('#select-cola').change(function(){
                document.getElementById('loader-cola').style.display = 'block';
                webix.ajax().post('<?php echo base_url('api/cola') ?>',{servicio: $(this).val()}, (text,data) => {
                    ix_cola.clearAll();
                    ix_cola.parse(text);
                    document.getElementById('loader-cola').style.display = 'none';
                });
            });

        var ix_cola = webix.ui({
                container:"cola-webix",
                view:"list", 
                id:'ix-cola',
                width:400,
                height:500,
                select: true,
                template: "<div class='center'>Placa: <b>#placa#</b></div>"
                    +"<div>Nro de orden: #id#</div>"
                    +"<div>Tiempo estimado: #tiempo# minutos</div>",
                type: {
                    height: 80
                },
                scheme: {
                   $change: function(item) {
                        if(item.tiempo < 30) item.$css = {'background-color': '#7D98DB'};
                        if(item.tiempo < 60 && item.tiempo > 30) item.$css = {'background-color': '#506497'};
                        if(item.tiempo > 60) item.$css = {'background-color': '#2B3859'};
                   }
                },
                drag: true,
                scheme:{
                },
                on: {
                    onItemClick: function(id,e,nodo){
                        var item = this.getItem(id);
                        if(item.servicio){
                            var nro = item.id;
                            $('#modales').load('<?php echo base_url('acciones/vermodal/'); ?>' + nro,function(){
                                $('#modal-' + nro).modal();
                                $('#modal-' + nro).modal('open');
                                $('.tooltipped').tooltip();
                                document.getElementById('btnAnularOrden').addEventListener('click', function() {
                                    swal({
                                        text: "¿Esta seguro que desea anular la orden?",
                                        content: 'input',
                                        button: {
                                            text: 'Si',
                                            closeModal: false
                                        }
                                    })
                                    .then((value) => {
                                    if(value) {
                                        webix.ajax().post("<?php echo base_url('orden/anular'); ?>", { nro: nro}, (text,data,http) => {
                                            swal('Anulada','La orden fue anulada exitosamente','success');
                                        });
                                    }
                                    });
                                });
                            });
                        }
                    }
                }
            });
        }

        if(!(document.getElementById('btnActualizarCola') == null)){
            document.getElementById('btnActualizarCola').addEventListener('click', e => {
                if(ix_cola.getVisibleCount() != 0){
                    var colaActual = ix_cola.data.order;
                    webix.ajax().post('<?php echo base_url('orden/modificarCola'); ?>',{cola: colaActual}, (text,data) => {
                        console.log(text);
                    });
                    // colaActual.forEach((nro,pos) => {
                    //     console.log('La orden nro ' + nro + ' esta de posicion ' + (pos+1));
                    // });
                }
            });            
        }

        // Lista de activos
        if(!(document.getElementById('cola-webix-activos') == null)){
            $('#select-cola-activos').change(function(){
                document.getElementById('loader-cola-activos').style.display = 'block';
                webix.ajax().post('<?php echo base_url('api/cola_activos') ?>',{servicio: $(this).val()}, (text,data) => {
                    console.log(text);
                    cola_webix_activos.clearAll();
                    cola_webix_activos.parse(text);
                    document.getElementById('loader-cola-activos').style.display = 'none';
                });
            });

            var cola_webix_activos = webix.ui({
                container:"cola-webix-activos",
                view:"list", 
                id: 'cola_webix_activos',
                width:450,
                height:500,
                template:"#nro_orden#. Placa: #placa# <span style='float: right'>#tiempo# minutos</span>",
                // templateItem:"<div>Placa: #placa# <progress style='float: right; margin-top: 5px' value='5' max='10'></progress></div><span style='float:right'>#tiempo# minutos</span>",
                select:true,
                scheme:{
                   $sort: {
                    by: '#minutos#',
                    dir: 'ASC'
                   }
                },
                on: {
                    onItemClick: function(id,e,nodo){
                        var item = this.getItem(id);
                        if(item.servicio){
                            var nro = item.nro_orden;
                            $('#modales').load('<?php echo base_url('acciones/vermodal/'); ?>' + nro + '/' + item.srvcodigo,function(){
                                $('#modal-' + nro).modal();
                                $('#modal-' + nro).modal('open');
                                $('#modal-' + nro +' select').material_select();
                                var iEl = document.createElement('i');
                                iEl.classList = 'material-icons';
                                iEl.innerHTML = 'check';
                                $(iEl).replaceAll('.modal-footer button:last-child .material-icons');
                                $('.modal-footer button:last-child').attr('data-tooltip','Finalizar orden');
                                $('.tooltipped').tooltip();
                                $('.tooltipped:last-child').tooltip({tooltip: 'Finalizar orden'});
                                $('#modal-' + nro + ' #comboTecnicoFicha').change(e => {
                                    $('#btnModificarTecnico').css('display','inline');
                                    $('#btnModificarTecnico').click(e => {
                                        webix.ajax().post('<?php echo base_url('orden/cambiarTecnicoDeOrden'); ?>',{tecnico: $('#comboTecnicoFicha').val(), orden: nro},(text,data) => {
                                            if(text){
                                                $('#btnModificarTecnico').css('display','none');
                                                swal('El técnico fue cambiado exitosamente.');
                                            }
                                        });
                                    });
                                });
                                $('.modal-footer button:last-child').click(function(){
                                    // Cuando se finaliza la orden
                                    swal("¿Esta seguro que desea finalizar la orden de servicio?")
                                    .then((value) => {
                                        if(value) {
                                            webix.ajax().post("<?php echo base_url('orden/finalizar/'); ?>", {orden: nro}, (text,data) => {
                                                swal("Listo","Orden finalizada. Su próximo mantenimiento debe ser dentro de " + (item.proxima + item.km_actual) + " km","success");
                                                webix.ajax().post('<?php echo base_url('api/cola_activos') ?>',{servicio: $(this).val()}, (text,data) => {
                                                    $('#modal-' + nro).modal('close');
                                                    cola_webix_activos.clearAll();
                                                    cola_webix_activos.parse(text);
                                                });

                                                webix.ajax().get('<?php echo base_url('api/progreso_activas') ?>', (text,data) => {
                                                    $$('ix-progreso-tecnicos').clearAll();
                                                    $$('ix-progreso-tecnicos').parse(text);
                                                });
                                            });
                                        }
                                    })
                                });
                            });
                        }
                    }
                }
            });
        }

        // Ocupacion de tecnicos
        if(!(document.getElementById('ocupacion-tecnicos') == null)){
           
            var progresoTecnicos = webix.ui({
                view: 'dataview',
                container: 'ocupacion-tecnicos',
                id:"ix-progreso-tecnicos",
                template: '<div class="porta-gage"><div style="text-align: center; color: white">#tecNombre#</div><div id="gage-#orden#" class="gage"></div><div style="color: white; font-size: 20px">#placa#</div><div style="text-align: center; color: white">#servicio#</div></div>',
                url: '<?php echo base_url('api/progreso_activas'); ?>',
                type: {
                    height: 240,
                    width: 230
                },
                xCount: 4,
                width: 900,
                height: 300,
                ready: function(){
                    this.data.each(obj => {
                        // Termino el servicio
                        if(obj.termino == 1){
                            var opc = {
                                id: 'gage-' + obj.orden,
                                value: obj.tiempo,
                                min: 0,
                                max: obj.tiempo,
                                title: 'Finalizó'
                            }
                        } else {
                            var opc = {
                                id: 'gage-' + obj.orden,
                                value: obj.minutos,
                                min: 0,
                                max: obj.tiempo,
                                title: 'Tiempo'
                            }
                        }
                        var g = new JustGage(opc);
                    });
                },
            });
        }

        // La cola del panel
         $.ajax('<?php echo base_url("orden/verColasDeServicios"); ?>',{
            dataType: 'json',
            success: d => {
                console.log(d);
                var opciones = {
                    contenedor: 'lista-webix',
                    datos: d
                }
                var lista = Panel.mostrarOcupacion(opciones);

            },
            error: d => {
                console.log("Error: " + d);
            }
        });

         function filtrar(tipo) {
            $$('ordenes').filter('#estatus#',tipo);
         }

        if(!(document.getElementById('lista-ordenes-webix') == null)){
            webix.ui({
                container: 'lista-ordenes-webix',
                rows: [
                    {
                        view: 'toolbar',
                        paddingY: 5,
                        cols: [
                            {view: 'template', template: 'Filtrar por:', width: 90, type: 'text', css: {'background-color': 'transparent', 'border': 'none', 'font-size': '15px','color': 'white'}},
                            {view: 'button', label: 'Listas', width: 80, css: {'color': 'black'}, click: '$$("ordenes").filter("#estatus#","Finalizada")'},
                            {view: 'button', label: 'Pendientes', width: 80, css: {'color': 'black'}, click: '$$("ordenes").filter("#estatus#","En cola")'},
                            {view: 'button', label: 'Activas', width: 80, css: {'color': 'black'}, click: '$$("ordenes").filter("#estatus#","Activa")'},
                            {view: 'button', label: 'Ver todas', width: 100, align: 'right', click: '$$("ordenes").filterByAll()'}
                        ]
                    },
                    {
view: 'datatable',
                // container: 'lista-ordenes-webix',
                id: 'ordenes',
                url: '<?php echo base_url("api/ordenes"); ?>',
                columns: [
                    {id: 'nro_orden', header: 'Nro Orden', sort: 'text', adjust: 'data', footer: {content: 'summColumn'}}, // Nro
                    {id: 'placa', header: ['Placa',{content: 'textFilter'}], sort: 'string'}, // Placa
                    {id: 'cliente', header: ['Cliente',{content: 'textFilter'}], sort: 'string'}, // Cedula
                    {id: 'fecha', header: ['Fecha',{content: 'dateFilter'}], sort: 'date'}, // Cedula
                    {id: 'serv', header: ['Servicio',{content: 'selectFilter'}], sort: 'string', fillspace: true}, // Servicio
                    {id: 'estatus', header: 'Estatus', sort: 'string'}, // Estatus
                    {id: 'tec', header: ['Técnico',{content: 'textFilter'}], sort: 'string', fillspace: true} // Tecnico
                ],
                scheme: {
                    $change: function(obj) {
                        if(obj.estatus == 1) {
                            obj.estatus = "Activa";
                        }
                        if(obj.estatus == 2) {
                            obj.estatus = "En cola";
                        }
                        if(obj.estatus == 3) {
                            obj.estatus = "Finalizada";
                        }
                        if(obj.estatus == 4) {
                            obj.estatus = "Anulada";
                        }
                    }
                },
                height: 500,
                width: 800,
                select: true,
                resizeColumn:true,
                on:{
                    onBeforeLoad:function(){
                        this.showOverlay("Cargando...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onItemClick: function(id,e,node) {
                        // Cuando se clickea un elemento
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        if(item.nro_orden == null) return false;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('orden/editar/') ?>' + item.nro_orden);
                        // enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('orden/eliminar/') ?>' + item.nro_orden);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                },
                editable: true,
                pager: {
                    container: 'paginador',
                    size: 15,
                    group: 10
                }
                    }
                ]
                
            });
        }

        if(!(document.getElementById('btnExportarExcel') == null)){
            document.getElementById('btnExportarExcel').addEventListener('click', function(){
                webix.toExcel($$('ordenes'),{
                    filename: 'reporte_servicio',
                    name: 'reporte'
                });
            });
        }

        if(!(document.getElementById('btnExportarPDF') == null)){
            webix.cdn = "<?php echo base_url("assets/webix"); ?>";
            document.getElementById('btnExportarPDF').addEventListener('click', function(){
                webix.toPDF($$('ordenes'),{
                    docHeader: {
                        text: "CAUCHOS AVENIDA C.A",
                        textAlign: 'center',
                        color: 'blue'
                    },
                    filename: 'reporte_servicio',
                    autoWidth: true,
                    orientation: 'landscape'
                });
            });
        }

        if(!(document.getElementById('lista-clientes-webix') == null)){
            webix.ui({
                view: 'datatable',
                container: 'lista-clientes-webix',
                url: '<?php echo base_url("api/clientes"); ?>',
                columns: [
                    {id: 'RIF', header: ['Rif',{content: 'textFilter'}], width: 100, sort: 'string'},
                    {id: 'Nombre', header: ['Nombre',{content: 'textFilter'}], sort: 'string', width: 250},
                    {id: 'RazonSocial', header: 'Razon Social', width: 200},
                    {id: 'Direccion', header: 'Dirección', width: 200},
                    {id: 'Ciudad', header: 'Ciudad', adjust: 'data'},
                    {id: 'Estado', header: 'Estado', adjust: 'data'},
                    {id: 'Municipio', header: 'Municipio', adjust: 'data'},
                    {id: 'CodigoGrupo', header: 'Grupo', adjust: 'data', },
                    {id: 'Zona', header: 'Zona', adjust: 'data'}
                ],
                height:350,
                width: 1200,
                select: true,
                resizeColumn:true,
                on:{
                    onBeforeLoad:function(){
                        this.showOverlay("Cargando...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onAfterSelect: function(data){
                        var item = this.getSelectedItem();
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('cliente/crear/') ?>' + item.RIF);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('cliente/Eliminar/') ?>' + item.RIF);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                },
                datafetch: 50,
                loadahead: 50,
                pager: {
                    container: 'paginador',
                    size: 50,
                    group: 20
                }
            });
        }    

        if(!(document.getElementById('lista-servicios-webix') == null)){
            webix.ui({
                view: 'datatable',
                container: 'lista-servicios-webix',
                url: '<?php echo base_url("api/servicios"); ?>',
                columns: [
                    {id: 'Codigo', header: 'Código', adjust: 'data', sort: 'string'},
                    {id: 'Nombre', header: ['Nombre',{content: 'textFilter'}], sort: 'string', adjust: 'data'},
                    // {id: 'descripcion', header: ['Descripción',{content: 'textFilter'}], fillspace:true, sort: 'string'},
                ],
                height: 300,
                width: 700,
                select: true,
                resizeColumn:true,
                on:{
                    onBeforeLoad:function(){
                        this.showOverlay("Cargando...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onItemClick: function(id,e,node) {
                        // Cuando se clickea un elemento
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        document.getElementById('campo-editar').value = item.nombre;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('servicios/crear/') ?>' + item.codigo);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('servicios/eliminar/') ?>' + item.codigo);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                },
                pager: {
                    container: 'paginador',
                    size: 5,
                    group: 10
                }
            });
        }    

        if(!(document.getElementById('lista-tecnicos-webix') == null)){
            webix.ui({
                container:"lista-tecnicos-webix",
                view:"treetable",
                url: '<?php echo base_url("api/tecnicos"); ?>',
                columns:[
                    { id:"cedula", header:["cedula",{content: 'textFilter'}], width: 80},
                    { id:"nombre", header:["Nombre técnico",{content: 'textFilter'}], fillspace: true,
                        template:function(obj, common){
                            if (obj.$level == 1) return common.treetable(obj, common) + obj.value;
                            return obj.nombre;
                        }
                    },
                    { id:"estatus",    header:["Estatus",{content: 'selectFilter'}],  width:90, sort: 'string'}, 
                    { id:"codigoINT",   header:"Código INT", width:120}
                ],
                scheme:{
                    $group:"servicio",
                    $sort:{ by:"value", dir:"asc" }
                },
                height:300,
                width:600,
                select: "row",
                pager: {
                    container: 'paginador',
                    size: 5,
                    group: 10
                },
                on: {
                    onBeforeLoad: function () {
                        this.showOverlay('Cargando...');
                    },
                    onAfterLoad: function () {
                        this.hideOverlay();
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        if(item.cedula == null) return false;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('tecnicos/crear/') ?>' + item.cedula);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('tecnicos/eliminar/') ?>' + item.cedula);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                }
            }); 
        } 

        if(!(document.getElementById('lista-vehiculos-webix') == null)){
            webix.ui({
                view: 'datatable',
                container: 'lista-vehiculos-webix',
                url: '<?php echo base_url("api/vehiculos"); ?>',
                columns: [
                    {id: 'placa', header: ['Placa',{content: 'textFilter'}], adjust: 'data', sort: 'string'},
                    {id: 'marca', header: ['Marca',{content: 'textFilter'}], sort: 'string', adjust: 'data'},
                    {id: 'modelo', header: ['Modelo',{content: 'textFilter'}], adjust: 'data'},
                    {id: 'tipo', header: ['Tipo de vehiculo',{content: 'textFilter'}], fillspace: true, string: 'string'},
                ],
                height: 300,
                width: 700,
                select: true,
                resizeColumn:true,
                on:{
                    onBeforeLoad:function(){
                        this.showOverlay("Cargando...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onItemClick: function(id,e,node) {
                        // Cuando se clickea un elemento
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        if(item.placa == null) return false;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('vehiculo/editar/') ?>' + item.placa);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('vehiculo/eliminar/') ?>' + item.placa);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                },
                editable: true,
                pager: {
                    container: 'paginador',
                    size: 5,
                    group: 10
                }
            });
        }  

        if(!(document.getElementById('lista-marcas-webix') == null)){
            webix.ui({
                view: 'datatable',
                container: 'lista-marcas-webix',
                url: '<?php echo base_url("api/marcas"); ?>',
                columns: [
                    {id: 'nombre', header: ['Marca',{content: 'textFilter'}], width: 700, sort: 'string'},
                    {id: 'id', header: "id", hidden: true}
                ],
                height: 300,
                width: 700,
                select: true,
                resizeColumn:true,
                on:{
                    onBeforeLoad:function(){
                        this.showOverlay("Cargando...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onItemClick: function(id,e,node) {
                        // Cuando se clickea un elemento
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        if(item.id == null) return false;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('marcas/editar/') ?>' + item.id);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('marcas/eliminar/') ?>' + item.id);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                },
                editable: true,
                pager: {
                    container: 'paginador',
                    size: 5,
                    group: 10
                }
            });
        }

        if(!(document.getElementById('lista-modelos-webix') == null)){
            webix.ui({
                container:"lista-modelos-webix",
                view:"treetable",
                url: '<?php echo base_url("api/modelos"); ?>',
                columns:[
                    { id:"marca",   header:["Marca",{content: 'textFilter'}], fillspace: true, template:function(obj, common){
                            if (obj.$level == 1) return common.treetable(obj, common) + obj.value;
                            return obj.modelo;
                        }},
                    { id: "id", header: "", hidden: true}
                ],
                scheme:{
                    $group:"marca",
                    $sort:{ by:"value", dir:"asc" }
                },
                height:300,
                width:600,
                select: true,
                pager: {
                    container: 'paginador',
                    size: 10,
                    group: 10
                },
                on: {
                    onBeforeLoad: function () {
                        this.showOverlay('Cargando...');
                    },
                    onAfterLoad: function () {
                        this.hideOverlay();
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        if(typeof(item.id) != 'number') return false;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('modelos/editar/') ?>' + item.id);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('modelos/eliminar/') ?>' + item.id);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                }
            }); 
        }

        if(!(document.getElementById('lista-tipos-webix') == null)){
            webix.ui({
                view: 'datatable',
                container: 'lista-tipos-webix',
                url: '<?php echo base_url("api/tipos"); ?>',
                columns: [
                    {id: 'descripcion', header: ['Tipo de vehículo',{content: 'textFilter'}], width: 700, sort: 'string'}
                ],
                height: 300,
                width: 700,
                select: true,
                resizeColumn:true,
                on:{
                    onBeforeLoad:function(){
                        this.showOverlay("Cargando...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onItemClick: function(id,e,node) {
                        // Cuando se clickea un elemento
                    },
                    onAfterSelect: function(data) {
                        var item = this.getSelectedItem();
                        if(typeof(item.id) != 'number') return false;
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('tipos_vehiculos/editar/') ?>' + item.id);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('tipos_vehiculos/eliminar/') ?>' + item.id);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                },
                editable: true,
                pager: {
                    container: 'paginador',
                    size: 10,
                    group: 10
                }
            });
        }

        if(!(document.getElementById('lista-tiempos-webix') == null)){
            webix.ui({
                container:"lista-tiempos-webix",
                view:"treetable",
                id:'ix-tiempos',
                url: '<?php echo base_url("api/tiempos"); ?>',
                columns:[
                    { id:"servicio",   header:["Servicio",{content: 'textFilter'}], width: 300, template:function(obj, common){
                            if (obj.$level == 1) return common.treetable(obj, common) + obj.value;
                            return obj.tipo;
                        }},
                    { id: 'tiempo', header: ["Tiempo de servicio",{content: 'numberFilter'}], width: 300, css: {'text-align': 'center'}, template: (obj, common) => {
                        if(obj.$level == 1) return "";
                        return obj.tiempo + " minutos";
                    }},
                    { id: 'kilometraje', header: ['Próximo kilometraje',{content: 'numberFilter'}], template: "#kilometraje# km", template:function(obj, common){
                            if (obj.$level == 1) return "";
                            return obj.kilometraje + " km";
                        }}
                ],
                scheme:{
                    $group:"servicio",
                    $sort:{ by:"value", dir:"asc" }
                },
                height:300,
                width:800,
                select: true,
                pager: {
                    container: 'paginador',
                    size: 10,
                    group: 10
                },
                on: {
                    onBeforeLoad: function () {
                        this.showOverlay('Cargando...');
                    },
                    onAfterLoad: function () {
                        this.hideOverlay();
                    },
                    onAfterSelect: function(data) {
                        console.log('click');
                        var item = this.getSelectedItem();
                        var enlaceEditar = document.getElementById('btnModificar');
                        var enlaceEliminar = document.getElementById('btnEliminar');
                        enlaceEditar.setAttribute('href','<?php echo base_url('tiempos/crear/') ?>' + item.tipoid + "/" + item.cod_serv);
                        enlaceEditar.style.display = 'inline-block';
                        enlaceEliminar.setAttribute('href','<?php echo base_url('tiempos/eliminar/') ?>' + item.tipoid + "/" + item.cod_serv);
                        enlaceEliminar.style.display = 'inline-block';
                    }
                }
            }); 
        }

        $('#comboMarcasVehiculo').change(function() {
            var marca = document.getElementById('comboMarcasVehiculo').value;
            $('#comboModelo').load('<?php echo base_url('vehiculo/mostrarModelosDeMarca/'); ?>' + marca, function() {
                $('#comboModelo').material_select();
            });
        });

        var btnBuscarOrdenesCliente = document.getElementById('btnBuscarOrdenesCliente');
        if(typeof(btnBuscarOrdenesCliente) == 'object') {
            btnBuscarOrdenesCliente.addEventListener('click',e => {
                console.log('click');
                if ($('#txtRif').val() == "") {
                    placa = document.getElementById('txtPlaca').value;
                    $('#lista-ordenes-cliente').load('<?php echo base_url("orden/buscarPorPlaca/"); ?>' + placa);
                } else {
                    rif = document.getElementById('txtRif').value;
                    $('#lista-ordenes-cliente').load('<?php echo base_url("orden/buscarPorCliente/"); ?>' + rif);
                }
            });
        }
        
        if(typeof($('button.finalizarOrden')) == 'object'){
            $('button.finalizarOrden').click(function() {
                alert('Fin');
            });            
        }
    });

    // var cola = {
    //     mostrar: function(eventos) {
    //         gantt.parse(eventos);            
    //     }
    // }
</script>
<script>
    // Eventos
    $('.datepicker').change(function(){
        var fecha = pickerAPI.get('select','yyyy/mm/dd');
        $(this).val(fecha);
    });

    $("input").on('keyup', function(e){
        $(this).val($(this).val().toUpperCase());
    }); // General
    
    

    function abrirMdlEliminar(titulo,id,url){
        $('#mdlEliminar').modal();
        $('#mdlEliminar').modal('open');
        $('#mdlEliminar h5').text('¿Esta seguro que desea borrar ' + titulo + '?');
        $('#mdlEliminar .modal-close:last-child').attr('href',url + id);        
    }
    
    function autocompletarClientesVehiculo(){
        $.ajax('<?php echo base_url("cliente/jsonAutocompletarTodos"); ?>',{
            dataType: 'json',
            error: err => {
                console.log('Error en ajax para autocompletar');
            },
            success: datos => {
                $('input.autocomplete').autocomplete({
                    data: datos,
                    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                    onAutocomplete: function(val) {
                      
                    },
                    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                });
            }                            
        });
    }

    // Activa los campos del formulario para editar el cliente
    function activarCampos(){
        $('#tab-info input:disabled').removeAttr('disabled');
        $('#tab-info button[type="submit"]').css('display','block');
        $('#btnDesactivarCampos').css('display','inline-block');

        $('input').each(function(i,el){
            var texto = $(el).val();
            if(texto == 'No tiene') {
                $(el).val('');
            }
        });
    }

    function desactivarCampos(){
        $('#tab-info input').attr('disabled','disabled');
        $('#tab-info button[type="submit"]').css('display','none');
        $('#btnDesactivarCampos').css('display','none');

        $('input').each(function(i,el){
            var texto = $(el).val();
            if(texto == '') {
                $(el).val('No tiene');
            }
            
        });
    }

    function autocompletarCliente(opcion){
        switch (opcion) {
            case 1:
                $.ajax('<?php echo base_url("cliente/autoCompletarPorRif"); ?>',{
                dataType: 'json',
                error: err => {
                    console.log('Error en ajax para autocompletar');
                },
                success: function(datos){
                    $('input.autocomplete.rif').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {
                            // alert(val);
                        },
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }                            
                });
            break;

            case 2:
                $.ajax('<?php echo base_url("cliente/autoCompletarPorNombre"); ?>',{
                    dataType: 'json',
                    error: err => {
                        console.log('Error en ajax para autocompletar');
                    },
                    success: datos => {
                        $('#nombre-buscar').autocomplete({
                            data: datos,
                            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                            onAutocomplete: function(val) {},
                            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                        });
                    }                            
                });
            break;

            case 3:
                $.ajax('<?php echo base_url("cliente/autoCompletarPorRif"); ?>',{
                    dataType: 'json',
                    error: err => {
                        console.log('Error en ajax para autocompletar' + err);
                    },
                    success: datos => {
                        $('#txtRif').autocomplete({
                            data: datos,
                            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                            onAutocomplete: function(val) {
                                $('#nombreClienteOrden').load('<?php echo base_url('cliente/ver/') ?>' + val);
                            },
                            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                        });
                    }                            
                });
            break;

            case 4:
                $.ajax('<?php echo base_url("vehiculo/autocompletarPlacas"); ?>',{
                    dataType: 'json',
                    error: err => {
                        console.log('Error en ajax para autocompletar');
                    },
                    success: datos => {
                        $('#txtPlaca').autocomplete({
                            data: datos,
                            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                            onAutocomplete: function(val) {},
                            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                        });
                    }                            
                });
            break;
        }
    }

    // Buscar por codigo y mostrar el cliente en el formulario de crear orden

    if(!(document.getElementById('txtUsuario') == null && document.getElementById('txtPlacaOrden') == null)){
        $('#txtUsuario').keyup(e => {
            document.getElementById('loader-cod-cliente').style.display = 'block';
            $.ajax('<?php echo base_url("cliente/paracombo"); ?>',{
                data: {valor: e.currentTarget.value},
                dataType: 'json',
                type: 'POST',
                error: err => {
                    console.log('Error para autocompletar combo');
                },
                success: datos => {
                    console.log(datos);
                    document.getElementById('loader-cod-cliente').style.display = 'none';
                    $('#txtUsuario').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {
                            var cliente = $('#txtUsuario').val();
                            if(cliente == null || cliente == ""){
                                return false;
                            }
                            $('#lblNombreCliente').load('<?php echo base_url('cliente/ver/') ?>' + cliente);
                        },
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }
            });
        });

        $('#txtPlacaOrden').keyup(e => {
            $.ajax('<?php echo base_url("vehiculo/paracombo"); ?>',{
                data: {valor: e.currentTarget.value},
                dataType: 'json',
                type: 'POST',
                error: err => {
                    console.log('Error para autocompletar combo');
                },
                success: datos => {
                    console.log(datos);
                    $('#txtPlacaOrden').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {
                            $('#nombreVehiculo').load('<?php echo base_url('vehiculo/verNombre/'); ?>'+val);
                        },
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }
            });
        });
    }

    // Buscar por nombre y mostrar el cliente en el formulario de crear orden

    if(!(document.getElementById('txtUsuarioNombre') == null && document.getElementById('txtPlacaOrden') == null)){
        
        $('#txtUsuarioNombre').focusin(e => {
            $('#txtUsuario').val('');
        });

        $('#txtUsuario').focusin(e => {
            $('#txtUsuarioOrden').val('');
        });

        $('#txtUsuarioNombre').keyup(e => {
            $.ajax('<?php echo base_url("cliente/paracomboNombre"); ?>',{
                data: {valor: e.currentTarget.value},
                dataType: 'json',
                type: 'POST',
                error: err => {
                    console.log('Error para autocompletar combo');
                },
                success: datos => {
                    $('#txtUsuarioNombre').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {
                            var cliente = $('#txtUsuarioNombre').val();
                            $.ajax('<?php echo base_url('cliente/consultar') ?>' + cliente,{
                                data: {nombre: cliente},
                                dataType: 'json',
                                type: 'POST',
                                error: err => {
                                    console.log(err);
                                },
                                success: datos => {
                                    console.log(datos);
                                }
                            });
                            var titulo = document.createElement('h4');
                            titulo.classList = 'center';
                            titulo.innerHTML = cliente;
                            titulo.style.backgroundColor = 'lightblue';
                            titulo.style.padding = '8px';
                            titulo.style.borderRadius = '4px';
                            $(titulo).appendTo($('#lblNombreCliente'));
                        },
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }
            });
        });
    }
    
    function autocompletarClientesOrden(){
        $.ajax('<?php echo base_url("cliente/autoCompletarPorRif"); ?>',{
            dataType: 'json',
            error: err => {
                console.log('Error en ajax para autocompletar');
            },
            success: datos => {
                $('input.autocomplete').autocomplete({
                    data: datos,
                    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                    onAutocomplete: function(val) {
                        $('#comboPlacaOrden').load("<?php echo base_url('vehiculo/buscarAutosCliente/'); ?>"+val,function(){
                            $('#comboPlacaOrden').material_select();
                        });
                        $('#lblNombreCliente').load("<?php echo base_url('cliente/ver/'); ?>"+val);
                    },
                    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                });
            }                            
        });
    }

    var verCola = function (serv) {
        $('#comboTecnicoOrden').val('');
        $('#comboTecnicoOrden').load('<?php echo base_url('orden/vertecnicosservicio/'); ?>' + serv);
        $('#comboTecnicoOrden').material_select();
    }

    // Pasar a estatus activa una orden


    // Muestra la descripcion del vehiculo al seleccionarlo
    $('#comboPlacaOrden').change(function(){
        var placa = $(this).val();
        $('#nombreVehiculo').load('<?php echo base_url('vehiculo/verNombre/'); ?>'+placa);
    });

    // Lista para mostrar la cola en la orden de servicio

    // Al seleccionar el servicio, muestra la cola
    $('#comboServicioOrden').change(function(){
        return false;
        var servicio = this.value;
        cola_webix.clearAll();
        $.ajax('<?php echo base_url('orden/verColaJSON'); ?>',{
            type: 'POST',
            data: {servicio: servicio},
            dataType: 'json',
            success: datos => {
                console.log(datos);
                cola_webix.load("<?php echo base_url('api/cola'); ?>");
                var total_cola = cola_webix.count();
                var tiempoAtencion = null;
                cola_webix.data.each(orden => {
                    tiempoAtencion += orden.tiempo;
                });
                var horaAtencion = moment().add(tiempoAtencion, 'minutes').format('LTS');
                document.getElementById('cantidad-cola').innerText = total_cola + " en cola";                
                document.getElementById('tiempoAtencion').innerText = "Hora aproximada de atención: " + horaAtencion;                
            },
            error: err => {
                console.log('Error en la peticion ajax de cola');
            }
        });

        return true;

        $('#comboTecnicoOrden').load('<?php echo base_url('orden/vertecnicosservicio/'); ?>' + servicio, function(){
            $('#sel_tecnicos_orden').material_select();
            $('#sel_tecnicos_orden').change(function() {
                if(this.value == "crear"){
                    window.location = "../tecnicos/crear";
                    return true;
                }
            });
        });
    });

    $('#comboMarcasVehiculo').change(function() {
        var marca = document.getElementById('comboMarcasVehiculo').value;
        $('#comboModelo').load('<?php echo base_url('vehiculo/mostrarModelosDeMarca/'); ?>' + marca, function() {
            $('#comboModelo').material_select();
        });
    });

    $('#btnRif').click(function() {
        var url = 'http://localhost:8000/materialize_dashboard/cliente/verCliente/' + $('#rif-buscar').val();

        $.ajax(url, {
            dataType: 'html',
            success: function(datos, estado, xhr) {
                console.log(estado);
                console.log(datos);
                $('#ficha-cliente div').html(datos);
            }
        });
    });

    $('.btnLimpiar').click(function() {
        $('#ficha-cliente div').html("");
        $('#rif-buscar').val("");
        $('#nombre-buscar').val("");
    });

    $('.btnEditarModelo').click(function() {
        var nombreModelo = $(this).closest('li').find('b').text();
        var idModel = $(this).closest('li').find('i.idModelo').text();

        $('#modalEditarModelo h4').text('Modificar modelo ' + nombreModelo);
        $('#txtIdModeloEscondido').val(idModel);
    });

    $('.btnBorrarModelo').click(function() {
        var nombreModelo = $(this).closest('li').find('b').text();
        var idModel = $(this).closest('li').find('i.idModelo').text();

        $('#modalBorrarModelo h4').text('Borrar modelo ' + nombreModelo);
        $('#txtIdModeloEliminar').val(idModel);
    });

    $('.btnEditarTipoVehiculo').click(function() {
        var descripcionTipo = $(this).closest('li').find('b').text();
        var idTipoVehiculo = $(this).closest('li').find('i.idTipo').text();

        $('#modalEditarTipoVehiculo h4').text('Modificar tipo de vehiculo ' + descripcionTipo);
        $('#txtIdTipoEscondido').val(idTipoVehiculo);
    });
    
   $('.btnEditarMarca').click(function(){
       $('#modalEditarMarca').modal('open');
        var marca = $(this).closest('div').find('span:first-child').text();
        var id = $(this).closest('div').find('.idMarca').text();
       $('#modalEditarMarca h4').text('Modificar marca ' + marca);
        $('#txtIdMarcaEscondido').val(id);
    });     
   
    
    $('.btnEditarModelo').click(function() {
        var nombreModelo = $(this).closest('div').find('b').text();
        var idModelo = $(this).closest('li').find('i.idModelo').text();

        $('#modalEditarModelo h4').text('Modificar modelo ' + nombreModelo);
        $('#txtIdModelo').val(idModelo);
    });

    var el = document.getElementById('tiempo_minutos'); 
    if (typeof(el) == 'object'){
        el.addEventListener('change', function() {
            var minutos = document.getElementById('tiempo_minutos').value;
            $('div.minutos h3').text(minutos + " minutos");
            $('div.minutos h3').css('opacity', 1);
        });
    }
    document.getElementById('tiempo_minutos').addEventListener('change', function() {
        var minutos = document.getElementById('tiempo_minutos').value;
        $('div.minutos h3').text(minutos + " minutos");
        $('div.minutos h3').css('opacity', 1);
    });
    
     function modalMostrarModelos(id){ 
         $('#modalModelosMarca').find('#listaModelos').load("<?php echo base_url('modelos/verModelosMarca/'); ?>"+id);
     }
    
    function editarTecnico(cedula){
        $('#modalEditarTecnico').modal('open');
        $('#txtCedulaTecnico').val(cedula);
    }

</script>
<div id="modales"></div>
</body>

</html>

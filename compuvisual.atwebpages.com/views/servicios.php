<?php
$_SESSION['action'] = "servicios";
?>

<h2>Manejo de Estudiantes</h2>
<table id="dg" title="Estudiantes" class="easyui-datagrid" style="width:700px;height:250px"
    url="models/obtener.php"
    toolbar="#toolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="cedula" width="50">Cedula</th>
            <th field="nombre" width="50">Nombre</th>
            <th field="apellido" width="50">Apellido</th>
            <th field="direccion" width="50">Direccion</th>
            <th field="telefono" width="50">Telefono</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <?php
    if ($_SESSION["logueado"]) {
        echo ('
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar</a>
        <a href="index.php?action=reporte&reporte=fpdf" class="easyui-linkbutton" iconCls="icon-remove" plain="true" ">Reporte Total</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"  onclick="reporte()">Reporte Seleccionado</a>
        ');
    }
    ?>
    <input id="searchBox" class="easyui-textbox" prompt="Buscar..." style="width:200px;">
    <a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="buscar()">Buscar</a>

</div>

<div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Ingresar Informacion</h3>
        <div style="margin-bottom:10px">
            <input name="cedula" class="easyui-textbox" required="true" label="Cedula:" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <input name="direccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <input name="telefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%">
        </div>
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
</div>
<script type="text/javascript">
    var url;

    function newUser() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Estudiante');
        $('#fm').form('clear');
        url = 'models/guardar.php';
    }

    function editUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Estudiante');
            $('#fm').form('load', row);
            url = 'models/editar.php?cedula=' + row.cedula;
        }
    }

    function saveUser() {
        $('#fm').form('submit', {
            url: url,
            iframe: false,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                var result = eval('(' + result + ')');
                if (result.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the user data
                }
            }
        });
    }

    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', 'Está seguro que quiere eliminar este estudiante?', function(r) {
                if (r) {
                    $.post('models/eliminar.php', {
                        cedula: row.cedula
                    }, function(result) {
                        if (result.success) {
                            $('#dg').datagrid('reload'); // reload the user data
                        } else {
                            $.messager.show({ // show error message
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    }, 'json');
                }
            });
        }
    }

    function buscar() {
        var valorBusqueda = $('#searchBox').val();
        $('#dg').datagrid('load', {
            cedula: valorBusqueda
        });
    }
    function reporte(){
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            location.href="index.php?action=reporte&reporte=fpdf&cedula="+row.cedula;
        }else{
            $.messager.confirm('Ok', 'Seleccione un estudiante', function(r) {
            });
        }
    }
</script>
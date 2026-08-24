<?php 
$menu = array(
    array(
        'id'=>1,
        'name'=>'Usuarios',
        'icon'=>'usuarios-icon.svg',
        'link'=>'',
        'items'=>array(
            array(
                'id'=>1,
                'name'=>'Lista de usuarios',
                'icon'=>"",
                'link'=>'usuarios.php'
            ),
            array(
                'id'=>2,
                'name'=>'Registro de usuarios',
                'icon'=>"",
                'link'=>'#'
            )
        )
    ),
    array(
        'id'=>2,
        'name'=>'Sedes',
        'icon'=>'sedes-icon.svg',
        'link'=>'sedes.php',
        'items'=>array(
            array(
                'id'=>1,
                'name'=>'Lista de sedes',
                'icon'=>"",
                'link'=>'sedes.php'
            ),
            array(
                'id'=>2,
                'name'=>'Registro de sedes',
                'icon'=>"",
                'link'=>'#'
            )
        )
    )
);
?>

<div id="menu-container" class="menu-contaniner-opened">
    <?php for($i = 0;$i<count($menu);$i++){?>
        <?php if($menu_active[0]==$menu[$i]['id']){ ?>
            <div class="menu-item menu-item-opened">
        <?php }else{ ?>
            <div class="menu-item menu-item-closed">
        <?php } ?>
            <div class="menu-item-head" onclick="clickItemMenu(this)">
                <img src="./public/assets/images/menu/<?php echo $menu[$i]['icon']?>" />
                <p><?php echo $menu[$i]['name']?></p>
                <div></div>
            </div>
            <div class="menu-item-submenu">
                <?php for($j = 0;$j<count($menu[$i]['items']);$j++){?>
                    <?php if($menu_active[1]==$menu[$i]['items'][$j]['id']&&$menu_active[0]==$menu[$i]['id']){ ?>
                        <div class="submenu-item submenu-item-active">
                    <?php }else{ ?>
                        <div class="submenu-item">
                    <?php } ?>
                        <div></div>
                        <a href="<?php echo $menu[$i]['items'][$j]['link']?>"><?php echo $menu[$i]['items'][$j]['name']?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    function clickItemMenu(head_item){
        var item_parent = head_item.parentNode
        var clase = item_parent.className
        if(clase.indexOf('opened')==-1){
            //abrir
            item_parent.className = 'menu-item-opened'
        }else{
            //cerrar
            item_parent.className = 'menu-item-closed'
        }
    }
</script>
<link href="<?php echo $base?>public/assets/css/fonts.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base?>public/assets/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base?>public/assets/css/header.css" rel="stylesheet" type="text/css" />
<script>
    function getE(idname){
        return document.getElementById(idname)
    }
    function reloadPage(){
        window.location.reload()
    }
    function is_empty(value){
        var value2 = value.trim()
        if(value2==""){
            return true
        }else{
            return false
        }
    }
    var base = "<?php echo $base?>"
</script>
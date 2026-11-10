<div id="loader" class="loader-off">
    <div id="loader-div"></div>
</div>

<script>
    function setLoader(){
        getE('loader').className = 'loader-on'
    }
    function unsetLoader(){
        getE('loader').className = 'loader-off'
    }
</script>
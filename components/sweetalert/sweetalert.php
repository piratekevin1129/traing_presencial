<div id="sweetalert" class="sweetalert-off">
    <div id="modal-dialog">
        <div class="modal-icon">
            <div></div>
        </div>
        <h1 id="modal-alert-title"></h1>
        <div id="modal-alert-text"></div>
        <button id="modal-alert-btn" onclick="closeModalAlert()">
            <span>Aceptar</span>
        </button>
    </div>
</div>

<script>
    function openModalAlert(data){
        getE('modal-dialog').className = data.status
        getE('modal-alert-title').innerHTML = data.title
        getE('modal-alert-text').innerHTML = data.text
    
        if(data.action!=undefined&&data.action!=null){
            getE('modal-alert-btn').setAttribute('onclick',String(data.action+'()'))
        }else{
            getE('modal-alert-btn').setAttribute('onclick','closeModalAlert()')
        }
    
        getE('sweetalert').className = 'sweetalert-on'
    }
    
    function closeModalAlert(){
        getE('sweetalert').className = 'sweetalert-off'
    }
</script>
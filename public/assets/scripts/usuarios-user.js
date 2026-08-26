function clickConfirmarIngreso(c){
    var course_data_ind = findCourse(c)
    var course_data = null
    console.log(course_data_ind)
    if(course_data_ind!=-1){
        course_data = cursos_data[course_data_ind]
        getE('modal-curso-nombre-txt').innerHTML = course_data.nombre
        getE('modal-curso-image-txt').src = './public/assets/images/cursos/'+course_data.img
        getE('modal-curso-fecha-txt').innerHTML = course_data.fecha
        getE('modal-curso-sede-txt').innerHTML = course_data.sede
        getE('modal-curso-ubicacion-txt').innerHTML = course_data.ubicacion
        getE('modal-curso-facilitador-txt').innerHTML = course_data.facilitador
        
        getE('modal-qr-title-txt').innerHTML = 'Confirmar asistencia'

        var current_date = new Date()
        getE('modal-usuario-hora-txt').innerHTML = String(current_date.getUTCHours()+':'+current_date.getUTCMinutes())
    
        openModal(null,'modal-codigos-qr','Confirmar Ingreso')
    }else{
        alert("Error cargando los datos del curso")
    }
}

var streamLocal = null;

function clickEscanearQr(){
    getE('modal-camara').className = 'modal-camara-on'
    var camara = getE('camara')

    // Compatibilidad para navegadores más antiguos en ES5
      var getMedia = (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) ?
        function(constraints) {
          return navigator.mediaDevices.getUserMedia(constraints);
        } :
        (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);

      if (!getMedia) {
        alert('Tu navegador no soporta el acceso a la cámara web.');
        return;
      }

      // Si es la API moderna basada en Promesas
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
          .then(function(stream) {
            streamLocal = stream;
            camara.srcObject = stream;
          })
          .catch(function(err) {
            console.error('Error al acceder a la cámara:', err);
          });
      } else {
        // Callback tradicional para navegadores muy viejos
        getMedia.call(navigator, { video: true, audio: false }, 
          function(stream) {
            streamLocal = stream;
            if ('srcObject' in camara) {
              camara.srcObject = stream;
            } else {
              camara.src = window.URL.createObjectURL(stream);
            }
          }, 
          function(err) {
            console.error('Error al acceder a la cámara:', err);
          }
        );
      }
}

function clickCerrarQr(){
    getE('modal-camara').className = 'modal-camara-off'
    if (streamLocal) {
        var tracks = streamLocal.getTracks();
        for (var i = 0; i < tracks.length; i++) {
          tracks[i].stop();
        }
        camara.srcObject = null;
        streamLocal = null;
      }
}
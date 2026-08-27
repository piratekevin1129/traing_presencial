var streamLocal = null;
var video_camara = null;
var camara = null;
var camara_ctx = null;

function clickEscanearQr() {
  getE('modal-camara').className = 'modal-camara-on'
  video_camara = document.createElement('video')
  video_camara.onloadedmetadata = function(){
    video_camara.width = 300
    video_camara.height = 300
  }
  camara = getE('qr-canvas')
  camara_ctx = camara.getContext('2d')

  // Compatibilidad para navegadores más antiguos en ES5
  var getMedia = (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) ?
    function (constraints) {
      return navigator.mediaDevices.getUserMedia(constraints);
    } :
    (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);

  if (!getMedia) {
    alert('Tu navegador no soporta el acceso a la cámara web.');
    return;
  }

  // Configuración para solicitar la cámara trasera
  var opciones = {
    video: {
      facingMode: { exact: "environment" } // Usar "environment" sin exact si quieres un fallback automático
    },
    audio: false
  };

  // Si es la API moderna basada en Promesas
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia(opciones)
      .then(function (stream) {
        streamLocal = stream;
        video_camara.srcObject = stream;
        video_camara.setAttribute("playsinline", true);
        video_camara.play();
        renderCamara()

        detectarQR()
      })
      .catch(function (err) {
        console.error('Error al acceder a la cámara:', err);

        // Si falla con 'exact', se intenta de forma flexible
        if (err.name === 'OverconstrainedError' || err.name === 'ConstraintNotSatisfiedError') {
          opciones.video.facingMode = "environment";
          navigator.mediaDevices.getUserMedia(opciones)
          .then(function (stream) {
            streamLocal = stream;
            video_camara.srcObject = stream;
            video_camara.setAttribute("playsinline", true);
            video_camara.play();
            renderCamara()

            detectarQR()
          });
        }
      });
  } else {
    // Callback tradicional para navegadores muy viejos
    getMedia.call(navigator, opciones,
      function (stream) {
        streamLocal = stream;
        if ('srcObject' in video_camara) {
          video_camara.srcObject = stream;
          video_camara.setAttribute("playsinline", true);
          video_camara.play()
        } else {
          video_camara.src = window.URL.createObjectURL(stream);
        }
        renderCamara()
        detectarQR()
      },
      function (err) {
        console.error('Error al acceder a la cámara:', err);
      }
    );
  }
}

var render_camara = null;

function renderCamara(){
  camara.height = 300;
  camara.width = 300;
  camara_ctx.drawImage(video_camara, 0, 0, camara.width, camara.height);
  render_camara = requestAnimationFrame(renderCamara);
}

function detectarQR() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(detectarQR, 500);
  }
}

qrcode.callback = (respuesta) => {
  if (respuesta) {
    //console.log(respuesta);
    //alert("ya detectó algo")
    console.log(respuesta)

    clickCerrarQr()
    confirmarQr()
  }
};

function clickCerrarQr() {
  video_camara.pause()
  video_camara.src = ''
  video_camara.load()
  video_camara.onloadedmetadata = null
  video_camara = null
  camara_ctx.clearRect(0,0,camara.width,camara.height)

  cancelAnimationFrame(render_camara)
  render_camara = null;

  if (streamLocal) {
    var tracks = streamLocal.getTracks();
    for (var i = 0; i < tracks.length; i++) {
      tracks[i].stop();
    }
    camara.srcObject = null;
    streamLocal = null;
  }
  getE('modal-camara').className = 'modal-camara-off'
}
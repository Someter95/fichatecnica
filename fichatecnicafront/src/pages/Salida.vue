<template>
  <q-page>
      <h5 class="text-primary">SALIDA DE EQUIPOS REPARADOS POR DEPARTAMENTO DE SISTEMAS</h5>
      <q-form > 
      <div class="row">
        <div class="col-3 q-pa-xs">
          <q-input filled  label="Fecha Salida" v-model="dato.fechasalida" />
        </div>
      </div>
    </q-form>
    <table border="1" style="widh=100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>CARGO</th>
                <th>UNIDAD</th>
                <th>CODIGO</th>
                <th>MODELO</th>
                <th>PROCESADOR</th>
                <th>MEMORIA RAM</th>
                <th>CAPACIDAD RAM</th>
                <th>DISCO DURO</th>
                <th>CAPACIDAD DISCO</th>
                <th>TARJETA VIDEO</th>
                <th>TARJETA RED</th>
                <th>TIPO MANTENIMIENTO</th>
                <th>OBSERVACION</th>
                <th>FECHA INGRESO</th>
                <th>FECHA SALIDA</th>
            </tr>
        </thead>
        <tbody>
          <tr v-for="(dato,index) in datos" :key=index>
            <td>{{dato.id}}</td>
            <td>{{dato.nombre}}</td>
            <td>{{dato.cargo}}</td>
            <td>{{dato.unidad}}</td>
            <td>{{dato.codigo}}</td>
            <td>{{dato.modelo}}</td>
            <td>{{dato.procesador}}</td>
            <td>{{dato.memoriaram}}</td>
            <td>{{dato.capacidadram}}</td>
            <td>{{dato.discoduro}}</td>
            <td>{{dato.capacidaddd}}</td>
            <td>{{dato.tarjetavideo}}</td>
            <td>{{dato.tarjetared}}</td>
            <td>{{dato.tipomantenimiento}}</td>
            <td>{{dato.observaciones}}</td>
            <td>{{dato.fechaingreso}}</td>
            <td>{{dato.fechasalida}}</td>
            <td><q-btn @click="modificar(dato)" class="glossy" rounded color="deep-orange" label="fecha entrega" /></td>
            <td><q-btn @click="eliminar(dato)"  color="negative" label="eliminar"/></td>
            <td><q-btn @click="imprimir(dato)"  rounded color="positive" label="imprimir" /></td>
          </tr>
        </tbody>
    </table>
  </q-page>
</template>

<script>
import { date } from 'quasar'
import { jsPDF } from "jspdf";
import { useQuasar, QSpinnerGears } from 'quasar'
import { onBeforeUnmount } from 'vue'

export default {
  name: 'PageIndex',
  data(){
    return{
      datos:[],
      dato:{
        fechasalida:date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss')
      },
     }

  },
  created(){
    this.misdatos()
  },
  setup () {
    const $q = useQuasar()
    let timer

    onBeforeUnmount(() => {
      if (timer !== void 0) {
        clearTimeout(timer)
        $q.loading.hide()
      }
    })

  },
  methods:{
    misdatos(){
      this.$axios.get('http://localhost:8000/api/datos')
    .then(res=>{
      //console.log(res.data)
      this.datos=res.data
      })
    },
    crear(){
     this.$axios.post('http://localhost:8000/api/datos',this.dato)
    .then(res=>{
      console.log('si')
      //this.datos=res.data
      })
    },
    eliminar(dato){

      this.$q.loading.show({
          message: 'eliminando de la base de datos <br/><span class="text-positive">cargando...</span>',
          html: true
        })

    //console.log(dato);
     this.$axios.delete('http://localhost:8000/api/datos/'+dato.id)
    .then(res=>{
      console.log('si')
      this.misdatos()
        timer = setTimeout(() => {
          this.$q.loading.hide()
          timer = void 0
        }, 3000)
      })
      showLoading ()
    },
    modificar(dato){

         this.$q.loading.show({
          message: 'Colocando <b>fecha</b>de entrega<br/><span class="text-positive">cargando...</span>',
          html: true
        })
       // console.log(dato)
       this.$axios.put('http://localhost:8000/api/datos/'+dato.id, this.dato).then(res=>{
        console.log(res.data)
        
      //this.productos=res.data
       this.misdatos()
        })
        timer = setTimeout(() => {
          this.$q.loading.hide()
          timer = void 0
        }, 3000)

    },
    imprimir(dato){
      const doc = new jsPDF();
      var logo = new Image();
 this.$q.loading.show({
          message: 'Generando PDF<br/><span class="text-positive">cargando...</span>',
          html: true
        })
        logo.src ="https://upload.wikimedia.org/wikipedia/commons/8/8e/Escudo_Oruro.jpg";
        doc.addImage(logo, 'JPEG', 30, 10, 20, 30);

          doc.setTextColor(33, 47, 61)
          doc.setFontSize(15)
          doc.text('FICHA TECNICA',90,30);
          doc.text('DEPARTAMENTO DE SISTEMAS',70,40);

          doc.setTextColor(33, 47, 61)
          doc.setFontSize(10)
          doc.text('DATOS FUNCIONARIO/UNIDAD',30,50);

          doc.setTextColor(23, 32, 42)
          doc.setFontSize(10)
          doc.text("Nombre :", 30, 60);
          doc.text(dato.nombre, 70, 60);
          doc.text("Cargo :", 30, 70);
          doc.text(dato.cargo, 70, 70);
          doc.text("Unidad :", 30, 80);
          doc.text(dato.unidad, 70, 80);

          doc.setTextColor(33, 47, 61)
          doc.setFontSize(10)
          doc.text('DATOS EQUIPO',30,100);

          doc.setTextColor(23, 32, 42)
          doc.setFontSize(10)
          doc.text("Codigo :", 30, 110);
          doc.text(dato.codigo, 70, 110);
          doc.text("Modelo :", 30, 120);
          doc.text(dato.modelo, 70, 120);

          doc.text("Procesador :", 30, 130);
          if(dato.procesador!=undefined)
          doc.text(dato.procesador, 70, 130);
          doc.text("Memoria RAM :", 30, 140);
          if(dato.memoriaram!=undefined)
          doc.text(dato.memoriaram, 70, 140);
          doc.text("Capacidad GB :", 110, 140);
          if(dato.capacidadram!=undefined)
          doc.text(dato.capacidadram, 150, 140);
          doc.text("Disco Duro :", 30, 150);
          if(dato.discoduro!=undefined)
          doc.text(dato.discoduro, 70, 150);
          doc.text("Capacidad GB :", 110, 150);
          if(dato.capacidaddd!=undefined)
          doc.text(dato.capacidaddd, 150, 150);
          doc.text("Tarjeta de Video :", 30, 160);
          if(dato.tarjetavideo!=undefined)
          doc.text(dato.tarjetavideo, 70, 160);
          doc.text("Tarjeta de Red :", 30, 170);
          if(dato.tarjetared!=undefined)
          doc.text(dato.tarjetared, 70, 170);
          doc.text("Tipo de Mantenimiento :", 30, 190);
          doc.text(dato.tipomantenimiento, 70, 190);
          doc.text("Observaciones :", 30, 200);
          doc.text(dato.observaciones, 70, 200);
          doc.text("Fecha de Ingreso :", 30, 220);
          doc.text(dato.fechaingreso, 60, 220);
          doc.text( "Fecha de Salida :", 110, 220);
          doc.text(dato.fechasalida, 140, 220);

          doc.text( "Firma y Sello", 30, 250);
          doc.text( "Unidad Solicitante", 30, 255);


          doc.setLineWidth(1)
          doc.line(28, 55, 180, 55)
          doc.line(28, 85, 180, 85)
          doc.line(28, 55, 28, 85)
          doc.line(180, 55, 180, 85)

          doc.line(28, 105, 180, 105)
          doc.line(28, 105, 28, 175)

          doc.line(28, 175, 180, 175)
          doc.line(180, 105, 180, 175)

        

          doc.save("reporte.pdf");

         timer = setTimeout(() => {
          this.$q.loading.hide()
          timer = void 0
        }, 3000)
        },

    
  } 
}
</script>

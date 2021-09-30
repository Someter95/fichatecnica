<template>
  <q-page >
      <h5 class="text-primary">EQUIPOS REPARADOS POR EL DEPARTAMENTO DE SISTEMAS</h5>
    <table border="5" style="widh=100%" title="Treats"
      :rows="rows"
      :columns="columns"
      row-key="name">
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
                <th>CAPACIDAD RAM dc</th>
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
            </tr>
        </tbody>
    </table>
  </q-page>
</template>

<script>

export default {
  name: 'PageIndex',
  data(){
    return{
      datos:[]    }
  },
  created(){
    this.$axios.get('http://localhost:8000/api/datos')
    .then(res=>{
      //console.log(res.data)
      this.datos=res.data
      })


  } 
}
</script>
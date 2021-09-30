<template>
  <q-page>
    <q-form @submit.prevent="crear"> 
      <q-markup-table flat bordered fixed-center	>
        <thead class="bg-primary">
          <tr>
            <th colspan="6" >
              <div class="row no-wrap items-center">
              <div class="text-h4 q-ml-md text-white">DATOS FUNCIONARIO/UNIDAD</div>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="bg-grey-3">
          <tr>
            <td  class="text-left" colspan="1">Nombre</td>
            <td ><q-input filled v-model="dato.nombre" /></td>
            </tr>
          <tr>
            <td class="text-left" colspan="1" >Cargo</td>
            <td ><q-input filled v-model="dato.cargo"/></td>
          </tr>
          <tr>
           <td class="text-left" colspan="1" >Unidad</td>
           <td class="text-left" colspan="2"><q-input filled v-model="dato.unidad"/></td>
          </tr>
        </tbody>
      </q-markup-table>

      <q-markup-table flat bordered>
        <thead class="bg-accent">
          <tr>
            <th colspan="5">
               <div class="row no-wrap items-center">
              <div class="text-h4 q-ml-md text-white">DATOS EQUIPO</div>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="bg-grey-3" >
          <tr>
            <td colspan="1" class="text-left">Codigo</td>
            <td colspan="3"><q-input class="full-width full-height" filled v-model="dato.codigo"/></td>
          </tr>
          <tr>
            <td class="text-left">Equipo</td>
            <td><q-select outlined v-model="dato.modelo" :options="optionsmaquina"/></td>
            <td class="text-left">Procesador</td>
            <td><q-select outlined v-model="dato.procesador" :options="optionsprocesador"/></td>
          </tr>
          <tr>
            <td class="text-left">Memoria RAM</td>
            <td><q-select outlined v-model="dato.memoriaram" :options="optionsmemoria"/></td>
            <td class="text-left">Capacidad RAM</td>
            <td><q-select outlined v-model="dato.capacidadram" :options="optionscapacidadram"/></td>
          </tr>
          <tr>
            <td class="text-left">Disco duro</td>
            <td><q-select outlined v-model="dato.discoduro" :options="optionsdiscoduro"/></td>
            <td class="text-left">Capacidad Disco Duro</td>
            <td><q-select outlined v-model="dato.capacidaddd" :options="optionscapacidaddiscoduro"/></td>
          </tr>
          <tr>
            <td class="text-left">Tarjeta Video</td>
            <td colspan="3"><q-select outlined v-model="dato.tarjetavideo" :options="optionstarjetavideo"/></td>
          </tr>
          <tr>
            <td class="text-left">Tarjeta Red</td>
            <td colspan="3"><q-select outlined v-model="dato.tarjetared" :options="optionstarjetared"/></td>
          </tr>
        </tbody>
      </q-markup-table> 

      <q-markup-table flat bordered>
        <thead class="bg-secondary">
          <tr>
            <th colspan="5">
              <div class="row no-wrap items-center">
                <div class="text-h4 q-ml-md text-white">TRABAJO EN EL EQUIPO</div>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="bg-grey-3">
          <tr>
            <td class="text-left">Tipo Mantenimiento</td>
            <q-select outlined v-model="dato.tipomantenimiento" :options="options"/>
          </tr>
          <tr>
            <td class="text-left">Observaciones</td>
            <q-input filled v-model="dato.observaciones"/>
          </tr>
          <tr>
            <td class="text-left">Fecha de ingreso</td>
            <q-input filled v-model="dato.fechaingreso"/>
          </tr>
        </tbody>
      </q-markup-table>  
      <div class="col-3 flex flex-center">
            <q-btn type=submit @click="showLoading" color="positive" icon-right="send" label="Enviar"/>
      </div>
    </q-form>
  </q-page>
</template>




<script>
import { date } from 'quasar'
import { useQuasar, QSpinnerFacebook } from 'quasar'
import { onBeforeUnmount } from 'vue'

export default {
  name: 'PageIndex',
  
  data(){
    return{
      datos:[],
      dato:{
        fechaingreso:date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm:ss')
      },
      options: [
        'Preventivo', 'Correctivo'
      ],
      optionsmaquina: [
        'Computadora','laptop', 'Impresora', 'otros'
      ],
      optionsprocesador: [
        'Core i3','Core i5','Core i7','Pentium', 'Celeron', 'Atom'
      ],
      optionsmemoria: [
        'Kingston','HyperX','Samsung','Corsair'
      ],
      optionscapacidadram: [
        '2 Gb','4 Gb','8 Gb','16 Gb','32 Gb','64 Gb'
      ],
      optionsdiscoduro: [
        'Toshiba','Samsung','Seagate','Verbatim'
      ],
      optionscapacidaddiscoduro: [
        '320 Gb','500 Gb','1 TB','2 TB'
      ],
      optionstarjetavideo: [
        'NVIDIA','AMD'
      ],
      optionstarjetared: [
        'Intel','Kontron'
      ],

   }

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

    return {
      showLoading () {
        $q.loading.show({
          spinner: QSpinnerFacebook,
          spinnerColor: 'yellow',
          spinnerSize: 140,
          backgroundColor: 'purple',
          message: 'Enviando a la Base de Datos',
          messageColor: 'black'
        })

        // hiding in 3s
        timer = setTimeout(() => {
          $q.loading.hide()
          timer = void 0
        }, 3000)
      }
    }
  },
  created(){
    this.misdatos()
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
   
    
  } 
}
</script>



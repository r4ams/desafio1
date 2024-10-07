<script setup>
  import { ref, onMounted } from 'vue'
  import AppLayout from '@/Layouts/AppLayout.vue';
  import Welcome from '@/Components/Welcome.vue';
  import BmButton from '@/bmSystem/Components/Buttons/BmButton.vue';
  import AlertSuccessful from '@/bmSystem/Components/Forms/AlertSuccessful.vue';
  import { 
    Badge,
    TheCard,
    Modal
  } from 'flowbite-vue';
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>
    <AlertSuccessful class="my-6" v-show="$page.props.flash.successful" :message="$page.props.flash.successful"/>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
          <div class="grid grid-cols-2 gap-2">
            <TheCard
              img-alt="Desk"
              img-src="/images/agregar-pacientes.jpeg"
              variant="horizontal"
              class="hover:bg-white"
            >
              <div class="p-5">
                <div class="text-center">
                  <bm-button @click="createRecord()" size="lg">
                    Agregar Paciente
                  </bm-button>
                </div>
              </div>
            </TheCard>
            <TheCard
              img-alt="Desk"
              img-src="/images/listado-pacientes.jpeg"
              variant="horizontal"
              class="hover:bg-white"
            >
              <div class="p-5">
                <div class="text-center">
                  <bm-button @click="showRecords()" size="lg">
                    Ver Pacientes
                  </bm-button>
                </div>
              </div>
            </TheCard>
          </div>  
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
  components: {
  },
  props: {
      records: Object,
      types: Object
  },
  data(){
    return{
      flash: this.$page.props.flash,
    }
  },
  computed: {
    // Accede a los flash messages de Laravel a través de Inertia
    flashMessage() {
      console.log(this.$page.props.flash.successful);
      
      return this.$page.props.flash.successful || '';
    } 
  },
  methods:{
    createRecord(){
      this.$inertia.visit('/patients/create')
    },
    showRecords(){
      this.$inertia.visit('/patients')
    },
    closeAlert() {
      this.flash.successful = '';
    },
  },
}
</script>

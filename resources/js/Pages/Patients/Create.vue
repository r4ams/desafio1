<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Crear Paciente">
        <div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="mt-8 text-2xl">
                    <p class="text-2xl font-bold">Crear Paciente</p>
                    <p class="text-sm">Completa la informacion indicada para registrar un nuevo paciente</p>
                    <br>
                    <div class="flex flex-col items-center">
                        <img v-if="url" class="w-24 mt-4 h-24 rounded-full"  :src="url" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form method="post" @submit.prevent="submit">
                            <div class="h-auto grid grid-cols-2 gap-4 content-center">
                                <div class="py-2 items-center">
                                    <InputNew
                                        v-model="form.name"
                                        block
                                        class="mt-1 block w-full"
                                        id="name"
                                        name="name"
                                        label="Ingresar nombres"
                                    />
                                    <div v-if="form.errors.name" class="text-red-500">{{form.errors.name}}</div>
                                </div>
                                <div class="py-2 items-center">
                                    <InputNew
                                        v-model="form.dui"
                                        block
                                        class="mt-1 block w-full"
                                        id="dui"
                                        name="dui"
                                        label="Ingresar Dui"
                                    />
                                    <div v-if="form.errors.dui" class="text-red-500">{{form.errors.dui}}</div>
                                </div>
                            </div>
                            <div class="h-auto grid grid-cols-2 gap-4 content-center">
                                <div class="py-2 items-center">
                                    <select class="w-full p-2.5 border border-flatBlue-500 rounded-3xl outline-none
                                        text-gray-700 text-sm mt-1 block w-full" v-model="form.gender" placeholder="Select a country">
                                        <option disabled value="" selected>Seleccione un Genero</option>
                                        <option v-for="(gender,index) in collectionGender" :value="gender.value" :key="index">
                                            {{gender.name}}
                                        </option>
                                    </select>
                                    <div v-if="form.errors.gender" class="text-red-500">{{form.errors.gender}}</div>
                                </div>
                                <div class="py-2 items-center">
                                    <select class="w-full p-2.5 border border-flatBlue-500 rounded-3xl outline-none
                                        text-gray-700 text-sm mt-1 block w-full" v-model="form.blood_type" placeholder="Select a country">
                                        <option disabled value="" selected>Seleccione un Tipo de Sangre</option>
                                        <option v-for="(blood_type,index) in collectionBloodType" :value="blood_type.value" :key="index">
                                            {{blood_type.name}}
                                        </option>
                                    </select>
                                    <div v-if="form.errors.blood_type" class="text-red-500">{{form.errors.blood_type}}</div>
                                </div>
                            </div>
                            <div class="h-auto grid grid-cols-2 gap-4 content-center">
                                <div class="py-2 items-center">
                                    <select class="w-full p-2.5 border border-flatBlue-500 rounded-3xl outline-none
                                        text-gray-700 text-sm mt-1 block w-full" v-model="form.blood_pressure" placeholder="Select a country">
                                        <option disabled value="" selected>Seleccione una Presion Arterial</option>
                                        <option v-for="(blood_pressure,index) in collectionBloodPressure" :value="blood_pressure.value" :key="index">
                                            {{blood_pressure.name}}
                                        </option>
                                    </select>
                                    <div v-if="form.errors.blood_pressure" class="text-red-500">{{form.errors.blood_pressure}}</div>
                                </div>
                            </div>
                            <div class="h-auto grid grid-cols-2 gap-4 content-center text-center mt-10">
                                <div class="py-2 items-center">
                                    <bm-button id="cancelar" @click="goBack()" type="secondary" size="lg">Regresar al paso anterior</bm-button>
                                </div>
                                <div class="py-2 items-center">
                                    <bm-button id="guardar" @click="submit()" size="lg">Guardar Datos</bm-button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head, router } from "@inertiajs/vue3";
import InputNew from  '@/bmSystem/Components/Inputs/BmInput.vue';
import BmSelect from  '@/bmSystem/Components/Selects/BmSelect.vue';
import BmButton from "@/bmSystem/Components/Buttons/BmButton.vue";

export default {
    name: "Create",
    components: {
        InputNew,
        BmButton,
        Head,
        BmSelect
    },
    props: [],
    data(){
      return {
        url: null,
        placeholder: 'Selecciona un Rol',
        collectionGender: [
          {name: "Hombre", value: "male"},
          {name: "Mujer", value: "female"}
        ],
        collectionBloodType: [
          {name: "A", value: "a"},
          {name: "B", value: "b"},
          {name: "AB", value: "ab"},
          {name: "O", value: "o"}
        ],
        collectionBloodPressure: [
          {name: "Baja", value: "low"},
          {name: "Media", value: "medium"},
          {name: "Alta", value: "high"}
        ],
        form: useForm({
          name: null,
          dui: null,
          gender: '',
          blood_type: '',
          blood_pressure: ''
        })
      }
    },
    computed: {
    },
    methods: {
        submit() {
            this.form.post(route('patients.store'), {
                errorBag: 'errorBag',
                preserveScroll: true
            });
        },
        goBack() {
            router.visit('/dashboard', { preserveScroll: true })
        }

    },
}

</script>

<style scoped>
form {
    margin-top: 20px;
}
</style>

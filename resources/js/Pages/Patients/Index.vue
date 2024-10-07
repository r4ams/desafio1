<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { 
    Modal
  } from 'flowbite-vue';
</script>

<script >
import {router, Head} from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";
import BmButton from "@/bmSystem/Components/Buttons/BmButton.vue";
import TreeChart from "vue-tree-chart-3";
import VueTree from "@ssthouse/vue3-tree-chart";
import "@ssthouse/vue3-tree-chart/dist/vue3-tree-chart.css";


export default {
    components: {
      BmButton,
      TreeChart
    },
    props: {
      patients: Object,
    },
    data(){
        return{
          richMediaData: {
            name: 'James',
            value: "Pacientes",
            avatar:
              'https://gravatar.com/avatar/db51fdaf64d942180b5200ca37d155a4?s=400&d=robohash&r=x',
            children: [
              {
                name: 'Bob',
                value: 'Genero',
                avatar:
                  'https://gravatar.com/avatar/16b3b886b837257757c5961513396a06?s=400&d=robohash&r=x',
                children: [
                  {
                    name: 'C1',
                    value: 100,
                    avatar:
                      'https://gravatar.com/avatar/4ee8775f23f12755db978cccdc1356d9?s=400&d=robohash&r=x'
                  },
                  {
                    name: 'C2',
                    value: 300,
                    avatar:
                      'https://gravatar.com/avatar/d3efa8fa639bdada96a7d0b4372e0a96?s=400&d=robohash&r=x'
                  },
                  {
                    name: 'C3',
                    value: 200,
                    avatar:
                      'https://gravatar.com/avatar/4905bc3e5dc51a61e3b490ccf1891107?s=400&d=robohash&r=x'
                  }
                ]
              },
              {
                name: 'Smith',
                value: 'Sangre',
                avatar:
                  'https://gravatar.com/avatar/d05d081dbbb513180025300b715d5656?s=400&d=robohash&r=x',
                children: [
                  {
                    name: 'S1',
                    value: 230,
                    avatar:
                      'https://gravatar.com/avatar/60c1e69e690d943c5dc06568148debc4?s=400&d=robohash&r=x'
                  }
                ]
              },
              {
                name: 'Jackson',
                value: 'Presión',
                avatar:
                  'https://gravatar.com/avatar/581f7a711c815d9671c35ebd815ec1e4?s=400&d=robohash&r=x'
              }
            ]
          },
          treeConfig: { nodeWidth: 120, nodeHeight: 80, levelHeight: 200 },
          direction: 1,
          isQAModal: false,
          nodeInformation: null
        }
    },
    methods:{
      goBack() {
        router.visit('/dashboard', { preserveScroll: true })
      },
      setTypeOfTree(value){
        this.direction = value;
        this.nodeInformation = null;
      },
      closeQAModal () {
        this.isQAModal = false
      },
      showInformation(node){
        this.isQAModal = true;
        this.nodeInformation = node;
      },
      clickNode: function(node){
        // eslint-disable-next-line
        console.log(node)
        if (node?.children) {
            console.log("El nodo 'address.city' existe y tiene un valor.");
        } else {
            console.log("El nodo 'address.city' no existe.");
        }
        this.isQAModal = true;
        this.nodeInformation = node;
      }
    }
}
</script>


<template>
  <AppLayout title="Lista de Pacientes">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
          <div class="p-6 sm:px-10 bg-white border-b border-gray-200">
            <div class="h-auto grid grid-cols-2 gap-2 content-center pb-16">
              <div class="mt-8 text-2xl">
                <p class="text-2xl font-bold">Pacientes</p>
                <p class="text-sm">Pacientes existentes de la plataforma</p>
              </div>
              <div
                class="row flex items-end justify-end"
              >
                <bm-button @click="goBack()" size="lg">
                  Regresar
                </bm-button>
              </div>
            </div>
            <div class="h-auto grid grid-cols-2 gap-2 content-center pb-16">
              <div
                class="row flex items-center justify-center"
              >
                <bm-button @click="setTypeOfTree(2)" size="lg" type="secondary">
                  Vertical
                </bm-button>
              </div>
              <div
                class="row flex items-center justify-center"
              >
                <bm-button @click="setTypeOfTree(1)" size="lg" type="secondary">
                  Horizontal
                </bm-button>
              </div>
            </div>
            <div class="flex items-stretch">
              <div class=" w-full py-4">
                <div class="w-full">
                  <div class="overflow-x-auto bg-white shadow-sm max-w-8xl sm:rounded-lg">
                    <div v-if="this.direction == 1">
                      <TreeChart class="mx-auto" :json="this.patients.original" @click-node="clickNode"/>
                    </div>
                    <div v-else>
                      <vue-tree
                        style="width: 1000px; height: 100vh;"
                        :dataset="this.patients.original"
                        :config="treeConfig"
                        direction="'horizontal'"
                        :collapseEnabled="true"
                      >
                        <template  v-slot:node="{ node, collapsed }">
                          <div
                            class="rich-media-node"
                            :style="{ border: collapsed ? '2px solid grey' : '' }"
                            v-if="node.children !== null"                
                          >
                            <img
                              :src="node.avatar"
                              style="width: 48px; height: 48px; border-raduis: 4px; margin: 0 auto;"
                            />
                            <span style="padding: 4px 0; font-weight: bold; width: 100%;">
                              {{ node.value }}
                            </span>
                          </div>
                          <div
                            class="rich-media-node"
                            :style="{ border: collapsed ? '2px solid grey' : '' }"   
                            v-else      
                            @click="showInformation(node)"       
                          >
                            <img
                              :src="node.avatar"
                              style="width: 48px; height: 48px; border-raduis: 4px; margin: 0 auto;"
                            />
                            <span v-if="node.children !== null" style="padding: 4px 0; font-weight: bold; width: 100%;">
                              {{ node.value }}
                            </span>
                            <span v-else style="padding: 4px; font-weight: bold; width: 100%;">
                              {{ node.value }}
                            </span>
                          </div>
                        </template>
                      </vue-tree>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal size="2xl" v-if="isQAModal" @close="closeQAModal">
      <template #header>
        <div class="flex items-center text-xl text-bmBlue text-center">
          Información del Paciente
        </div>
      </template>
      <template #body>
        <div class="max-h-96 overflow-y-auto border-b border-[#A8A9AB] pb-4 mb-4">
          <h3 class="text-[#0038AE] font-bold text-lg pb-2">
            {{ nodeInformation.full_name }}
          </h3>
          <p class="text-[#5C6569] text-md">
            
            <strong class="pr-2">Genero:</strong>{{ nodeInformation.gender }} <br>
            <strong class="pr-2">Número de dui:</strong>{{ nodeInformation.value }} <br>
            <strong class="pr-2">Tipo de Sangre:</strong>{{ nodeInformation.blood_type }}<br>
            <strong class="pr-2">Presión:</strong>{{ nodeInformation.blood_pressure }}
          </p>
        </div>
        <div class="flex justify-around pt-5 pb-3">
          <bm-button @click="closeQAModal" :typeNative="'submit'" >Cerrar</bm-button>
        </div>
      </template>
    </Modal>
  </AppLayout>
</template>

<style>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.rich-media-node {
  width: 120px;
  padding: 8px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  color: white;
  background-color: #f7c616;
  border-radius: 4px;
  text-align: center;
}

.avat{
  border: none !important;
}
</style>
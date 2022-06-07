<template >

<div v-if="infoSalle" >


<div class="card col-8 mx-auto mt-2" v-for="(item,index) in infoSalle" :key="index">

<div class="d-flex flex-wrap  justify-content-center"  >
  <div class="flex-shrink-1 align-self-center" >
     <img  class="ms-1 rounded" :src="require ('../image/' + item.img_salle)" alt="" srcset="" style="width: 16rem;">
  </div>
  <div class="flex-grow-1 ms-3 ">
    <h5>{{item.nom_salle}} </h5>
     <p class="text-center">Adresse :  {{item.adresse_salle}}</p>
     <p class="text-center">Email :  {{item.email_salle}}</p>
     <p class="text-center">Telephone :   {{item.numero_tel_salle}}</p>
     <h5 class="text-center">planning</h5>
     <div class="d-flex justify-content-center">
       <input type="datetime-local"  v-model="time" />
     
    <button type="button" class="btn btn-outline-success  " @click="add(item)">valider</button>
    {{reservation}}
     </div>
  </div>
</div>

</div>

</div>

<div v-else class="card">
  <div class="card-body">
    pas de salle enregistrer ....
  </div>
</div>
      
</template>
<script>


import axios from "axios";
export default {
  name:"monAffichage",

    data(){
        return {

                ff:'',
                status:false,
               infoSalle:[],
               time:'',

          
        }
     
        
    },
       computed:{
         reservation(){
           return this.$store.state.reservation;
         }


       },
    methods: {

      change(){

        this.status =!this.status
      },
       add(item){
                console.log(this.time);
                var  change=this.infoSalle.find(cost=>cost.id_salle === item.id_salle )
            console.log(change.id_salle)
            console.log(this.time)
            item.quantity=1
      
     

   let data = new FormData();
    data.append("id",change.id_salle);
    data.append("slot",this.time);
    data.append("id_user", this.$store.state.User.id)
    
      this.$store.dispatch("add",data);
    
          

            },
          
      
    },
     created() {
            axios
        .post(
          "http://localhost/mon_projet_vue.js/src/php/index.php?url=display"
         
        )
        .then((res) => {
          if(res.data == false){

            this.infoSalle='';
          }else{
            this.infoSalle=res.data;
          }
          
          console.log(res.data);
        });
       
     },

       
       
    
}
</script>
<style>



    
</style>
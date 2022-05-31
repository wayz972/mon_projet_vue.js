<template>
  <div class=" container d-flex flex-wrap ">
    <div class="col-6 col-lg  card " v-for="(item, index) in tabs" :key="index">
      
      <h6 class="fs-5"> nom salle:  {{item.nom_salle}}</h6>
      <p class="text-center">{{ item.creneaux }}</p>
      
      <div class="col">
        <button class="btn btn-danger" type="submit" @click="findIdSlot(item)">supprimer</button>
        
      </div>
    </div>
  </div>

</template>
<script>
import axios from "axios";

export default {
  name:"mmonCreneaux",
  data() {
    return {
      tabs: "",
      
    };
  },
  methods:{

    findIdSlot(item){
      //trouver id du slot
      var change = this.tabs.find((cost) => cost.id_creneaux === item.id_creneaux);
     

      // supprimer le slot avec id 
      let data = new FormData();
      data.append("id",change.id_creneaux);
       data.append("creneaux",change.creneaux);
      data.append('id_user',this.$store.state.User.id)
      axios
      .post("http://localhost/mon-projet/src/php/index.php?url=slotDelete", data)
      .then((response) => {
  console.log(response.data);
      });
      window.location.reload();  

    }


  },
  created() {
    let data = new FormData();
    data.append("id", this.$store.state.User.id);
    axios
      .post("http://localhost/mon-projet/src/php/index.php?url=slot", data)
      .then((response) => {
        this.tabs= response.data;
        console.log(response.data);
      });
  },
};
</script>

<style>
</style>
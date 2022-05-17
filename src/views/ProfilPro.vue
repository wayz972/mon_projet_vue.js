<template>







<div class="d-flex justify-content-center ">

<div id="myToast" class="toast align-items-center text-white bg-primary border-0 " role="alert" aria-live="assertive" aria-atomic="true " data-bs-autohide="false">
  <div class="d-flex ">
    <div class="toast-body d-flex">
      <p> enregistrer</p>
      <div >
<fa id="icon" :icon="['fa','check']"/>
      </div>
    </div>
  </div>
  <div class="progress" style="height: 8px;">
  <div class="progress-bar bg-success" role="progressbar" :style="{'width':pourcentage+'%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>

</div>

<!--   ----------------------------------------------------------   -->

<!--   ----------------------------------------------------------   -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-4 pb-5 ">
        <!-- Account Sidebar-->
        <div class="author-card">
          <div class="author-card-profile mt-3 d-flex justify-content-center">
            <div class=" col-8  card">
              <img
                class="rounded"
                :src="require('../image/' + this.img)"
                alt=""
                srcset=""
              />
              <br />
              <input
                type="file"
                class="form-control"
                autocomplete="newimg"
                @change="previewFiles"
                multiple
              />
            </div>
            <div class="author-card-details">
              <h5 class="author-card-name text-lg"></h5>
            
            </div>
          </div>
        </div>
      </div>
      <!-- Profile Settings-->
      <div class="col d-flex justify-content-center   border rounded-1">
        <form
          class="row"
          method="post"
          v-on:submit.prevent
          enctype="multipart/form-data"
        >
          <div class="col-md-6">
            <div class="form-group">
              <label for="account-fn">Nom</label>

              <input
                class="form-control"
                type="text"
                id="account-fn"
                required=""
                v-model="name"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="account-ln">Prenom</label>
              <input
                class="form-control"
                type="text"
                id="account-ln"
                required=""
                v-model="fname"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="account-email">E-mail </label>
              <input
                class="form-control"
                type="email"
                id="account-email"
                disabled=""
                v-model="email"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="account-phone">numero Telephone</label>
              <input
                class="form-control"
                type="text"
                id="account-phone"
                required=""
                v-model="phone"
              />
            </div>
          </div>
          <div class="col-12">
            <hr class="mt-2 mb-3" />

            <div v-if="this.change">
              <div class="d-flex justify-content-between">
                <button
                  class="btn btn-style-1 btn-primary"
                  type="button"
                  data-toast=""
                  @click="addsubmit()"
                >
                  enregistrer
                </button>
                <div>
                  <button class="btn btn-outline-primary" @click="addsalle()">
                    creation salle
                  </button>
                </div>
              </div>
              <div class="col">
                <div
                  class="row g-0 bg-light position-relative"
                  v-for="(item, index) in txt"
                  :key="index"
                >
                  <div class="col-md-6 mb-md-0 p-md-4">
                    <img
                      class="rounded"
                      :src="require('../image/' + item.img_salle)"
                      alt=""
                      srcset=""
                      style="width: 15rem"
                    />
                  </div>
                  <div class="col-md-5 p-4 ps-md-0">
                    <h5 class="mt-0">{{ item.nom_salle }}</h5>
                    <p>phone :{{ item.numero_tel_salle }}</p>
                    <p>Email :{{ item.email_salle }}</p>
                    <p>Adresse : {{ item.adresse_salle }}</p>
                    <p>ville : {{item.zip_code}} {{item.name}}</p>
                    <!-- <a href="#" class="stretched-link">Go </a> -->
                    <button
                      type="submit"
                      class="btn btn-danger"
                      @click="deletesalle(item)"
                    >
                      supprimer
                    </button>
                  </div>
                  <div>
                     <p>vos réservations</p>
                  </div>
                 
                </div>
              </div>
            </div>

            <div v-else>
              <div
                class="
                  d-flex
                  flex-wrap
                  justify-content-between
                  align-items-center
                "
              >
                <button
                  class="btn btn-style-1 btn-primary"
                  type="button"
                  data-toast=""
                  @click="enregister()"
                >
                  enregistrer
                </button>
                <div>
                  <button class="btn btn-success" @click="findSalle()">
                    voir les sallles
                  </button>
                </div>
              </div>

              <div>
                <Slot />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <Footer />
 
</template>

<script>
import { Toast } from 'bootstrap/dist/js/bootstrap.esm.min.js'
import Slot from "../components/Slot.vue";
import axios from "axios";
import Footer from "../components/Footer.vue";
export default {
  components: { Footer, Slot },
  //  props: ["id", "name", "fname", "email", "phone", "status"],
  // $emits: ["changetoogle", "update-profil"],
  data() {
    return {
  
       name: this.$store.state.User.name,
       fname: this.$store.state.User.fname,
      email: this.$store.state.User.email,
      phone: this.$store.state.User.phone, 
      img: this.$store.state.User.img,
      change:this.$store.state.User.change,
      newimg: "",
      pourcentage:0,
      txt: "",
      value:"",
    };
  },
  watch: {
   
  },
  //charger la salle 
  created() {
    let data = new FormData();
    data.append("id", this.$store.state.User.id);
    axios
      .post(
        "http://localhost/mon-projet/src/php/index.php?url=displaysalleUser",
        data
      )
      .then((response) => {
        this.txt = response.data;
        console.log(response.data);
      });
  },

  methods: {

    //supprimer la salle 
    deletesalle(item) {
      var change = this.txt.find((cost) => cost.id_salle === item.id_salle);
      console.log(change.id_salle);

      alert("votre salle est supprimer");
      let data = new FormData();
      data.append("id_salle", change.id_salle);
      data.append("id", this.$store.state.User.id);
      axios
        .post("http://localhost/mon-projet/src/php/index.php?url=delete", data)
        .then((response) => {
          response.data;
          console.log(response.data);
          window.location.reload(); 
        });
    },
// recuperer le nom de l'image
    previewFiles(event) {
      this.newimg = event.target.files[0];
      console.log(this.newimg);
    },

    changetoogle() {
      this.change = !this.change;
      this.$emit("changetoogle");
    },

    // mise a jour du pro 
    addsubmit() {
      let data = new FormData();
      
      data.append("phone", this.phone);
      data.append("name", this.name);
      data.append("fname", this.fname);
      data.append("image", this.newimg);
      data.append("email", this.email);
      data.append("id", this.$store.state.User.id);
      data.append("img",this.$store.state.User.img); // je transmet l'ancienne image pour efffacer
      axios
        .post("http://localhost/mon-projet/src/php/index.php?url=update",data)
        .then((response) => {
          response.data
            console.log(response.data)
         
           if (response.data.errorImage ==undefined) {
                sessionStorage.setItem("name", response.data.nom_professionnel);
          sessionStorage.setItem("email", response.data.email_professionnel);
          sessionStorage.setItem("fname", response.data.prenom_professionnel);
          sessionStorage.setItem("img", response.data.img_professionnel);
          sessionStorage.setItem("phone",response.data.telephone_professionnel );
                  console
           } else {
          console.log(response.data.errorImage)
             
           }
      
        });
      this.change = true;
      this.check();
        this.toasts(); // 
    },
 
 //chargement de la barre 
    check(){
      this.value=setInterval(() => {
        if(this.pourcentage==120){
          
          clearTimeout(this.value)
          console.log(this.value)
             this.$router.go();
        }
          this.pourcentage ++;
          console.log(this.value)
        }, 30);

    },


 //mise a jour du client 
    enregister() {
      let data = new FormData();
      data.append("phone", this.phone);
      data.append("name", this.name);
      data.append("fname", this.fname);
      data.append("image", this.newimg);
      data.append("email", this.email);
      data.append("id", this.$store.state.User.id);
      axios
        .post(
          "http://localhost/mon-projet/src/php/index.php?url=enregister",
          data
        )
        .then((response) => {
          response.data;
          console.log(response.data);

          if(response.data.errorImage ==undefined){

              sessionStorage.setItem("name", response.data.nom_client);
          sessionStorage.setItem("email", response.data.email_client);
          sessionStorage.setItem("fname", response.data.prenom_client);
          sessionStorage.setItem("img", response.data.img_client);
          sessionStorage.setItem("phone",response.data.tel_client);
          }else{
             console.log(response.data.errorImage)
          }
          
        // 
           
        });

        this.check();
        this.toasts();
     
    },



    addsalle() {
      this.$router.push("/salle");
    },

    findSalle() {
      this.$router.push("/display");
    },

toasts(){
  var option ={
    animation:true,
    delay: 2000,
  };
  var element = document.getElementById("myToast");
   var myToast =  new Toast(element,option)
  
        myToast.show();
         this.check()
   
}



  },
};
</script>

<style scoped>
/* 
.card {
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    border-radius: 6px;
    color: rgba(0, 0, 0, 0.87);
    background: #fff;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

.card .card-image {
    height: 60%;
    position: relative;
    overflow: hidden;
    margin-left: 15px;
    margin-right: 15px;
    margin-top: -30px;
    border-radius: 6px;
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}

.card .card-image img {
    width: 100%;
    height: 100%;
    border-radius: 6px;
    pointer-events: none;
} */


/*  */
</style>

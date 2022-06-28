<template>

  <transition name="fade">
    <div
      v-if="show"
      :class="[this.class ? 'alert alert-success' : 'alert alert-danger']"
      role="alert"
    >
      <p class="text-center fs-3">
        {{ message }}
        <span :style="this.class ? 'color:green' : 'color:red'">
          <fa v-if="this.class" :icon="['fa', 'check']" />
          <fa v-else id="icon" :icon="['fa', 'times-circle']"
        /></span>
      </p>
    </div>
  </transition>
  <div  class="container ">
    <form
      class="row"
      action=""
      method="post"
      v-on:submit.prevent
      enctype="multipart/form-data"
    >
      <div class="  font-monospace">
        <p class="fs-5 fst-italic">
          vous etre un professionnel cliquer 
          <a href="#/formulairepro"> ici</a>
        </p>
      </div>
      <hr />

      <div class=" input-group mb-3">
        <span class="input-group-text" id="basic-addon1"
          ><fa :icon="['fa', 'user']"
        /></span>
        <input
          type="text"
          class="  form-control"
          placeholder="Nom"
          v-model="nameuser"
        />
      </div>

      <div class="col  input-group mb-3">
        <span class="input-group-text" id="basic-addon1"
          ><fa :icon="['fa', 'user']"
        /></span>
        <input
          type="text"
          class="form-control"
          placeholder="Prenom"
          v-model="fnameuser"
        />
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"
          ><fa :icon="['fa', 'at']"
        /></span>
        <input
          type="email"
          class="form-control"
          placeholder="E-mail"
          v-model="emailuser"
        />
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"
          ><fa :icon="['fa', 'mobile-alt']"
        /></span>
        <input
          type="text"
          class="form-control"
          placeholder="Telephone"
          v-model="phoneuser"
        />
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"
          ><fa :icon="['fa', 'image']"
        /></span>
        <input
          type="file"
          class="form-control"
          autocomplete="imageuser"
          @change="previewFiles"
          multiple
        />
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"
          ><fa :icon="['fa', 'key']"
        /></span>
        <input
          type="password"
          class="form-control"
          placeholder="password"
          v-model="passworduser"
        />
      </div>

      <div class="col-2">
        <button type="submit" class="btn btn-success" @click="submit">
          enregistrer
        </button>
      </div>
    </form>
  </div>
  <Footer/>
</template>
<script>
import Footer from "../components/Footer.vue";
import axios from "axios";
export default {
  name:"monFormulaire",
  components:{Footer},
  data() {
    return {
      imageuser: "",
      nameuser: "",
      fnameuser: "",
      phoneuser: "",
      emailuser: "",
      passworduser: "",
      Status: true,
      champ: false,
      //transition
      show: false,
      message:"",
      class: false,
    };
  },
  watch: {},
  methods: {
    
    Switch() {
      this.Status = !this.Status;
    },
    /**
     * return value image
     * @param {value} event 
     */
    previewFiles(event) {
      this.imageuser = event.target.files[0];
      
    },
    /**
     * create objet new Formdata
     */

    submit() {
      let data = new FormData();
      data.append("image", this.imageuser);

      data.append("phone", this.phoneuser);
      data.append("name", this.nameuser);
      data.append("fname", this.fnameuser);
      data.append("email", this.emailuser);
      data.append("password", this.passworduser);

      axios
        .post(
          "http://localhost/mon_projet_vue.js/src/php/index.php?url=utilisateur",
          data
        )
        .then((res) => {
       res.data;
       
          console.log(res.data);
          console.log(res);

          if (res.data.success == undefined && res.data.error == undefined && res.data.errormail==undefined) {
            this.class = false;

            this.show = true;

            setTimeout(() => {
              this.show = false;
            }, 3000);

            this.message = res.data.errorImage;
          } else if (res.data.success == undefined && res.data.errorImage == undefined && res.data.errormail==undefined) {
            this.class = false;

            this.show = true;

            this.message = res.data.error;

            setTimeout(() => {
              this.show = false;

              this.class = false;
            }, 3000);
          } else if(res.data.success == undefined && res.data.errorImage == undefined && res.data.error==undefined){
               this.class = false;

            this.show = true;

            this.message = res.data.errormail;

            setTimeout(() => {
              this.show = false;

              this.class = false;
            }, 3000);

          }
          else {
            this.class = true;

            this.show = true;

            this.message = res.data.success;

            setTimeout(() => {
              this.show = false;

              this.class = true;
            }, 3000);
          }
        });
    },
  },
};
</script>

<style scoped>
.fade-enter-from {
  opacity: 0;
  transform: translateY(-60px);
}
.fade-enter-to {
  opacity: 1;
  transform: translateY(0px);
}
.fade-enter-active {
  transition: all 2s ease;
}
.fade-leave-from {
  opacity: 1;
  opacity: 0;
  transform: translateY(0px);
}
.fade-leave-to {
  opacity: 0;
  transform: translateY(-60px);
}
.fade-leave-active {
  transition: all 2s ease;
}

/* span {
  color: red;
} */
#user {
  display: flex;
  justify-content: space-evenly;
}

a:link 
{ 
 text-decoration:none; 
} 


</style>

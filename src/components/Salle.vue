<template>
  <div
    v-if="creationsalle"
    :class="[this.class ? 'alert alert-success' : 'alert alert-danger']"
    role="alert"
  >
    {{ message }}
  </div>

  <div class="container">
    <div class="row">
      <div class="col mt-3">
        <form
          action=""
          method="post"
          v-on:submit.prevent
          enctype="multipart/form-data"
        >
          <div class="card">
            <h5 class="card-header">creation de votre salle</h5>
            <div class="card-body">
              <div class="col mt-3">
                <input
                  type=" text"
                  class="form-control"
                  id=""
                  placeholder="nom de la salle "
                  v-model="newSalle.nameSalle"
                />
              </div>

              <div class="col mt-3">
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Adresse de la  adresse"
                  v-model="newSalle.adresseSalle"
                />
              </div>
              <div class="d-flex justify-content-between">
                <div class="col-3 mt-3">
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="code postal"
                    v-model="zip_code"
                  />
                </div>
                <div id="scroll" class="card" v-if="arrayPostale">
                  <ul
                    class="dropdown"
                    v-for="(item, index) in arrayPostale"
                    :key="index"
                  >
                    <li>
                      <p class="dropdown-item" @click="chooseCodePostal(item)">
                        {{ item.zip_code }} {{ item.name }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="col mt-3">
                <input
                  type="text"
                  class="form-control"
                  id=""
                  placeholder="Telephone"
                  v-model="newSalle.numeroSalle"
                />
              </div>

              <div class="col mt-3"></div>
              <input
                type="file"
                class="form-control"
                id=""
                autocomplete="imagesalle"
                @change="previewFiles"
                multiple
              />
              <div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  <a
                    href="#profilpro"
                    class="btn btn-outline-secondary me-md-2"
                    type="button"
                  >
                    <strong> Retour</strong>
                  </a>
                  <button
                    class="btn btn btn-primary"
                    type="button"
                    @click="addSalle()"
                  >
                    <strong>enregistrer</strong>
                  </button>
                </div>
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
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import Footer from "../components/Footer.vue";
export default {
  name: "maSalle",
  components: { Footer },
  data() {
    return {
      //creationde la salle
      newSalle: {
        nameSalle: "",
        adresseSalle: "",
        numeroSalle: "",
        imagesalle: "",
      },

      txt: [],
      tabs: "",
      creationsalle: false,
      message: "", //le message
      class: "", // poour la verification
      zip_code: "", // la value sur le input code postal
      id_zip_code: "", // id du code postal
      arrayPostale: "", //mon tableau pour le code postal
    };
  },
  watch: {
    //je surveiller la variable
    zip_code() {
      let data = new FormData();
      data.append("zip_code", this.zip_code);
      axios
        .post("http://localhost/mon-projet/src/php/?url=zip_code", data)
        .then((response) => {
          this.arrayPostale = response.data;
        });
    },
  },

  methods: {
    //je filtre le tableau
    chooseCodePostal(item) {
      this.arrayPostale.filter(function (item) {
        item.zip_code !== item;
      });
      //il prend la value au click
      this.zip_code = `${item.zip_code} ${item.name}`;
      this.id_zip_code = `${item.id_city}`;
      console.log(this.id_zip_code);
      console.log(this.zip_code);
    },

    //recuperer la value de l'image
    previewFiles(event) {
      this.newSalle.imagesalle = event.target.files[0];
      console.log(this.newSalle.imagesalle);
    },
    //créer une salle
    addSalle(data) {
      data = new FormData();
      data.append("imagesalle", this.newSalle.imagesalle);
      data.append("namesalle", this.newSalle.nameSalle);
      data.append("adressesalle", this.newSalle.adresseSalle);
      data.append("phonesalle", this.newSalle.numeroSalle);
      data.append("emailsalle", this.$store.state.User.email);
      data.append("id", this.$store.state.User.id);
      data.append("id_postal", this.id_zip_code);

      axios
        .post(
          "http://localhost/mon_projet_vue.js/src/php/?url=createsalle",
          data
        )
        .then((res) => {
          console.log(res);
          if (res.data.error !== undefined) {
            this.message = res.data.error;
            this.creationsalle = true;
            this.class = false;
            setTimeout(() => {
              this.creationsalle = false;
            }, 3000);
          } else {
            this.txt = res.data;
            console.log(res.data);
            this.creationsalle = true;
            this.class = true;
            this.message = "votre salle a bien été créé";
            setTimeout(() => {
              //me permet de mettre les variable a null
              this.creationsalle = false;
              this.newSalle.nameSalle = "";
              this.newSalle.adresseSalle = "";
              this.newSalle.numeroSalle = "";
              this.newSalle.imagesalle = "";
              this.$router.push("/profilpro");
            }, 3000);
          }
        });
    },
  },
};
</script>

<style >
#scroll {
  width: 20em;
  height: 5em;
  overflow-y: scroll;
}
li {
  list-style: none;
}
</style>

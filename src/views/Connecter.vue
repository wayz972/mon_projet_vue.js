 <template>
  <transition name="error">
    <div
      v-if="show"
      :class="[this.class ? 'alert alert-success' : 'alert alert-danger']"
      role="alert"
    >
      {{ error }}
    </div>
  </transition>
  <div id="container-connect" class="  mt-3 " style="height: 25em">
    <div class="col-12  col-xs-2 col-md-12 col-lg-3 d-flex justify-content-center">
      <div class="connect">
        <form action="" method="post" v-on:submit.prevent>
          <h2>se connecter</h2>
          <label for="" class="form-label login">Email</label>

          <div class="input-group">
            <span class="input-group-text bg-warning" id="basic-addon1"
              ><fa icon="at"
            /></span>
            <input
              type="email"
              class="form-control"
              autocomplete="username"
              v-model="emailuser"
              required=""
            />
          </div>
          <label for="" class="form-label login">mot passe</label>
          <div class="input-group">
            <span class="input-group-text bg-warning" id="basic-addon1"
              ><fa icon="key"
            /></span>
            <input
              type="password"
              autocomplete="current-password"
              class="form-control validate"
              v-model="passworduser"
            />
          </div>
          <div class="mt-3">
            <button
              type="submit"
              class="form-control btn btn-primary"
              @click="checked()"
            >
              se connecter
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <mon-footer/>
  <!-- <fa id="icon" :icon="['fa','times-circle']"/> -->
  <!-- <fa id="icon" :icon="['fa','check']"/> -->
  <!-- <fa :icon="['fa','coffee']"/>
 <fa :icon="['fab','facebook-f']"/>
<fa :icon="['fab','github']"/>
<fa :icon="['fab','google']"/> -->
  <!-- {{this.$store.state.User}} -->
 {{ this.$store.state.quentin}}
</template>
<script>
import axios from "axios";
import monFooter from "../components/Footer.vue";
export default {
  name:'meConnecter',
  components: { monFooter },
  data() {
    return {
      emailuser: "",
      passworduser: "",
      dom: "",
      error: "",
      show: "",
      class: "",
    };
  },
  computed: {
    check() {
      return this.$store.state.dom;
    },
  },
  methods: {
    change() {
      this.$store.dispatch("change");
    },
    checked() {
      let data = new FormData();
      data.append("email", this.emailuser);
      data.append("password", this.passworduser);
      axios
        .post("http://localhost/mon-projet/src/php/index.php?url=login", data)
        .then((response) => {
          response.data, console.log(response.data);

          if (response.data.error !== undefined || response.data == undefined) {
            this.show = true;
            console.log("no-pass");
            this.error = response.data.error;
            setTimeout(() => {
              this.show = false;
            }, 3000);
          } else {
            sessionStorage.setItem("email", response.data.email);
            sessionStorage.setItem("name", response.data.name_user);
            sessionStorage.setItem("fname", response.data.first_name_user);
            sessionStorage.setItem("phone", response.data.phone_user);
            sessionStorage.setItem("id", response.data.id_user);
            sessionStorage.setItem("status", response.data.verify);
            sessionStorage.setItem("img", response.data.img);
            sessionStorage.setItem("nav", response.data.nav);
            this.change();
            // this.$router.push("/profilpro");
            
          }
        });
    },
  },
};
</script>

<style scoped>
#container-connect {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  align-items: center;
}
.connect {
  width: 20em;
}
.login {
  display: flex;
  font-size: 17px;
}

.error-enter-from {
  opacity: 0;
  transform: translateY(-60px);
}
.error-enter-to {
  opacity: 1;
  transform: translateY(0px);
}
.error-enter-active {
  transition: all 2s ease;
}
.error-leave-from {
  opacity: 1;
  opacity: 0;
  transform: translateY(0px);
}
.error-leave-to {
  opacity: 0;
  transform: translateY(-60px);
}
.error-leave-active {
  transition: all 2s ease;
}
</style>

 <template>
  <transition name="error">
    <div
      v-if="this.$store.state.verifaction.show"
      :class="[this.class ? 'alert alert-success' : 'alert alert-danger']"
      role="alert"
    >
      {{ this.$store.state.verifaction.error }}
    </div>
  </transition>
  <div id="container-connect" class="mt-3" style="height: 25em">
    <div
      class="col-12 col-xs-2 col-md-12 col-lg-3 d-flex justify-content-center"
    >
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

  <!-- <fa id="icon" :icon="['fa','times-circle']"/> -->
  <!-- <fa id="icon" :icon="['fa','check']"/> -->
  <!-- <fa :icon="['fa','coffee']"/>
 <fa :icon="['fab','facebook-f']"/>
<fa :icon="['fab','github']"/>
<fa :icon="['fab','google']"/> -->
  <!-- {{this.$store.state.User}} -->
  <!-- {{this.$store.state.User}} -->
</template>
<script>
export default {
  name: "meConnecter",

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
      this.$store.dispatch("checked", data);
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

.btn-primary {
  background-color: #015ba0 !important;
}
</style>

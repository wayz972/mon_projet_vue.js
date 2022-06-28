<template>
  <nav
    v-if="this.$store.state.User.id == null"
    class="navbar navbar-expand-lg navbar-light"
  >
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>

      <img
        src="../image/logo.png"
        class="img-fluid"
        alt=""
        srcset=""
        style="width: 2rem"
      />

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <router-link to="/" class="nav-link fw-bold" aria-current="page">
            Accueil</router-link
          >
          <router-link
            to="/formulaire"
            class="nav-link fw-bolder"
            aria-current="page"
          >
            inscription</router-link
          >
          <router-link
            to="/contacter"
            class="nav-link fw-bolder"
            aria-current="page"
          >
            contacter</router-link
          >
          <router-link
            to="/connecter"
            class="nav-link fw-bolder"
            aria-current="page"
          >
            se connecter</router-link
          >
        </div>
      </div>
    </div>
  </nav>

  <nav v-else class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#"></a>

      <img
        src="../image/logo.png"
        class="img-fluid"
        alt=""
        srcset=""
        style="width: 2rem"
      />

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <router-link
            to="/profilpro"
            class="nav-link active fw-bold"
            aria-current="page"
          >
            mon profil |</router-link
          >
          <router-link
            to=""
            class="nav-link active fw-bold"
            @click="disconnect()"
            >Deconnecter</router-link
          >
        </div>
        <!-- <div  class="navbar-nav " v-else>

  



        <router-link  to="/profilpro" class="nav-link active fw-bold" aria-current="page"> mon profil   |</router-link>  
        <a href="" class="nav-link active fw-bold" @click="disconnect()">{{this.$store.state.ischange?'connecter':'Deconnecter'}}</a>
      </div> -->
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "maNavbar",

  data() {
    return {
      name: sessionStorage.getItem("name"),
      fname: sessionStorage.getItem("fname"),
      change: JSON.parse(sessionStorage.getItem("nav")),
      status: true,
    };
  },

  methods: {
    disconnect() {
      this.$store.dispatch("disconnect");
      this.$router.push("/");
    },
  },
};
</script>

<style scoped>
nav {
  z-index: 2;
}
</style>
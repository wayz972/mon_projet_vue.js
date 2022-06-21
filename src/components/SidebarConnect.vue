<template>
  <div
    class="sidebar"
    :style="{
      width: `${
        this.$store.state.collapsed
          ? this.$store.state.SIDEBAR_WIDTH_COLLAPSED
          : this.$store.state.SIDEBAR_WIDTH
      }px`,
    }"
  >
    <h1>
      <span v-if="this.$store.state.collapsed">
        <div>o</div>
        <div>z</div>
      </span>
      <span v-else>
        <img
          src="../image/logo.png"
          class="img-fluid"
          alt=""
          srcset=""
          style="width: 2rem"
        />
      </span>
    </h1>
    <span v-if="!this.$store.state.collapsed">
      <router-link
        to="/profilpro"
        class="link fw-bold d-flex justify-content-center"
        @click="this.$store.state.collapsed = true"
        aria-current="page"
      >
        mon profil
      </router-link>
      <router-link
        to=""
        class="link fw-bold d-flex justify-content-center"
        @click="disconnect()"
        >Deconnecter</router-link
      >
    </span>
    <span v-else>
      <router-link
        to="/profilpro"
        class="link d-flex justify-content-center"
        aria-current="page"
        icon="fas fa-columns"
        ><fa :icon="['fas', 'id-card']" />
      </router-link>
      <router-link
        to="/contacter"
        class="link d-flex justify-content-center"
        aria-current="page"
        icon="fas fa-chart-bar"
        @click="disconnect()"
        ><fa :icon="['fas', 'right-from-bracket']"
      /></router-link>
    </span>
    <span
      class="collapse-icon"
      :class="{ 'rotate-180': this.$store.state.collapsed }"
      @click="toggleSidebar"
    >
      <fa :icon="['fas', 'angle-double-left']" />
    </span>
  </div>
</template>

<script>
export default {
  name: "mySidebar",
  data() {
    return {
      active: null,
    };
  },
  methods: {
    disconnect() {
      this.$store.dispatch("disconnect");
      this.$router.push("/");
    },
    toggleSidebar() {
      this.$store.dispatch("toggleSidebar");
    },
    sidebarWidth() {
      return `${
        this.$store.state.collapsed
          ? this.$store.state.SIDEBAR_WIDTH_COLLAPSED
          : this.$store.state.SIDEBAR_WIDTH
      }px`;
      // this.$store.dispatch("sidebarWidth");
    },
  },
};
</script>

<style>
:root {
  --sidebar-bg-color: #2f855a;
  --sidebar-item-hover: #38a169;
  --sidebar-item-active: #276749;
}
</style>

<style scoped>
.sidebar {
  color: white;
  background-color: var(--sidebar-bg-color);

  float: left;
  position: fixed;

  top: 0;
  left: 0;
  bottom: 0;
  padding: 0.5em;

  transition: 0.3s ease;

  display: flex;
  flex-direction: column;
}

.sidebar h1 {
  height: 2.5em;
}

.collapse-icon {
  position: absolute;
  bottom: 0;
  padding: 0.75em;

  color: rgba(255, 255, 255, 0.7);

  transition: 0.2s linear;
}

.rotate-180 {
  transform: rotate(180deg);
  transition: 0.2s linear;
}

.link {
  display: flex;
  align-items: center;

  cursor: pointer;
  position: relative;
  font-weight: 400;
  user-select: none;

  margin: 0.1em 0;
  padding: 0.4em;
  border-radius: 0.25em;
  height: 1.5em;

  color: white;
  text-decoration: none;
}
.link:hover {
  background-color: var(--sidebar-item-hover);
}

.link.active {
  background-color: var(--sidebar-item-active);
}
</style>

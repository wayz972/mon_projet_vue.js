<template>
   <div class="sidebar" :style="{ width: `${this.$store.state.collapsed ? this.$store.state.SIDEBAR_WIDTH_COLLAPSED : this.$store.state.SIDEBAR_WIDTH}px` }">
    <h1>
       
      <span v-if="this.$store.state.collapsed">
        <div>o</div>
        <div>z</div>
      </span>
       <span v-else>
      <img src="../image/logo.png" class="img-fluid" alt="" srcset="" style="width:2rem"> 
      </span>
    </h1>
        <span v-if="!this.$store.state.collapsed">
        

          <router-link   to="/" class=" link  d-flex justify-content-center fw-bold" @click="this.$store.state.collapsed = true"   aria-current="page" icon="fas fa-home"> 
          Accueil</router-link>  
       
         
        <router-link  to="/formulaire" class=" link  d-flex justify-content-center fw-bold"  aria-current="page" @click="this.$store.state.collapsed = true"  icon="fas fa-columns"> inscription</router-link> 
        <router-link  to="/contacter" class=" link d-flex justify-content-center fw-bold" aria-current="page" @click="this.$store.state.collapsed = true" icon="fas fa-chart-bar"> contacter</router-link> 
        <router-link  to="/connecter" class="  link d-flex justify-content-center fw-bold" aria-current="page" @click="this.$store.state.collapsed = true" icon="fas fa-image"> se connecter</router-link>
        </span>
        <span v-else>
          <router-link   to="/" class=" link d-flex justify-content-center "  aria-current="page" icon="fas fa-home"> <fa :icon="['fas','home']"/>
          </router-link>  
       
         
        <router-link  to="/formulaire" class=" link d-flex justify-content-center"  aria-current="page"  icon="fas fa-columns"><fa :icon="['fas','columns']"/> </router-link> 
        <router-link  to="/contacter" class=" link d-flex justify-content-center" aria-current="page" icon="fas fa-chart-bar"> <fa :icon="['fas','sign-in']"/></router-link> 
        <router-link  to="/connecter" class="  link d-flex justify-content-center" aria-current="page" icon="fas fa-image"><fa :icon="['fas','user']"/> </router-link>

        </span>
         <span
      class="collapse-icon"
      :class="{ 'rotate-180': this.$store.state.collapsed }"
      @click="toggleSidebar"
    >
      
      <fa :icon="['fas','angle-double-left']"/>
      
    </span>
     
  </div>

  
</template>

<script>
export default {
  name:'mySidebar',
  data(){
    return{
      active: null 

    }
  },
  methods:{


    computed(){
      return `${this.$store.state.collapsed ? this.$store.state.SIDEBAR_WIDTH_COLLAPSED : this.$store.state.SIDEBAR_WIDTH}px`

    },
    toggleSidebar(){
      this.$store.dispatch("toggleSidebar");

    },
    sidebarWidth(){
       return `${this.$store.state.collapsed ? this.$store.state.SIDEBAR_WIDTH_COLLAPSED : this.$store.state.SIDEBAR_WIDTH}px`
      
    }

  }


}
</script>

<style>
:root {
   --sidebar-bg-color: #015BA0;
  /* --sidebar-bg-color: #2f855a; */
  --sidebar-item-hover: #023E8A;
  /* --sidebar-item-hover: #38a169; */
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
  height: 2.5em  ;
} 

.collapse-icon {
  position: absolute;
  bottom: 0;
  padding: 0.75em;

  color: rgba(255, 255, 255, 0.7) ;

  transition: 0.2s linear;
}

.rotate-180 {
  transform: rotate(180deg);
  transition: 0.2s linear;
}



.link {
  display: flex;
  align-items: center ;

  cursor: pointer;
  position: relative;
  font-weight: 400;
  user-select: none;

  margin: 0.1em 0;
  padding: 0.4em;
  border-radius: 0.25em;
  height: 1.5em;

  color: white ;
  text-decoration: none ;
}
.link:hover {
  background-color: var(--sidebar-item-hover) ;
}

.link.active {
  background-color: var(--sidebar-item-active) ;
}
/* @media only screen and (max-width: 600px) {
 .sidebar {
   z-index: 1;
   background-color: #42b983;
   
    
   
  }
} */



</style>

<template>
<div>
  <!-- <maNavabar/> -->
  <div v-if="this.$store.state.User.id ==null">
  <mysidebar/>

  </div>
  <div v-else>
 <sidebarconnect/>
  </div>
  <div :style="{ 'margin-left':  `${this.$store.state.collapsed ? this.$store.state.SIDEBAR_WIDTH_COLLAPSED : this.$store.state.SIDEBAR_WIDTH}px` }">
    <router-view/>
    </div>
</div>

 

</template>
<script >

// import maNavabar from './components/Menu.vue';
import sidebarconnect from './components/SidebarConnect.vue'
import mysidebar from './components/Sidebar.vue';
export default{
  name:"app",
   components:{mysidebar,sidebarconnect},

data(){
  return{
       action:true,
  }
},
methods:{
       check(){
         this.action=!this.action
       }
     }
   }
</script>
<style>

#app {
   font-family: Roboto, Helvetica, Arial, sans-serif; 
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
   
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

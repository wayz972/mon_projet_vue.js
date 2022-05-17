import {createStore } from 'vuex'


export default createStore({
    state: {
      currentUser:"",
        
      ischange:true,
        tabs:[],


        collapsed:false,
        SIDEBAR_WIDTH : 180,
        SIDEBAR_WIDTH_COLLAPSED : 38,






User:{
    id:sessionStorage.getItem("id"),
    name: sessionStorage.getItem("name"),
      fname: sessionStorage.getItem("fname"),
      email: sessionStorage.getItem("email"),
      phone: sessionStorage.getItem("phone"),
      img: sessionStorage.getItem("img"),
      change: JSON.parse(sessionStorage.getItem("status")),

},


  
    },
  
    mutations: {
        change(state){
        
           
            window.location.href = "http://localhost:8080/#/profilpro"
               state.ischange
          window.location.reload();
             
        },
        disconnect(state){
            state.ischange=!state.ischange
            sessionStorage.clear();
             
             window.location.href = "http://localhost:8080/#/"
             
            window.location.reload();   
        },
        toggleSidebar(state){
            state.collapsed=!state.collapsed
        },
        sidebarWidth(state){
            `${state.collapsed.value ? state.SIDEBAR_WIDTH_COLLAPSED : state.SIDEBAR_WIDTH}px`
        },

  
     },
    
    actions: {
        change({commit},sup){
         commit('change',sup)
        },
        disconnect({commit},dis){
            commit('disconnect',dis)
        },
        toggleSidebar({commit},dis){
            commit('toggleSidebar',dis)
        },
        
        sidebarWidth({commit},dis){
            commit('sidebarWidth',dis)
        },
     
          
           

      


      
      
  
    
       
        
        
    },
    
    modules: {
    }
})

  
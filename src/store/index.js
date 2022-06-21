import {createStore } from 'vuex'
import axios from "axios";
import createPersistedState from "vuex-persistedstate";
export default createStore({
    state: {
      currentUser:"",

      verifaction:{
        show: false,
        error: "",

  },
        
      ischange:true,
        tabs:[],
        reservation:[],


        collapsed:false,
        SIDEBAR_WIDTH : 180,
        SIDEBAR_WIDTH_COLLAPSED : 38,


User:{
    id:"",
    name:"",
      fname: "",
      email: "",
      phone:"",
      img: "",
      change: "",

},


  
    },
  
    mutations: {
        change(state){
        
           
            window.location.href = "http://localhost:8080/#/profilpro"
               state.ischange
          window.location.reload();
             
        },
        disconnect(state){
 
            state.User.id="";
            state.User.name="";
            state.User.fname="";
            state.User.email="";
            state.User.phone="";
            state.User.img="";
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
        checked(state,response){
            if (response.data.error !== undefined) {
                      state.verifaction.show = true;
                      
                      state.verifaction.error = response.data.error;
                      setTimeout(() => {
                          state.verifaction.show = false;
                        state.verifaction.error ="";
                      }, 3000);
                    } else {
                      state.User.email= response.data.email;
                      state.User.name= response.data.name_user;
                       state.User.fname=response.data.first_name_user;
                       state.User.phone=response.data.phone_user;
                       state.User.id=response.data.id_user;
                      state.User.change= response.data.verify;
                      state.User.img=response.data.img;
                      state.verifaction.show = false;
                      state.verifaction.error = "";
                      window.location.href = "http://localhost:8080/#/profilpro"
                    }
            
        },
        deletesalle(state,response){
            response.data;
            console.log(response.data);
             window.location.reload(); 
        },
    addsubmit(state,response) {

        if (response.data.errorImage ==undefined) {
            state.User.name= response.data.nom_professionnel;
            state.User.email= response.data.email_professionnel;
            state.User.fname= response.data.prenom_professionnel;
            state.User.img= response.data.img_professionnel;
            state.User.phone= response.data.telephone_professionnel ;
             console.log(response.data);
            
        } else {
            console.log(response.data.errorImage)
            
        }
        
        
    },
    enregister (state,response){
        if(response.data.errorImage ==undefined){

            state.User.name=  response.data.nom_client;
            state.User.email= response.data.email_client;
            state.User.fname= response.data.prenom_client;
            state.User.img= response.data.img_client;
            state.User.phone= response.data.tel_client;
        }else{
           console.log(response.data.errorImage)
        }


    },
    add(state,response){
       
             response.data;
              console.log(response.data);
    }
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
        checked({commit},data){
            axios
        .post("http://localhost/mon_projet_vue.js/src/php/index.php?url=login", data)
        .then((response) => {
            commit('checked',response)
        })
        },
        
         deletesalle({commit},data){
            axios
            .post("http://localhost/mon_projet_vue.js/src/php/index.php?url=delete", data)
            .then((response) => {
                commit('deletesalle',response)
            })

         },
         addsubmit ({commit},data) {
           
            axios
            .post("http://localhost/mon_projet_vue.js/src/php/index.php?url=update",data)
            .then((response) => {
                commit('addsubmit',response)
            })

         },
         enregister ({commit},data) {
           
            axios
            .post("http://localhost/mon_projet_vue.js/src/php/index.php?url=enregister",data)
            .then((response) => {
                commit('enregister',response)
            })

         },

         add ({commit},data){
         
            axios.post(
                "http://localhost/mon_projet_vue.js/src/php/index.php?url=addslot"
                ,data)
           .then((response) =>{
            console.log(response.data);
            commit ("add",response)
            
            })

         }








       
          
           
        },
      


      
      
  
    
       
        
        
    
    modules: {
    },
    plugins: [createPersistedState()]
})

  
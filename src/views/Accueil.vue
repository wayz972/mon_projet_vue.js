<template>


  <div>
      <home
      v-for="(item,index) in page" :key="index"
      :box_crossfit="item.box_crossfit"
      :fitness="item.fitness"
      :bien_etre="item.bien_etre"
      :message_card="item.message"
      />
  </div>
 

</template>
<script>
import home from "../components/Home.vue"
export default {
    name:'monAccueil',
    components:{home},
    data(){
        return{
            page:[
                {
                    id:"",
                    box_crossfit:"box-crossfit",
                    fitness:"fitness",
                    bien_etre:"bien-etre",
                    message:"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus, culpa tempora! Quibusdam tempore eos, porro perferendis reprehenderit eum nulla exercitationem inventore in consequatur molestias neque ratione magni? Illum, unde ducimus!",
                }
            ]

        }
    },
  
}
 
</script>
<style scoped >






</style>
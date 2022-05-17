<template>
  

      <h2>contactez-nous </h2>
    
  <form action="" method="post">

  <div class="row  d-flex justify-content-center">
    <div class="col-8 col-sm-4 col-md-8 col-lg-4  mt-3">
        <p>Nom</p>
        <input type="text" class="form-control" name="name" placeholder="name" aria-label=" name">
        
      </div>
      <div class="col-8 col-sm-4 col-md-8 col-lg-4 mt-3">
        <p>Prenom</p>
        <input type="text" class="form-control" name="firstname" placeholder="firstname" aria-label="firstname">
      </div>
    </div>
    <div class="row d-flex justify-content-center  ">
      <div class="col-8 col-sm-4 col-md-8 col-lg-4 mt-3">
        <p>Email</p>
        <input type="text" class="form-control" name="email" placeholder="Email" aria-label="email">
      </div>
      <div class="col-8 col-sm-4 col-md-8 col-lg-4 mt-3 mb-3">
        <p>telephone</p>
        <input type="text" class="form-control" name="phone" placeholder="numero telephone" aria-label="phone">
      </div>
      <div class="col-8 row row-col-sm-4 col-md-8  mt-3 mb-3 ">
        <textarea name="message" id="" cols="12" rows="10"></textarea>
        <button type="submit" class="btn btn-primary mt-3">envoyer</button>
      </div>
    </div>
   
   </form>
    <Footer/>
</template>

<script>
import Footer from "../components/Footer.vue";
export default {
  name:"meContacter",
components:{Footer},  

}
</script>

<style>

</style>
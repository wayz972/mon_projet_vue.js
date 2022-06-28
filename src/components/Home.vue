<template>
  <main>
    <div id="image">
      <img
        src="../assets/pexels-li-sun-2294403.jpg"
        class="img-fluid"
        alt="..."
      />
    </div>

    <!------------------------------------------ carte ----------------------->
    <section class="container-card">
      <div class="card cd">
        <div class="card-image card-1">
          <img
            src="../assets/pexels-william-choquette-1954524.jpg"
            class="img-fluid"
            alt="..."
          />
        </div>
        <h2>{{ fitness }}</h2>
        <p>{{ message_card }}</p>
      </div>
      <div class="card cd">
        <div class="card-image card-2">
          <img
            src="../assets/pexels-scott-webb-136410.jpg"
            class="img-fluid"
            alt="..."
          />
        </div>
        <h2>{{ bien_etre }}</h2>
        <p>{{ message_card }}</p>
      </div>
      <div class="card cd">
        <div class="card-image card-3">
          <img
            src="../assets/pexels-nathan-cowley-1153369.jpg"
            class="img-fluid"
            alt="..."
          />
        </div>
        <h2>{{ box_crossfit }}</h2>
        <p>{{ message_card }}</p>
      </div>
    </section>
  </main>
  <mon-footer />
</template>
<script>
import monFooter from "./Footer.vue";
export default {
  name: "mesCards",
  components: { monFooter },
  props: {
    id: { String },
    box_crossfit: { String },
    fitness: { String },
    bien_etre: { String },
    message_card: { String },
    image: { String },
  },
  data() {
    return {
      home: 0,
      verf: true,
    };
  },
  methods: {
    onScroll() {
      this.home =
        (window.innerHeight + window.scrollY) / document.body.offsetHeight;
      // console.log({ y:this.home });
    },
  },

  mounted() {
    window.addEventListener("scroll", this.onScroll, true);
  },
};
</script>

<style scoped>
.animes {
  opacity: 1;
  animation: anime;
  animation-duration: 0.8s;
}
.animeBlock {
  animation: animBlock;
  animation-duration: 0.8s;
}
/**************Animation***************************************************/

#sous-container {
  display: flex;
  justify-content: center;
}

/***************************NAV***************************************************/

#title {
  text-align: center;
  margin: 10% 10%;
}
/*********************************************************************
**************************************************/
#container {
  display: flex;
  margin-top: 10em;
  justify-content: center;
}

.block {
  display: flex;
  transition: 0.5s ease-in-out;
  margin-left: 5em;
  width: 30%;
}

.block:hover {
  background-color: whitesmoke;
  border: 1px solid;
  border-radius: 12px;
  box-shadow: 5px 10px 8px 10px rgb(0 0 0 / 20%);
  transform: scale3d(1.03, 1.03, 1);
}

.block p {
  width: auto;
  text-align: justify;
  margin: 1em;
  font-size: 18px;
  letter-spacing: 1px;
  line-height: 27px;
}

/************************************card**************************************************************************/
.container-card {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 10em;
  margin-bottom: 15em;
  border-bottom: 1px groove;
  margin-bottom: 0;
}
.cd {
  background: white;
  width: 280px;
  height: 400px;
  margin: 2em;
  cursor: pointer;
}
.card-image {
  background-color: aqua;
  height: 180px;
  /* margin-bottom: 15px; */
  background-size: cover;
  border-radius: 2px;
}

.card p {
  text-align: justify;
  padding: 0px 0.5em 0px 0.5em;
}
.cd:hover {
  background-color: rgba(62, 62, 62);
  color: white;
  transform: scale(1.05);
}
/***********************************/

/*********************************************************************************************************************/
/*   RESPONSIVE      */
/* ***************************************************************************************************************************/

@media screen and (max-width: 1400px) {
  #container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  #block1 img {
    margin-left: 5em;
  }
  #block1 {
    width: auto;
  }
  #block2 p {
    margin-left: 9em;
  }
  #block2 {
    width: auto;
  }
  #block2 img {
    margin-left: 9em;
  }
}
@media only screen and (min-width: 800px) and (max-width: 966px) {
  /*style petites-moyennes tablettes */

  #container p {
    width: 80%;
  }
  #block1 {
    width: 80em;
  }
  #block1 img {
    margin: 0 0 0 2em;
    width: 40em;
  }

  #block2 img {
    margin-left: 5em;
    width: 40em;
  }
  #sous-container {
    display: contents;
  }
}
@media only screen and (min-width: 321px) and (max-width: 799px) {
  /*style smartphones et petites tablettes en portrait*/

  #block1 img {
    margin: 1em 0 0 0;
    width: 21em;
  }
  #container p {
    text-align: center;
    width: 65%;
  }
  #block2 {
    width: 85%;
  }
  #block2 img {
    margin: 1em 0 0 0;
    width: 21em;
  }
  #container p {
    text-align: center;
    width: 65%;
  }
  #block2 {
    margin-left: 2em;
    width: 85%;
  }
}

@media only screen and (max-width: 320px) {
  /*style petits smartphones en voie de disparition*/
}
</style>
<script>
//nem script setup, hanem option api
import {http} from "@/utils/http.js"
import {RouterLink} from "vue-router";
export default {
  data(){
    return{
      drink: {}
    }
  },

  //kell komponens is, azért kell, mert vannak konponenseink, pl. router link, hogy elérhető legyen az oldalba, csak akkor fut le, ha van mounted
  //ugye: composition - OnMounted,
  //      option api - mounted
components:{
    RouterLink
},

  methods:{
    //adatlekéreés, async,
    async getData(){
      const response = await http.get(`drinks/${this.$route.params.id}`);
      this.drink = await response.data.data;
      this.visible = true;
    }
  },
  mounted() {
    this.getData();
  }
}

//használni kell badge-eket

//keres a getbootstrap.com
//badge

</script>

<template>
<main class="container" v-show="visible === true">
  <h1>{{ drink.name }}</h1>
  <hr>
  <ul class="list-group">
    <li class="list-group-item">
      Összetevők:
      <span v-for="ingredient in drink.ingredients"
      :key="ingredient.id" class="badge bg-secondary mx-1">
          {{ ingredient.name }}
      </span>
    </li>
    <li class="list-group-item">Leírás: {{drink.description}}</li>
    <li class="list-group-item">Ár: {{drink.price}}</li>
    <li class="list-group-item">Csökkentett ár:
        <span v-if="drink.discounted_price === null">Nincs</span>
        <span v-else>{{drink.discounted_price}}</span>
    </li>
    <li class="list-group-item" v-if="drink.flavor">Ízesítés: {{drink.flavor.name}}</li>
    <li class="list-group-item">
      <router-link to="/" class="btn btn-danger">Vissza</router-link>
    </li>
  </ul>
</main>
</template>

<style scoped>
</style>
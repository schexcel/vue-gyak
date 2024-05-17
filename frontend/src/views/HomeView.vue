<script setup>
import {http} from '@/utils/http';
import {reactive, onMounted, ref} from 'vue';
import {RouterLink} from 'vue-router';

const drinks = reactive([]);
async function getData(){
  const response = await http.get('drinks')
  for (const item of response.data.data){
    const obj = {
      'id' :item.id,
      'name' : item.name,
      'price' : item.price,
      'discounted' : discount(item.discounted)
    }
    drinks.push(obj)
  }
}

function discount(data){
  if (data === true){
    return "Akciós"
  }
  else {
    return "Nem akciós"
  }
}
onMounted(getData)
</script>

<template>
<main class="container">
  <h1>Italok</h1>
  <hr>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>Név</th>
        <th>Ár</th>
        <th>Akciós</th>
        <th>Művelet</th>
      </tr>
    </thead>
    <tbody>
    <tr v-for="drink in drinks" :key="drink.id">
      <td>{{drink.name}}</td>
      <td>{{drink.price}}</td>
      <td>{{drink.discounted}}</td>
      <td><router-link class="btn btn-primary" :to="`/drinks/${drink.id}`">Megjelenítés</router-link></td>
    </tr>
    </tbody>
  </table>
</main>
</template>
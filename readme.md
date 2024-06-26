# 1- 1 feladat-vuejs projekt létrehozása CMD-adminisztrátorként
1. mappa létrehozása, pl.: ```c:\vue-gyak```
2. belépés a mappába ```cd c:\vue-gyak```
3. parancssor indítása a mappában (adminként)
4. ``` npm init vue@latest ```
5. Ok to proceed? (y) ```y```
6. Projekt név megadása, pl: √ Project name: ... ```DrinkFrontend```
- √ Package name: ... drinkfrontend
7. NO-√ Add TypeScript? ... ```No``` / Yes
8. NO-√ Add JSX Support? ... ```No``` / Yes
9. YES-√ Add Vue Router for Single Page Application development? ... No / ```Yes```
10. NO-√ Add Pinia for state management? ... ```No``` / Yes
11. NO-√ Add Vitest for Unit Testing? ... ```No``` / Yes
12. NO-√ Add an End-to-End Testing Solution? » ```No```
13. NO-√ Add ESLint for code quality? ... ```No``` / Yes
14. NO-√ Add Vue DevTools 7 extension for debugging? (experimental) ... ```No``` / Yes
15. ```cd DrinkFrontend```
16. ```npm i bootstrap vee-validate yup axios```

# 2- fejlesztő környezet megnyitása
17. jobb klikk a mappán, open folder as php storm project

# 3- Projekt futtatása
18. ```npm run dev```
19. Megnyitás böngészőben: ```http://localhost:5173/```

# 4- dolgok törlése, átalakítása
20. ```c:\vue-gyak\frontend\src\views\AboutView.vue``` - törlés
21. ```c:\vue-gyak\frontend\src\App.vue```
    <script setup>
    import { RouterLink, RouterView } from 'vue-router'
    </script>

    <template>
      <RouterView />
    </template>

    <style scoped>
    </style>
22. ```c:\vue-gyak\frontend\src\components\``` - mappa (csak a) tartalmának a törlése
23. ```c:\vue-gyak\frontend\src\assets\``` - mappa törlése (teljes mappa)
24. ```c:\vue-gyak\frontend\src\main.js```
```
    //import './assets/main.css' - ez a sor nem kell!!!!
    
    import { createApp } from 'vue'
    import App from './App.vue'
    import router from './router'
    
    const app = createApp(App)
    
    app.use(router)
    
    app.mount('#app')
```
25. ```c:\vue-gyak\frontend\src\views\HomeView.vue```
```
    <script setup>
    </script>
    
    <template>
    </template>
```
26. ```c:\vue-gyak\frontend\src\router\index.js```
    -kiszedni az AboutView.vue hivatkozást (//-el jelölve, mi nem kell!!!!)!!!!
```
    import { createRouter, createWebHistory } from 'vue-router'
    import HomeView from '../views/HomeView.vue'
    
    const router = createRouter({
      history: createWebHistory(import.meta.env.BASE_URL),
      routes: [
        {
          path: '/',
          name: 'home',
          component: HomeView
        }//,
        //{
        //  path: '/about',
        //  name: 'about',
        //  // route level code-splitting
        //  // this generates a separate chunk (About.[hash].js) for this route
        //  // which is lazy-loaded when the route is visited.
        //  component: () => import('../views/AboutView.vue')
        //}
      ]
    })
```    
    export default router
27. ```c:\vue-gyak\frontend\src\main.js```
    -Bele kell tenni a bootstrap hivatkozásokat!!!
```
    import { createApp } from 'vue'
    import App from './App.vue'
    import router from './router'
      import 'bootstrap'
      import 'bootstrap/dist/css/bootstrap.min.css'
    
    const app = createApp(App)
    
    app.use(router)
    
    app.mount('#app')
```
28. ```c:\vue-gyak\frontend\src\utils\http.js```
    -'utils' mappa és benne a 'http.js' fájl létrehozása!
29. ```c:\vue-gyak\frontend\src\utils\http.js```
- ```http.js``` - adattal feltöltése:
```
    import axios from "axios";
    const http = axios.create({
        baseURL:"http://127.0.0.1:8000/api/"
    })
    export {http}
```
# 5- backend install
30. ``` start menü + xampp contorlpanel ``` indítsd el az APACHE + MySQL
31. ```c:\vue-gyak\drinks_backend\``` - másold fel a backend mappa tartalmát
32. ```composer install``` - nyiss egy cli-t admin módban, és add ki a parancsot, hogy a függőségek települjenek!
33. ```php artisan migrate``` - készüljön el az adatbázis!
34. ```php artisan db:seed``` - Töltődjenek fel a táblák adattal!!!!
35. ```php artisan serve ``` - indítsd el a szervert!
36. ```http://127.0.0.1:8000/api/drinks``` - Ezen a címen egy böngészőből elérhető a backend (elvileg)
37. Ne zárd be a CLI-t!

# 6- 2 és 3-feladat-Frontend megírása - kezdjük a HomeView.vue-val!

38. Írjuk meg a ```HomeView.vue```-fájlt!
```
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
<main>
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
```
# 7- 4-feladat - NavBar.vue
39. Hozzunk létre egy mappát: ```c:\vue-gyak\frontend\src\components\layouts\```
40. És ebben a mappában egy fájlt: ```c:\vue-gyak\frontend\src\components\layouts\NavBar.vue```
```
    <script setup>
    import { RouterLink } from 'vue-router'
    </script>
    
    <template>
      <RouterView />
    </template>
```
41. Szerzünk egy navbart: ```https://getbootstrap.com/``` beírjuk a keresőbe, hogy nav, az első amit kidob, azt kimásoljuk! ```https://getbootstrap.com/docs/5.3/components/navbar/#nav```
42. Bemásoljuk a ```NavBar.vue``` ```<template>``` CTRL+V ```</template>``` közé!
43. A főoldal elemet lecseréljük ```a```-helyett ```router-link```, ```href``` helyett ```to```   és:     ```<router-link class="navbar-brand" to="/">Italok</router-link>```
44. A 4 db ```li```-ből csak az első kettőt hagyjuk meg! (az utolsó kettőt töröljük)
45. Az ```a``` csere ```RouterLink```-re,  ```href``` helyett ```to```  és:   ´´´<RouterLink class="nav-link active" aria-current="page" to="/">Kezdőlap</RouterLink>´´´
46. Az ```a``` csere ```RouterLink```-re,  ```href``` helyett ```to```  és:   ´´´<RouterLink class="nav-link" to="/new">Létrehozás</RouterLink>´´´
47. Így ez lesz a NavBar.vue:
```
<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">Italok</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <RouterLink class="nav-link active" aria-current="page" to="/">Kezdőlap</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/new">Létrehozás</RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
```
48. Az ```app.vue``` -ba be kell linkelni a navbart, ```<script></script>```-be 1: ```import NavBar from "@/components/layouts/NavBar.vue";```
49. Az ```app.vue``` -ba be kell linkelni a navbart, ```<template></template>```-be 2: ```  <NavBar />```

# 8- 5-feladat- ```DrinkDataView.vue``` és 6-feladat ```CreateNewDrinkFormView.vue``` - fájlok létrehozása
50. ```c:\vue-gyak\frontend\src\views\DrinkDataView.vue``` és a ```c:\vue-gyak\frontend\src\views\CreateNewDrinkFormView.vue``` fájlok létrehozása
51. mindkét vue fájlban legyen ```<script></script>``` és ```<template></template>```, akár kivehetjük az ```app.vue```-ből is.:-)
52. Az új VUE fájlok belinkelése a routerbe: ```c:\vue-gyak\frontend\src\router\index.js``` -be!
```
    import { createRouter, createWebHistory } from 'vue-router'
    import HomeView from '../views/HomeView.vue'
    
    const router = createRouter({
      history: createWebHistory(import.meta.env.BASE_URL),
      routes: [
        {
          path: '/',
          name: 'home',
          component: HomeView,
          meta:{
            title: "Kezdőlap"
          }
        },
        {
         path: '/new',
         name: 'new',
         component: () => import('@/views/CreateNewDrinkFormView.vue'),
          meta:{
           title: 'Hozzáadás'
          }
        },
        {
          path: '/drinks/:id',
          name: 'drink',
          component: () => import('@/views/DrinkDataView.vue'),
          meta:{
            title: 'Adatok'
          }
        }
      ]
    })
    router.beforeEach((to,from, next)=>{
      document.title=`${to.meta.title}`;
      next();
    })
    export default router

```

53. ```c:\vue-gyak\frontend\src\views\DrinkDataView.vue``` ```<script>``` -rész  Megírása
```
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

    </script>
```
54. ```c:\vue-gyak\frontend\src\views\DrinkDataView.vue``` ```<template>``` -rész  Megírása,a feladat szertin BADGE-ekkel, ```https://getbootstrap.com/``` beírjuk a keresőbe, hogy badge, az első amit kidob, azt megnéz, és alkalmaz! ```<span>``` - kell
55. Összes termék: ```http://127.0.0.1:8000/api/drinks``` , az adott termék ```http://127.0.0.1:8000/api/drinks/1```
```
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
```
# 9-  6-feladat ```CreateNewDrinkFormView.vue``` - fájl elkészítése
56.  6-feladat ```CreateNewDrinkFormView.vue``` - fájl ```<template>```` ```</template>``` megírása! ```<main,div row, div col> létrehozása, Form beillesztése!
```
    <template>
    
      <!-- ezt megírni: -->
    
    <main class="m-auto p-3 container">
    <div class="row">
      <div class="col">
        <h1>Új ital létrehozása</h1>
        <hr>
      </div>
    </div>
    <div  class="row">
    <div class="col">
    
    <!-- form txt-be: -->
    
    <VForm  @submit="submitForm">
      <div class="input-group">
        <label for="name" class="input-group-text">Név</label>
        <Field type="text" name="name" id="name" class="form-control"/>
        <ErrorMessage name="name" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label class="input-group-text">Hozzávaló:</label>
        <FieldArray name="ingredients">
          <template v-for="(ingredient, index) in ingredients" :key="index">
            <Field type="text" :name="'ingredients[' + index + ']'" v-model="ingredients[index]" class="form-control"/>
            <ErrorMessage :name="'ingredients[' + index + ']'" as="div" class="alert alert-danger"/>
          </template>
        </FieldArray>
        <button class="btn btn-success" type="button" @click="addIngredient"> Hozzávaló hozzadása</button>
      </div>
      <div class="input-group">
        <label for="description" class="input-group-text">Leírás</label>
        <Field type="text" name="description" id="description" class="form-control"/>
        <ErrorMessage name="description" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label for="quantity" class="input-group-text">Mennyiség</label>
        <Field type="number" name="quantity" id="quantity" class="form-control"/>
        <ErrorMessage name="quantity" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label for="price" class="input-group-text">Ár</label>
        <Field type="number" name="price" id="price" class="form-control"/>
        <ErrorMessage name="price" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label for="discounted_price" class="input-group-text">Kedvezményes ár</label>
        <Field type="number" name="discounted_price" id="discounted_price" class="form-control"/>
        <ErrorMessage name="discounted_price" as="div" class="alert alert-danger"/>
      </div>
    
      <!-- Ide kell az ízesítés legördülő menüs kódot megírni! -->
      
                <button class="btn btn-success mt-2" type="submit">Küldés</button>
              </VForm>
      
              <!-- A megírt elejéhez tartozó záró tagek -->
            
          </div>
        </div>
      </main>
    
    </template>
```
57. 6-feladat ```CreateNewDrinkFormView.vue``` - fájl ```<script>```` ```</script>``` megírása! ```<main,div row, div col> létrehozása, Form beillesztése!
    ´´´
    <script setup>
    //Az a VUE-ból jön, mert Composition API
    import {Form as VForm, Field, ErrorMessage, FieldArray} from 'vee-validate';
    import {onMounted, reactive, ref} from 'vue';
    import {http} from '@/utils/http.js'
    const ingredient = ref(['']);
    const flavors = reactive([]);
    async function getData(){
      const response = await http.get('flavors');
      for (const item of response.data.data){
        flavors.push(item)
      }
    }
    const addIngrent=()=>{
      ingredients.value.push('');
    }

    //ez egy Callback, ami futtatja a getData függvényt!

    onMounted(getData);
    </script>
´´`
58.  6-feladat ```CreateNewDrinkFormView.vue``` - fájl ```<template>```` ```</template>``` lenyíló menü megírása!
```
  <div class="input-group">
    <label class="input-group-text" for="flavor_id">Ízesítés</label>
    <Field name="flavor_id" id="flavor_id" as="select" class="form-select">
      <option v-for="flavor in flavors"
              :key="flavor.id" :value="flavor.id">
			  {{flavor.name}}
			  </option>
    </Field>
```
59. 6-feladat ```CreateNewDrinkFormView.vue``` - teljes file:
```
    <script setup>
    //Az a VUE-ból jön, mert Composition API
    import {Form as VForm, Field, ErrorMessage, FieldArray} from 'vee-validate';
    import {onMounted, reactive, ref} from 'vue';
    import {http} from '@/utils/http.js'
    const ingredients = ref(['']);
    const flavors = reactive([]);
    async function getData(){
      const response = await http.get('flavors');
      for (const item of response.data.data){
        flavors.push(item)
      }
    }
    const addIngredient=()=>{
      ingredients.value.push('');
    }
    async function submitForm(values){
      try{
        const resp = await http.post('drinks',values)
        if  (resp.data.success === true){
            alert('Sikeres létrehozás\n'+resp.data.data.name)
        }
        else{
            alert("Sikertelen létrehozás\n"+resp.data.message)
        }
      }catch (e){
             alert("Sikertelen létrehozás\n"+e.data.message)
    
      }
    }
    
    //ez egy Callback, ami futtatja a getData függvényt!
    
    onMounted(getData);
    </script>
    
    <template>
    
      <!-- ezt megírni: -->
    
    <main class="m-auto p-3 container">
    <div class="row">
      <div class="col">
        <h1>Új ital létrehozása</h1>
        <hr>
      </div>
    </div>
    <div  class="row">
    <div class="col">
    
    <!-- form txt-be: -->
    
    <VForm  @submit="submitForm">
      <div class="input-group">
        <label for="name" class="input-group-text">Név</label>
        <Field type="text" name="name" id="name" class="form-control"/>
        <ErrorMessage name="name" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label class="input-group-text">Hozzávaló:</label>
        <FieldArray name="ingredients">
          <template v-for="(ingredient, index) in ingredients" :key="index">
            <Field type="text" :name="'ingredients[' + index + ']'" v-model="ingredients[index]" class="form-control"/>
            <ErrorMessage :name="'ingredients[' + index + ']'" as="div" class="alert alert-danger"/>
          </template>
        </FieldArray>
        <button class="btn btn-success" type="button" @click="addIngredient"> Hozzávaló hozzadása</button>
      </div>
      <div class="input-group">
        <label for="description" class="input-group-text">Leírás</label>
        <Field type="text" name="description" id="description" class="form-control"/>
        <ErrorMessage name="description" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label for="quantity" class="input-group-text">Mennyiség</label>
        <Field type="number" name="quantity" id="quantity" class="form-control"/>
        <ErrorMessage name="quantity" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label for="price" class="input-group-text">Ár</label>
        <Field type="number" name="price" id="price" class="form-control"/>
        <ErrorMessage name="price" as="div" class="alert alert-danger"/>
      </div>
      <div class="input-group">
        <label for="discounted_price" class="input-group-text">Kedvezményes ár</label>
        <Field type="number" name="discounted_price" id="discounted_price" class="form-control"/>
        <ErrorMessage name="discounted_price" as="div" class="alert alert-danger"/>
      </div>
    
      <!-- Ide kell az ízesítés legördülő menüs kódot megírni! -->
    
      <div class="input-group">
        <label class="input-group-text" for="flavor_id">Ízesítés</label>
        <Field name="flavor_id" id="flavor_id" as="select" class="form-select">
          <option v-for="flavor in flavors"
                  :key="flavor.id" :value="flavor.id">
    			  {{flavor.name}}
    			  </option>
        </Field>
    
      </div>
                <button class="btn btn-success mt-2" type="submit">Küldés</button>
              </VForm>
    
              <!-- A megírt elejéhez tartozó záró tagek -->
    
          </div>
        </div>
      </main>
    
    </template>
    
    <style scoped>
    </style>
```
# 10 - 7. feladat validálás!!!
60. Választani kell, hogy ```YUP``` vagy ```VEE-VALIDATE``` először a YUP-al készítem el. Mindezt a ```CreateNewDrinkFormView.vue```-fájlban!
61. A ```CreateNewDrinkFormView.vue``` fájlba az alábbi részeket kell betenni:
```
<script setup>
//elejére:
import * as yup from 'yup'

//végére az on mounted elé kell egy object séma!!!:

const schema = yup.object({
  name: yup.string().max(50, 'kötelező, szöveg, maximum 50 karakter').required("kötelező, szöveg, maximum 50 karakter"),
  description: yup.string().max(255, 'maximum 255 karakter').required("kötetelező, szöveg, maximum 255 karakter"),
  quantity: yup.number().min(1).max(100, 'maximum 255 karakter').required("kötetelező, minimum 1, maximum 100"),
  price: yup.number().min(1).max(5000, 'maximum 255 karakter').required("kötelező, egész szám, minimum 1, maximum 5000"),
  discounted_price: yup.number().min(1).max(5000, 'maximum 255 karakter').required("egész szám, minimum 1, maximum 5000, kisebb mint a \"price\""),
  flavor_id: yup.number().required("kötelető, létező"),
  ingredients: yup.string().required("Kötelező")
})
</script>

<template>
<!--  össze kell kötni a form-al így---    :validation-schema="schema" - val kell kiegészíteni a VFORM @submitot!!! -->
<VForm  @submit="submitForm" :validation-schema="schema">
<template>

```

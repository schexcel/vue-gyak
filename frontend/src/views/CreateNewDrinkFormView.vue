<script setup>
//Az a VUE-ból jön, mert Composition API
import {Form as VForm, Field, ErrorMessage, FieldArray} from 'vee-validate';
import {onMounted, reactive, ref} from 'vue';
import {http} from '@/utils/http.js'
import * as yup from 'yup'
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

//ide kell a validáció
const schema = yup.object({
  name: yup.string().max(50, 'kötelező, szöveg, maximum 50 karakter').required("kötelező, szöveg, maximum 50 karakter"),
  description: yup.string().max(255, 'maximum 255 karakter').required("kötetelező, szöveg, maximum 255 karakter"),
  quantity: yup.number().min(1).max(100, 'maximum 255 karakter').required("kötetelező, minimum 1, maximum 100"),
  price: yup.number().min(1).max(5000, 'maximum 255 karakter').required("kötelező, egész szám, minimum 1, maximum 5000"),
  discounted_price: yup.number().min(1).max(5000, 'maximum 255 karakter').required("egész szám, minimum 1, maximum 5000, kisebb mint a \"price\""),
  flavor_id: yup.number().required("kötelető, létező"),
  ingredients: yup.string().required("Kötelező")

/*    - "name" kötelező, szöveg, maximum 50 karakter
- "description" kötetelező, szöveg, maximum 255 karakter
- "quantity" kötelező, egész szám, minimum 1, maximum 100
- "price" kötelező, egész szám, minimum 1, maximum 5000,
    - "discounted_price" kötelező, egész szám, minimum 1, maximum 5000, kisebb mint a "price"
- "flavor_id" kötelető, létező "flavors.id"
- "ingredients" kötelező
  */

})


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

<VForm  @submit="submitForm" :validation-schema="schema">
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
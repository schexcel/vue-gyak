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

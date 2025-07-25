import { createRouter, createWebHistory } from 'vue-router';
import Orders from '@/views/Orders.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'order',
      component: Orders,
    },
  ],
});

// Global navigation guard for authentication
router.beforeEach((to, from, next) => {
    next();
});

export default router;

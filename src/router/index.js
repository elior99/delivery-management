import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Order from "../views/Order.vue";
import Login from "../views/Login.vue";
import userOrders from "../views/userOrders.vue";
import userDeliveries from "../views/userDeliveries.vue";

Vue.use(VueRouter)

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/order",
    name: "Order",
    component: Order,
  },
  {
    path: "/userOrders",
    name: "userOrders",
    component: userOrders,
  },
  {
    path: "/userDeliveries",
    name: "userDeliveries",
    component: userDeliveries,
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
];

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router

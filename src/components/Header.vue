<template>
  <div
    class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"
  >
    <router-link
      to="/"
      class="d-flex align-items-center text-dark text-decoration-none"
    >
      <img src="logo.png" width="80px" alt="">
    </router-link>

    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
      <router-link
        to="/login"
        v-if="!isLogged()"
        class="me-3 py-2 text-dark text-decoration-none"
        >התחבר</router-link
      >
      <router-link
        to="/userDeliveries"
        v-if="isLogged() == 'courier'"
        class="me-3 py-2 text-dark text-decoration-none"
        >המשלוחים שלי</router-link
      >
      <router-link
        to="/userOrders"
        v-if="isLogged() == 'customer'"
        class="me-3 py-2 text-dark text-decoration-none"
        >ההזמנות שלי</router-link
      >

      <a
        href="#"
        v-if="isLogged() != false"
        @click="logout"
        class="me-3 py-2 text-dark text-decoration-none"
        >התנתק</a
      >
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      langs: "",
      mainlang: "",
      setLang: "",
    };
  },
  methods: {
    logout() {
      document.cookie =
        "username=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
      window.location = "/arci";
    },
    isLogged() {
      if (document.cookie.indexOf("courier") != -1) return "courier";
      else if (document.cookie.indexOf("demo") != -1) return "customer";

      return false;
    },
  },
};
</script>

<template>
  <div class="text-center">
    <div class="cardb text-center">
      <div class="cardh">
        <h4>ההזמנות שלי</h4>
      </div>

      <div class="card-body">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button
              class="nav-link active"
              id="nav-home-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-home"
              type="button"
              role="tab"
              aria-controls="nav-home"
              aria-selected="true"
            >
              ממתין
            </button>
            <button
              class="nav-link"
              id="nav-profile-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-profile"
              type="button"
              role="tab"
              aria-controls="nav-profile"
              aria-selected="false"
            >
              בטיפול
            </button>
            <button
              class="nav-link"
              id="nav-contact-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-contact"
              type="button"
              role="tab"
              aria-controls="nav-contact"
              aria-selected="false"
            >
              הושלם
            </button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div
            class="tab-pane fade show active"
            id="nav-home"
            role="tabpanel"
            aria-labelledby="nav-home-tab"
          >
            <pending :dataOrder="data.pending"></pending>
          </div>
          <div
            class="tab-pane fade"
            id="nav-profile"
            role="tabpanel"
            aria-labelledby="nav-profile-tab"
          >
            <proccess
              :orderLoc="locations"
              :dataOrder="data.proccess"
            ></proccess>
          </div>
          <div
            class="tab-pane fade"
            id="nav-contact"
            role="tabpanel"
            aria-labelledby="nav-contact-tab"
          >
            <completed :dataOrder="data.completed"></completed>
          </div>
        </div>
      </div>
    </div>
    <br />
    <router-link to="/order">
      <button class="btn btn-primary btn-lg" type="button">
        הזמן שליח
      </button></router-link
    >
  </div>
</template>

<script>
import orderPending from "../components/orderPending.vue";
import orderProccess from "../components/orderProccess.vue";
import orderCompleted from "../components/orderCompleted.vue";
export default {
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?getOrders=1",
      credentials: { username: "demo", password: "demo", type: "2" },
      locations: [
        "גדוד 21",
        "שדרות הגעתון",
        "הרצל",
        "אחד העם",
        "לוי אשכול",
        "ויצמן",
        "בלפור",
        "נחליאלי",
        "וולפסון",
        "ההגנה",
      ],
    };
  },
  components: {
    pending: orderPending,
    proccess: orderProccess,
    completed: orderCompleted,
  },
  methods: {
    getOrders() {
      console.log(this.details);
      fetch(this.url, {
        credentials: "include",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.credentials),
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {
          this.data = response;
        });
    },
  },
  created() {
    this.getOrders();
  },
};
</script>

<style scoped>
.input-group-text {
  height: 100%;
}
.form-group {
  text-align: center;
}
.graybg {
  background-color: #f2f2f2;
}
.whitebg {
  background-color: white;
}
</style>

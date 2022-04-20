<template>
  <div class="text-center">
    <div class="cardb text-center">
      <div class="cardh">
        <h4>משלוחים בטיפול</h4>
      </div>

      <div class="card-body">
        <span v-if="data.proccessing == undefined">אין משלוחים בטיפולך</span>
        <table v-else class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">כתובת</th>
              <th scope="col">מחיר</th>
              <th scope="col">הערה</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(order, i) in data.proccessing" :key="i">
              <th scope="row">{{ i + 1 }}</th>
              <td>{{ order.address }}</td>
              <td>{{ order.price }}</td>
              <td>{{ order.note }}</td>
              <td>
                <button
                  type="button"
                  @click="delivered(order.id)"
                  class="btn btn-primary btn-sm"
                >
                  ההזמנה נמסרה
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <br />

    <div class="text-center">
      <div class="cardb text-center">
        <div class="cardh">
          <h4>משלוחים זמינים</h4>
        </div>

        <div class="card-body">
          <span v-if="data.pending == undefined"
            >אין משלוחים זמינים לטיפול</span
          >

          <table v-else class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">כתובת</th>
                <th scope="col">מחיר</th>
                <th scope="col">הערה</th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(order, i) in data.pending" :key="i">
                <th scope="row">{{ i + 1 }}</th>
                <td>{{ order.address }}</td>
                <td>{{ order.price }}</td>
                <td>{{ order.note }}</td>
                <td>
                  <button
                    type="button"
                    @click="takeDel(order.id)"
                    class="btn btn-primary btn-sm"
                  >
                    טפל במשלוח
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <br />
    <div class="text-center">
      <div class="cardb text-center">
        <div class="cardh">
          <h4>משלוחים שנמסרו</h4>
        </div>

        <div class="card-body">
          <span v-if="data.completed == undefined"
            >אין משלוחים זמינים שנמסרו</span
          >

          <table v-else class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">כתובת</th>
                <th scope="col">מחיר</th>
                <th scope="col">הערה</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(order, i) in data.completed" :key="i">
                <th scope="row">{{ i + 1 }}</th>
                <td>{{ order.address }}</td>
                <td>{{ order.price }}</td>
                <td>{{ order.note }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["details"],
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?CourOrders=1",
      takeDelU: "/arci/api/sys.php?takeDel=1",
      delComp: "/arci/api/sys.php?completeOrder=1",
      delDetails: {},
    };
  },
  methods: {
    getOrders() {

      fetch(this.url, {
        credentials: "include",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {
          this.data = response;
        });

    },
    takeDel(id) {

      this.delDetails.id = id;
      fetch(this.takeDelU, {
        credentials: "include",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.delDetails),
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {
          this.getOrders();
        });

    },
    delivered(id) {
      this.delDetails.id = id;
      fetch(this.delComp, {
        credentials: "include",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.delDetails),
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {
          this.getOrders();
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

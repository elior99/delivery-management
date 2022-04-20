<template>
  <div v-if="dataOrder == undefined">
    <br />
    <strong>לא קיים הזמנות במערכת</strong>
  </div>
  <table v-else class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">כתובת</th>
        <th scope="col">מחיר</th>
        <th scope="col">הערה</th>
      </tr>
    </thead>

    <tbody
      class="graybg"
      :class="{ whitebg: i % 2 == 0 }"
      v-for="(order, i) in dataOrder"
      :key="i"
    >
      <tr style="border-bottom: 1px solid #ffffff00;">
        <th scope="row">{{ i + 1 }}</th>
        <td>{{ order.address }}</td>
        <td>{{ order.price }}</td>
        <td>{{ order.note }}</td>
      </tr>

      <tr>
        <td colspan="5">
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  :data-bs-target="'#a' + i"
                  aria-expanded="false"
                  aria-controls="panelsStayOpen-collapseTwo"
                >
                  פרטים נוספים&nbsp;&nbsp;
                </button>
              </h2>
              <div
                :id="'a' + i"
                class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingTwo"
              >
                <div class="accordion-body" style="text-align:right">
                  <p style="font-weight:500">
                    <img width="25px" src="location.svg" /> מיקום השליח:
                    {{ locations[(randLoc() + i) % locations.length] }}
                  </p>
                  <p style="font-weight:500">
                    <img width="25px" src="time.svg" /> &nbsp;זמן הגעה משוער:
                    {{ randTime() }} דקות
                  </p>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["dataOrder", "orderLoc"],
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?save_order=1",
      load: 1,
      credit: { name: "דמו דמו", visa: "0000000000000000", cvc: "379" },
      finish: 0,
      locations: {},
    };
  },
  methods: {
    randLoc() {
      var rand = Math.round(Math.random() * 1000);
      console.log(rand % this.locations.length);
      return rand % this.locations.length;
    },
    randTime() {
      var rand = Math.round(Math.random() * 70);
      return rand;
    },
  },
  mounted() {
    this.locations = this.orderLoc;
  },
};
</script>

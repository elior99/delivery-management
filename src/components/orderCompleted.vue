<template>
  <div v-if="dataOrder == undefined">
    <br />
    <strong>לא קיים הזמנות במערכת</strong>
  </div>
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
      <tr v-for="(order, i) in dataOrder" :key="i">
        <th scope="row">{{ i + 1 }}</th>
        <td>{{ order.address }}</td>
        <td>{{ order.price }}</td>
        <td>{{ order.note }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["dataOrder"],
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?save_order=1",
      load: 1,
      credit: { name: "דמו דמו", visa: "0000000000000000", cvc: "379" },
      finish: 0,
    };
  },
  methods: {},
  created() {},
};
</script>

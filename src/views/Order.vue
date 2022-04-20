<template>
  <div>
    <div v-if="!isLogged()">
      <div class="cardb text-center">
        <div class="cardh">
          <h4>עליך להתחבר תחילה</h4>
        </div>
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text">על מנת לבצע הזמנה עליך להתחבר כלקוח</p>
          <router-link to="/login" class="btn btn-success">התחברות</router-link>
        </div>
      </div>
    </div>
    <div v-else-if="isLogged() == 'courier'">
      <div class="cardb text-center">
        <div class="cardh">
          <h4>עליך להתחבר תחילה</h4>
        </div>
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text">אתה מחובר כשליח, עליך להתנתק ולהתחבר כלקוח</p>
        </div>
      </div>
    </div>

    <div v-else-if="!enterCredit">
      <div style="margin-top:10px" class="cardb">
        <div class="cardh text-center">
          <h4>הזמן שליח</h4>
        </div>

        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleFormControlInput1">כתובת למשלוח</label>
              <input
                v-model="data.address"
                type="text"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="הכנס כתובת"
              />
            </div>

            <div class="form-group">
              <label for="exampleFormControlInput1">סכום הזמנה</label>
              <input
                type="text"
                v-model="data.price"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="הכנס סכום"
              />
            </div>

            <label for="exampleFormControlInput1">שולם</label>
            <select
              v-model="data.paid"
              class="form-select"
              aria-label="Default select example"
            >
              <option value="1">כן</option>
              <option value="0">לא</option>
            </select>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">הערות</label>
              <textarea
                v-model="data.note"
                class="form-control"
                id="exampleFormControlTextarea1"
                rows="3"
              ></textarea>
            </div>
          </form>
          <br />
          <div class="d-grid gap-2 col-6 mx-auto">
            <button @click="goToPayment" type="button" class="btn btn-success">
              הזמן
            </button>
          </div>
        </div>
      </div>
    </div>

    <pay v-if="enterCredit" :details="data"></pay>
  </div>
</template>

<script>
import Payment from "../components/Payment.vue";
export default {
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?save_order=1",
      load: 1,
      enterCredit: 0,
    };
  },
  components: {
    pay: Payment,
  },
  methods: {
    goToPayment() {
      this.enterCredit = 1;
    },
    isLogged() {
      if (document.cookie.indexOf("courier") != -1) return "courier";
      else if (document.cookie.indexOf("demo") == -1) return false;

      return true;
    },
  },
  created() {
    setTimeout(
      function() {
        this.load = 0;
      }.bind(this),
      600
    );
  },
};
</script>

<style></style>

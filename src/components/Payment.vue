<template>
  <div>
    <div class="alert alert-primary" v-if="finish">
      <h2>ההזמנה בוצעה בהצלחה. נהיה אצלכם בקרוב</h2>
    </div>

    <div v-if="load"><img src="preloader.svg" class="imgCenter" alt="" /></div>
    <div v-else-if="load == 0 && finish == 0" class="container">
      <div class="row">
        <div class="col-lg-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <strong>הכנס את פרטי כרטיס האשראי</strong>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">שם</label>
                    <input
                      class="form-control"
                      :value="credit.name"
                      id="name"
                      type="text"
                      placeholder="הכנס את שמך"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="ccnumber">מספר כרטיס אשראי</label>
                    <div class="input-group">
                      <input
                        class="form-control"
                        :value="credit.visa"
                        type="text"
                        placeholder="0000 0000 0000 0000"
                        autocomplete="email"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="ccmonth">חודש</label>
                  <select class="form-control" id="ccmonth">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="ccyear">שנה</label>
                  <select class="form-control" id="ccyear">
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="cvv">CVV/CVC</label>
                    <input
                      class="form-control"
                      :value="credit.cvc"
                      id="cvv"
                      type="text"
                      placeholder="123"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <button
                class="btn btn-sm btn-success float-right"
                type="button"
                @click="saveOrder"
              >
                <i class="mdi mdi-gamepad-circle"></i> שלם
              </button>
            </div>
          </div>
        </div>
      </div>
      <img
        class="imgCenter"
        style="width:100%;max-width:200px;margin-top:10px;"
        src="visa.png"
        alt=""
      />
    </div>
  </div>
</template>

<script>
export default {
  props: ["details"],
  data() {
    return {
      data: {},
      url: "/arci/api/sys.php?save_order=1",
      load: 1,
      credit: { name: "דמו דמו", visa: "0000000000000000", cvc: "379" },
      finish: 0,
    };
  },
  methods: {
    saveOrder() {
      this.load = 1;

      fetch(this.url, {
        credentials: "include",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.details),
      })
        .then((response) => {
          return response.json();
        })
        .then((response) => {});

      setTimeout(
        function() {
          this.load = 0;
          this.finish = 1;
        }.bind(this),
        1000
      );
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

<style>
.imgCenter {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
